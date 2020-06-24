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
class CustomRegisterServicesView extends FormBase {

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
  
$results = $config->get();


$userdata = $results;

$header = [
  'username' => $this->t('UserName'),
  'roll_no' => $this->t('Roll No'),
  'a_status' => $this->t('Status'),
];

$form['table'] = [
  '#type' => 'tableselect',
  '#title' => $this->t('Users'),
  '#header' => $header,
  '#options' => $userdata,
  '#empty' => $this->t('No users found'),
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
  // public function validateForm(array &$form, FormStateInterface $form_state) {
  //   // valiodate form values
  //   if ($form_state->getValue('username') == '' || $form_state->getValue('roll_no') == '') {
  //     $msg = t('<strong>Username and Roll Number are required!</strong>');
  //     $form_state->setErrorByName('form', $msg);
  //   }
  // }
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
    $name=$form_state->getValue('table');
    //echo'<pre>';print_r($name);die;
    foreach($name as $value){

    $config = \Drupal::config('CustomRegisterService.settings');
    $data = $config->get($value); 
    //print_r ($id);
    $user = \Drupal\user\Entity\User::load($data['user_id']);
    $user->addRole('student');
    $user->save();
    //die();
    
  
    $config = \Drupal::service('config.factory')->getEditable('CustomRegisterService.settings');
    $config->set($value.'.a_status', '1');
    $config->save();
    }
      drupal_set_message($this->t("@message", ['@message' => 'Status changed Successfully.']));
    }

  // /**
  //  * {@inheritdoc}
  //  */
  // protected function getEditableConfigNames() {
  //   return ['CustomRegisterService.settings'];
  // }

}
