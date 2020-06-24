<?php

namespace Drupal\Dynamicuser\Controller;

use Drupal\Core\Controller\ControllerBase;


 class displayController extends ControllerBase{

 public function display($user) {
     
  $userdata=array("1"=>array("userid"=>1,"name"=>'Samritha'),"2"=>array("userid"=>2,"name"=>'Harini'),"3"=>array("userid"=>3,"name"=>'Vishnu'));   
     
  
  if(in_array($user,$userdata[$user]))  { 
    $data = [
      '#title' => $this->t("Hello ".$userdata[$user]['name']),
      '#markup' => $this->t('Displaying Username is '.$userdata[$user]['name']),
    ];
  } else {
    $data = [
      '#title' => $this->t('Error'),
      '#markup' => $this->t('User Not Found'),
    ];
  }
    return $data;
  }
}