<?php

namespace Drupal\CustomRegisterService\Form;

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
class CustomRegisterServiceForm extends FormBase {

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
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $config = \Drupal::config('CustomRegisterService.settings');
    //echo '<pre>';print_r($config);die();
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#maxlength' => 30,
      '#required' => TRUE,
      '#default_value' => $config->get('user.username') ? $config->get('user.username') : '',
    ];
    
    $form['roll_no'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Roll Number'),
      '#maxlength' => 10,
      '#required' => TRUE,
      '#default_value' => $config->get('user.roll_no') ? $config->get('user.roll_no') : '',
    ]; 
    // $form['password'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Password'),
    //   '#maxlength' => 20,
    //   '#required' => TRUE,
    // //  '#default_value' => $config->get('user.email') ? $config->get('user.email') : '',
    // ];

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
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valiodate form values
    if ($form_state->getValue('username') == '' || $form_state->getValue('roll_no') == '') {
      $msg = t('<strong>Username and Roll Number are required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'CustomRegisterService';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user_id = \Drupal::currentUser()->id();
    $username = $form_state->getValue('username');
    $roll_no = $form_state->getValue('roll_no');
    $a_status = '0'; 
   // $password = $form_state->getValue('password');
    $values = array("user_id"=>$user_id,"username"=>$username,"roll_no"=>$roll_no,"a_status"=>$a_status);
    // print_r($values);
    // die;
   $config = \Drupal::service('config.factory')->getEditable('CustomRegisterService.settings')->delete();

    $config1 = \Drupal::service('CustomRegisterService.register')->save($values);
    drupal_set_message($this->t("@message", ['@message' => 'Register Successfully.']));
  }

  // /**
  //  * {@inheritdoc}
  //  */
  // protected function getEditableConfigNames() {
  //   return ['CustomRegisterService.settings'];
  // }

}
