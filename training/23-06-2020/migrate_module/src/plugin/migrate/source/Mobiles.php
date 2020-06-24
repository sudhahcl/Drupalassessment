<?php
namespace Drupal\migrate_module\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for the mobiles.
 *
 * @MigrateSource(
 *   id = "mobiles"
 * )
 */
class Mobiles extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('mobiles', 'd')
      ->fields('d', ['id', 'name', 'description']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Mobile ID'),
      'name' => $this->t('Mobile Name'),
      'description' => $this->t('Mobile Description'),
      'models' => $this->t('Mobile Models'),
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
        'alias' => 'd',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $model = $this->select('mobile_models', 'g')
      ->fields('g', ['id'])
      ->condition('mobile_id', $row->getSourceProperty('id'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('model', $model);
    return parent::prepareRow($row);
  }
}