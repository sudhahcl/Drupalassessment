<?php

namespace Drupal\custom_user_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Entity\t;
use Drupal\Core\Database;
// use Drupal\Core\Ajax\AjaxResponse;
// use Drupal\custom_user_register\Event\UserDetailEvent;



/**
 * Class Configuration Setting.
 *
 * @package Drupal\custom_user_register\Form
 */
class CustomUserRegisterList extends FormBase {

  /**
   * {@inheritdoc}
   */
  // public static function create(ContainerInterface $container) {
  //   return new static(
  //       $container->get('custom_user_register.settings')
  //   );
  // }

 

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $database = \Drupal::database();
    $query = $database->query("SELECT u.uid,u.name,u.mail,u.status from users_field_data as u where u.uid > 0 and u.status = 0");
    $result = $query->fetchAll();
    $options=[];
    $i=0;
    // print_r($result);
    // exit;
    foreach($result as $value){
      $data=(array)$value;
      // print_r($data);
      // exit;
    $options[$value->uid] = $data;
    // print_r($options);
    // exit;
     
    }
    // print_r($options);
    // exit;
    $header=['uid'=>$this->t('UserID'),
            'name'=>$this->t('Username'),
            'mail'=>$this->t('Email'),
            'status'=>$this->t('Status')];

    $form['table'] = [
      '#type' => 'tableselect',
      '#title' => $this->t('User List'),
      '#header' => $header,
      '#options' => $options,
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
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valiodate form values
    // if ($form_state->getValue('first_name') == '' || $form_state->getValue('last_name') == '') {
    //   $msg = t('<strong>Firstname and Lastname are required!</strong>');
    //   $form_state->setErrorByName('form', $msg);
    // }
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_user_register';
  }

  /**
   * {@inheritdoc}
   */

  public function submitForm(array &$form, FormStateInterface $form_state) {
  $data = array_filter($form_state->getValue('table'));
  
  if(empty(!$data)){
  foreach($data as $id){
    $user = \Drupal\user\Entity\User::load($id);
    $user->addRole('user');
    $user->save();
    $update = \Drupal\user\Entity\User::load($id);
    $update->set('status',1);
    $update->save();
  }
  }
  drupal_set_message($this->t("@message", ['@message' => 'Users Activated Successfully.']));

  }

  // /**
  //  * {@inheritdoc}
  //  */
 
}
