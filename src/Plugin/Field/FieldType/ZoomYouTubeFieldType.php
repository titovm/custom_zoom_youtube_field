<?php

namespace Drupal\custom_zoom_youtube_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'zoom_youtube' field type.
 *
 * @FieldType(
 *   id = "zoom_youtube",
 *   label = @Translation("Zoom and YouTube links"),
 *   description = @Translation("A field containing optional Zoom and YouTube links."),
 *   default_widget = "zoom_youtube_widget",
 *   default_formatter = "zoom_youtube_formatter"
 * )
 */
class ZoomYouTubeFieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['zoom_link'] = DataDefinition::create('string')
      ->setLabel(t('Zoom link'));

    $properties['youtube_link'] = DataDefinition::create('string')
      ->setLabel(t('YouTube link'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'zoom_link' => [
          'type' => 'varchar',
          'length' => 2048,
          'not null' => FALSE,
        ],
        'youtube_link' => [
          'type' => 'varchar',
          'length' => 2048,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $zoom = $this->get('zoom_link')->getValue();
    $youtube = $this->get('youtube_link')->getValue();
    return empty($zoom) && empty($youtube);
  }
}