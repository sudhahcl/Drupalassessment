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
class CustomUserProfileFormList extends FormBase {

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
    $uid = \Drupal::currentUser()->id();    
    $database = \Drupal::database();
    $query = $database->query("SELECT * from userdata where uid='$uid'");
    $result = $query->fetchAll();
    $options=[];

  // exit;
  foreach($result as $value){
    $data=(array)$value;
    // print_r($data);
    // exit;
  $options[$value->id] = $data;
   
  }
//        print_r($options);
//    exit;
    $header=['id'=>$this->t('ID'),
             'uid'=>$this->t('UID'),
            // 'mail'=>$this->t('Email'),
            'first_name'=>$this->t('First Name'),
            'last_name'=>$this->t('Last Name'),
            'gender'=>$this->t('Gender')];

    $form['table'] = [
      '#type' => 'tableselect',
      '#title' => $this->t('User Profile'),
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No users found'),
    ];
 
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
  

  }

  // /**
  //  * {@inheritdoc}
  //  */
 
}
