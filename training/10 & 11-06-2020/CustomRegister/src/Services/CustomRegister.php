<?php

namespace  Drupal\CustomRegister\Services;
use Drupal\Core\Config\ConfigFactoryInterface;


interface CustomRegisterInterface { 
	   public  function save($data); 
	   public  function edit($data); 
}

class CustomRegister implements CustomRegisterInterface{

 public $config1; 
 

 public function  save($config1){
	$id=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 3);
	
	$key='user'.$id;
    $config = \Drupal::service('config.factory')->getEditable('CustomRegister.settings');
    $config->set($key, $config1);
    $config->save();
 }
 
  public function  edit($config1){
	
	$key=$data['userid'];
	unset($data['userid']);
		
    $config = \Drupal::service('config.factory')->getEditable('CustomRegister.settings');
    $config->set($key.'.password', $config1['password']);
    $config->save();
 }

}