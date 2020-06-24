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
class CustomRegisterForm_edit extends FormBase {

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
  public function buildForm(array $form, FormStateInterface $form_state , $custom_id = NULL) {
	  
	$this->data = $custom_id;
	
	$config =  \Drupal::service('config.factory')->getEditable('CustomRegister.settings');
	$uservalue = $config->get('user');	
	$uservalues  = $uservalue[$custom_id];
	$usename = $uservalues['username']; 
	$email = $uservalues['email']; 
	$cpassword = $uservalues['password']; 
	

	  	  // User Name
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('username'),
      '#size' => 60,
      '#maxlength' => 128,	  
	  '#default_value' =>  $this->t($usename),
      '#description' => $this->t('User Name'),
	  '#disabled' => TRUE,
    ];
		
	// Email
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('email'),
      '#delta' => 2,	  
	  '#default_value' =>  $this->t($email),
      '#description' => $this->t('Email'),
	  '#disabled' => TRUE,
    ];
	
	
	
	    // Password Confirm.
    $form['cfm_password'] = [
      '#type' => 'cfm_password',
      '#title' => $this->t('New password'),
      '#description' => $this->t('please enter the password'),
	  '#required' => True,
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
  private $data;
	  
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valiodate form values
    if ($form_state->getValue('cfm_password') == '' ) {
      $msg = t('<strong>=Password is required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
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

	
	$id =  $this->data;
	$npassword =  $form_state->getValues()['cfm_password'];
	$config = \Drupal::service('CustomRegister.register')->changepassword($id , $npassword);

    drupal_set_message($this->t("@message", ['@message' => 'Configuration  Updated Successfully !!.']));
	
  }

  // /**
  //  * {@inheritdoc}
  //  */
  // protected function getEditableConfigNames() {
  //   return ['CustomRegisterService.settings'];
  // }


}
