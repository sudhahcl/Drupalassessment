<?php

namespace Drupal\user_details\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Entity\t;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\user_details\Event\UserDetailEvent;



/**
 * Class Configuration Setting.
 *
 * @package Drupal\user_details\Form
 */
class user_detailsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  // public static function create(ContainerInterface $container) {
  //   return new static(
  //       $container->get('user_details.settings')
  //   );
  // }

 

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $config = \Drupal::config('user_details.settings');
    //echo '<pre>';print_r($config);die();
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Firstname'),
      '#maxlength' => 30,
      '#required' => TRUE,
    ];
    
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lastname'),
      '#maxlength' => 10,
      '#required' => TRUE,
    ]; 
    $form['bio'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Bio'),
        '#maxlength' => 250,
        '#required' => TRUE,
      ]; 
    $form['gender'] = [
        '#type' => 'radios',
        '#title' => $this->t('Gender'),
        '#options'=>['male'=>$this->t('Male'),'female'=>$this->t('Female')],
        '#required' => TRUE,
      ]; 
   
    $vac_id = "interests";
    $term = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vac_id);
    //$termdatas[] = t('List by ' . $vac_id);
    foreach($term as $terms){
        $termdatas[$terms->name]=$terms->name;
    }
    //print_r($termdatas);
    // Select.
    $form['interest'] = [
      '#type' => 'select',
      '#title' => $this->t('Interests'),
      '#options' => $termdatas,
      // '#empty_option' => $this->t('-select-'),
      '#required' => TRUE,
      '#multiple' => FALSE,
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
      '#ajax'=>['callback' => '::submitdata',],
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
    return 'user_details';
  }

  /**
   * {@inheritdoc}
   */
  public function submitdata(array &$form, FormStateInterface $form_state) {
    // print_r($data);
    $response = new AjaxResponse();

    $data = $form_state->getValues();
    $res1 = array(
                  'first_name' => $form_state->getValues()['first_name'],
                  'last_name' => $form_state->getValues()['last_name'],
                  'bio' => $form_state->getValues()['bio'],
                  'gender' => $form_state->getValues()['gender'],
                  'interest' => $form_state->getValues()['interest']   
                );
   // print_r($res1['first_name']);
    // die();

    $result = db_insert('userdetails')->fields($res1)->execute(); 
    //echo $result;
    $dispatcher = \Drupal::service('event_dispatcher');
    $event = new UserDetailEvent($result);
    
    $dispatcher->dispatch(UserDetailEvent::USERFUNCTION, $event);   
   echo $result;
     exit;

    
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

  // /**
  //  * {@inheritdoc}
  //  */
 
}
