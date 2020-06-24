<?php

namespace  Drupal\CustomRegisterService\Services;
use Drupal\Core\Config\ConfigFactoryInterface;


interface CustomRegisterServiceInterface { 
	   public  function save($data); 
//	   public  function edit($data); 
}

class CustomRegisterServices implements CustomRegisterServiceInterface{

 public $config1; 
 

 public function  save($config1){
  // print_r($config1);
    $key = $config1['username'];
 
	 $config = \Drupal::service('config.factory')->getEditable('CustomRegisterService.settings');
    $config->set($key,$config1);
    $config->save();
 }
 
//   public function  edit($config1){
	
// 	$key=$data['userid'];
// 	unset($data['userid']);
		
//     $config = \Drupal::service('config.factory')->getEditable('CustomRegisterService.settings');
//     $config->set($key.'.password', $config1['password']);
//     $config->save();
//  }

}