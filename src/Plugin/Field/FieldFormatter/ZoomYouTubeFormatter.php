<?php

namespace Drupal\custom_zoom_youtube_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'zoom_youtube_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "zoom_youtube_formatter",
 *   label = @Translation("Zoom and YouTube links formatter"),
 *   field_types = {
 *     "zoom_youtube"
 *   }
 * )
 */
class ZoomYouTubeFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
        if (!empty($item->youtube_link)) {
            $youtube_id = $this->extractYouTubeId($item->youtube_link);
            $modal_id = 'youtube-modal-' . $delta;
            $elements[$delta] = [
                '#type' => 'inline_template',
                '#template' => '<a href="#" class="open-modal" data-target="#{{ modal_id }}" data-youtube-id="{{ youtube_id }}">Watch on YouTube</a>
                                <div class="custom-modal" id="{{ modal_id }}" style="display:none;">
                                    <div class="custom-modal-content">
                                        <span class="close-modal">&times;</span>
                                        <iframe width="100%" height="90%" src="" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>',
                '#context' => [
                    'modal_id' => $modal_id,
                    'youtube_id' => $youtube_id,
                ],
                '#attached' => [
                    'library' => [
                        'custom_zoom_youtube_field/custom_modals',
                    ],
                ],
            ];
        } elseif (!empty($item->zoom_link)) {
            $zoom_url = Url::fromUri($item->zoom_link, ['attributes' => ['target' => '_blank']]);
            $elements[$delta] = [
                '#type' => 'link',
                '#title' => $this->t('Join Zoom Meeting'),
                '#url' => $zoom_url,
                '#options' => ['attributes' => ['class' => ['zoom-meeting-link']]],
            ];
        }
    }
    return $elements;
  }

  /**
   * Helper function to extract YouTube video ID from URL.
   */
  private function extractYouTubeId($url) {
    preg_match("/v=([^&]+)/", $url, $matches);
    return $matches[1] ?? '';
  }
}