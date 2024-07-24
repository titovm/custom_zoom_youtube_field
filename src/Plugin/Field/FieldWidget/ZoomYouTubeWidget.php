<?php

namespace Drupal\custom_zoom_youtube_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'zoom_youtube_widget' widget.
 *
 * @FieldWidget(
 *   id = "zoom_youtube_widget",
 *   label = @Translation("Zoom and YouTube links widget"),
 *   field_types = {
 *     "zoom_youtube"
 *   }
 * )
 */
class ZoomYouTubeWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['zoom_link'] = [
      '#type' => 'url',
      '#title' => $this->t('Zoom link'),
      '#default_value' => isset($items[$delta]->zoom_link) ? $items[$delta]->zoom_link : NULL,
    ];

    $element['youtube_link'] = [
      '#type' => 'url',
      '#title' => $this->t('YouTube link'),
      '#default_value' => isset($items[$delta]->youtube_link) ? $items[$delta]->youtube_link : NULL,
    ];

    return $element;
  }
}