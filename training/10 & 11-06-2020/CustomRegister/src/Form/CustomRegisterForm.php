<?php

namespace Drupal\CustomRegister\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Entity\t;

/**
 * Class Configuration Setting.
 *
 * @package Drupal\CustomRegisterService\Form
 */
class CustomRegisterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  // public static function create(ContainerInterface $container) {
  //   return new static(
  //       $container->get('CustomRegisterService.settings')
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
    
    $config = \Drupal::config('CustomRegister.settings');
    //echo '<pre>';print_r($config);die();
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#maxlength' => 30,
      '#required' => TRUE,
     // '#default_value' => $config->get('user.name') ? $config->get('user.name') : '',
    ];
    
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#maxlength' => 70,
      '#required' => TRUE,
    //  '#default_value' => $config->get('user.email') ? $config->get('user.email') : '',
    ]; 
    $form['password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
      '#maxlength' => 20,
      '#required' => TRUE,
    //  '#default_value' => $config->get('user.email') ? $config->get('user.email') : '',
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
    return 'CustomRegister';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $username = $form_state->getValue('username');
    $email = $form_state->getValue('email');
    $password = $form_state->getValue('password');
    $values = array("username"=>$username,"email"=>$email,"password"=>$password);
    print_r($values);
    $config1 = \Drupal::service('CustomRegister.register')->save($values);
    drupal_set_message($this->t("@message", ['@message' => 'Register Successfully.']));
  }

  // /**
  //  * {@inheritdoc}
  //  */
  // protected function getEditableConfigNames() {
  //   return ['CustomRegisterService.settings'];
  // }

}
