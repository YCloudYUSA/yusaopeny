<?php

namespace Drupal\openy\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form to configure and rewrite settings.php.
 */
class TermsOfUseForm extends FormBase {

  /**
   * The current version of Terms of Use.
   */
  const TERMS_OF_USE_VERSION = '2.2';

  /**
   * The Messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * TermsOfUseForm constructor.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'openy_terms_of_use';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('openy.terms_and_conditions.schema');
    $isAccepted = $config->get('accepted_version');
    $analytics = $config->get('analytics');
    $route_name = $this->getRouteMatch()->getRouteName();

    $form['#title'] = $this->t('Terms and Conditions');

    // Title is added automatically on installation pages,
    // but we should add it for admin page.
    if ($route_name == 'openy_system.openy_terms_and_conditions') {
      $form['title'] = [
        '#type' => 'html_tag',
        '#tag' => 'h1',
        '#value' => $this->t('Terms and Conditions'),
      ];
    }

    $form['participant'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('We agree to the <a target="_blank" href="@ws-participant-agreement">Participant Agreement</a> and <a target="_blank" href="@terms-of-use">Terms of Use</a>', [
        '@ws-participant-agreement' => 'https://ds-docs.y.org/docs/wiki/ws-participant-agreement/',
        '@terms-of-use' => 'https://ds-docs.y.org/docs/wiki/ws-terms-of-use/',
      ]),
      '#default_value' => ($isAccepted) ? 1 : 0,
      '#weight' => 1,
      '#disabled' => ($isAccepted) ? 1 : 0,
    ];

    $form['llc'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('YMCA of the USA supports the Website Services platform with respect to use by its Member Associations but is not responsible for and does not control the services provided by 3rd party agencies, which are using and modifying YMCA Website Service distribution.'),
      '#default_value' => ($isAccepted) ? 1 : 0,
      '#weight' => 2,
      '#disabled' => ($isAccepted) ? 1 : 0,
    ];

    $form['privacy'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('YMCA of the USA recommends that each participating YMCA association develop and implement its own cybersecurity policies and obtain cyber liability and data privacy insurance.'),
      '#default_value' => ($isAccepted) ? 1 : 0,
      '#weight' => 3,
      '#disabled' => ($isAccepted) ? 1 : 0,
    ];

    $form['acknowledge'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I acknowledge that YMCA Website Service is open source content and that all content is provided “as is” without any warranty of any kind. YMCA of the USA makes no warranty that its services will meet your requirements, be safe, secure, uninterrupted, timely, accurate, or error-free, or that your information will be secure. YMCA of the USA will not maintain and support YMCA Website Service templates indefinitely. The entire risk as to the quality and performance of the content is with you.'),
      '#default_value' => ($isAccepted) ? 1 : 0,
      '#weight' => 4,
      '#disabled' => ($isAccepted) ? 1 : 0,
    ];

    $form['obtaining'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('YMCA of the USA recommends obtaining a reputable agency to assist with the implementation of the YMCA Website Service platform and further development for your specific needs.'),
      '#default_value' => ($isAccepted) ? 1 : 0,
      '#weight' => 5,
      '#disabled' => ($isAccepted) ? 1 : 0,
    ];

    $form['demo_content_exclusive_property'] = [
      '#type' => 'checkbox',
      '#title' => $this->t("All demonstration content, including but not limited to text, images, graphics, videos, audio, and any other materials displayed on this website, is the exclusive property of YMCA of the USA. The demonstration content is provided solely for illustrative purposes and to showcase the capabilities of YMCA's Website Service. <b>Nonetheless, YMCA member associations may use demonstration content for their websites, as applicable.</b>"),
      '#description' => $this->t("<p>By accessing and/or using this website, you agree to respect the ownership and intellectual property rights of YMCA of the USA over the demonstration content. Users and visitors are strictly prohibited from reproducing, distributing, modifying, or otherwise using the demonstration content without explicit written permission from YMCA of the USA.</p><p>Any unauthorized use or misuse of the demonstration content is a violation of these Terms and Conditions and may be subject to applicable laws and regulations, result in your access being revoked, and/or legal action taken, if applicable.</p><p>YMCA of the USA reserves the right to change, modify, or remove the demonstration content from the website at any time without prior notice. We are not responsible for any inaccuracies or errors in the demonstration content and make no guarantees about its accuracy or completeness.</p>"),
      '#default_value' => ($isAccepted) ? 1 : 0,
      '#weight' => 5,
      '#disabled' => ($isAccepted) ? 1 : 0,
    ];

    $form['agree_openy_terms'] = [
      '#type' => 'hidden',
      '#weight' => 6,
    ];

    if (!$isAccepted) {
      $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Accept Terms and Conditions'),
        '#weight' => 15,
        '#button_type' => 'primary',
        '#states' => [
          'disabled' => [
            [':input[name="participant"]' => ['checked' => FALSE]],
            'and',
            [':input[name="llc"]' => ['checked' => FALSE]],
            'and',
            [':input[name="privacy"]' => ['checked' => FALSE]],
            'and',
            [':input[name="acknowledge"]' => ['checked' => FALSE]],
            'and',
            [':input[name="obtaining"]' => ['checked' => FALSE]],
            'and',
            [':input[name="demo_content_exclusive_property"]' => ['checked' => FALSE]],
          ],
        ],
      ];
    }
    else {
      $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Accept Terms and Conditions'),
        '#weight' => 15,
        '#button_type' => 'primary',
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $route_name = $this->getRouteMatch()->getRouteName();
    // If site installation is not run via drush.
    if (!$form_state->getValue('agree_openy_terms')) {
      $values = $form_state->getValues();
      foreach ($values as $key => $value) {
        if ($key == 'analytics') {
          continue;
        }
        if ($value === 0) {
          $form_state->setErrorByName($key, $this->t('Select all checkboxes to indicate that you have read and agree to the Terms and Conditions.'));
        }
      }
    }

    if ($route_name == 'openy_system.openy_terms_and_conditions') {
      $current_user = $this->currentUser();

      if (!in_array('administrator', $current_user->getRoles()) && $current_user->id() != 1) {
        $form_state->setErrorByName(
          'submit',
          $this->t('Only user with an Administrator role can accept terms and conditions.')
        );
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // The form is used on Website Services installation and in admin back-office.
    // We can't save acceptance flag to the database during installation,
    // because form is displayed very early and db is not configured yet.
    if (isset($GLOBALS['install_state'])) {
      // We must add GET param here, to indicate the step is performed.
      // Otherwise Drupal will redirect to the first page each time.
      $build_info = $form_state->getBuildInfo();
      $build_info['args'][0]['parameters']['terms_and_conditions'] = 1;
      $form_state->setBuildInfo($build_info);
    }
    else {
      $config = $this->configFactory
        ->getEditable('openy.terms_and_conditions.schema');
      $config->set('version', static::TERMS_OF_USE_VERSION);
      $config->set('accepted_version', time());
      $config->set('analytics', $form_state->getValue('analytics'));
      $config->set('analytics_optin', 1);
      $config->save();

      $this->messenger->addMessage($this->t('YMCA Website Service Terms and Conditions have been accepted.'));
      $form_state->setRedirect('openy_system.openy_terms_and_conditions');
    }
  }

}
