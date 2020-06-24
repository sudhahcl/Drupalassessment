<?php

namespace Drupal\migrate_module\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for the models.
 *
 * @MigrateSource(
 *   id = "models"
 * )
 */
class Models extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('mobile_models', 'g')
      ->fields('g', ['id', 'mobile_id', 'name']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Model ID'),
      'mobile_id' => $this->t('Mobile ID'),
      'name' => $this->t('Model name'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'g',
      ],
    ];
  }
}