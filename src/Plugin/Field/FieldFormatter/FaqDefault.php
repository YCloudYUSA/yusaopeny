<?php

namespace Drupal\ymcali_faq\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'faq_default' formatter.
 *
 * @FieldFormatter(
 *   id = "faq_default",
 *   label = @Translation("Faq default"),
 *   field_types = {
 *     "faq"
 *   }
 * )
 */
class FaqDefault extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
//    kint($items[0]);die('xxx');
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        'question' => [
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#attributes' => [
            'class' => [
              'field-question',
            ],
          ],
          '#value' => $item->question,
        ],
        'answer' => [
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#attributes' => [
            'class' => [
              'field-answer',
            ],
          ],
          '#value' => $item->answer,
        ],
        '#prefix' => '<div class="paragraph--type--faq-item">',
        '#suffix' => '</div>',
      ];
    }

    return $elements;
  }

}
