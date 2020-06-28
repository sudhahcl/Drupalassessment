<?php

namespace Drupal\user_details\Event;

use Symfony\Component\EventDispatcher\Event;

class UserDetailEvent extends Event {

  const USERFUNCTION = 'userevent.submit';
  public $lastid;

  public function __construct($lastid)
  {
    
    // $this->loggerMsg = $loggerMsg;
    $this->lastid = $lastid;
    // $this->first_name = $first_name;
  }

  // public function getloggerMsg()
  // {
  //   return $this->lastid;
  // }
}