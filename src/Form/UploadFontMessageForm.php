<?php

namespace Drupal\openy\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form for informing the user about Cachet licensing during install.
 */
class UploadFontMessageForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'openy_upload_font_message';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, array &$install_state = NULL) {
    $base_url = $GLOBALS['base_url'];
    $form['#title'] = $this->t('How to upload Cachet fonts');

    $form['updatefont']['markup'] = [
      '#type' => 'markup',
      '#markup' => $this->t('<p>By default free Verdana fonts are used.</p>
      <p>Y-USA is now licensing the web font version of Cachet for all YMCAs via the <a target="_blank" href=\'@brand_resource\'>Brand Resource Guide</a>.</p>
      <p>To use Cachet fonts on the Website Services website, download from the Brand Resource Guide then go to the <a target="_blank" href=\'@config_url\'>Website Services Font Settings page</a> and upload the font files there.</p>
      <p>View <a target="_blank" href=\'@font_instructions\'>tutorial for how to do this</a>.</p>
      <img src="../profiles/contrib/yusaopeny/src/Form/uploadfont.png">',
        [
          '@config_url' => "$base_url/admin/appearance/font/local_font_config_entity",
          '@brand_resource' => "https://theybrand.org/wordpress/cachet",
          '@font_instructions' => "https://ds-docs.y.org/docs/howto/install-cachet/",
        ]
      ),
    ];

    $form['actions'] = [
      'continue' => [
        '#type' => 'submit',
        '#value' => $this->t('OK'),
      ],
      '#type' => 'actions',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
