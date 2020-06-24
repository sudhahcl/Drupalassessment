<?php

namespace Drupal\dtraining\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Entity\t;

/**
 * Class Configuration Setting.
 *
 * @package Drupal\dtraining\Form
 */
class dtrainingSetting extends FormBase {

  /**
   * {@inheritdoc}
   */
  // public static function create(ContainerInterface $container) {
  //   return new static(
  //       $container->get('dtraining.settings')
  //   );
  // }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valiodate form values
    if ($form_state->getValue('username') == '' || $form_state->getValue('email') == '') {
      $msg = t('<strong>Username and Email are required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $config = \Drupal::config('dtraining.settings');
    //echo '<pre>';print_r($config);die();
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#maxlength' => 30,
      '#required' => TRUE,
      '#default_value' => $config->get('user.name') ? $config->get('user.name') : '',
    ];
    
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#maxlength' => 70,
      '#required' => TRUE,
      '#default_value' => $config->get('user.email') ? $config->get('user.email') : '',
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dtraining';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    //$config = \Drupal::config('dtraining.settings')->getEditable();
    $config = \Drupal::service('config.factory')->getEditable('dtraining.settings');
    $config->set('user.name', $form_state->getValue('username'));
    $config->set('user.email', $form_state->getValue('email'));
    $config->save();

    drupal_set_message($this->t("@message", ['@message' => 'Configuration Successfully Updated.']));
  }

  // /**
  //  * {@inheritdoc}
  //  */
  // protected function getEditableConfigNames() {
  //   return ['dtraining.settings'];
  // }

}
