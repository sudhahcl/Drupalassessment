<?php

namespace Drupal\custom_user_register\Event;

use Symfony\Component\EventDispatcher\Event;

class UserDetailEvent extends Event {

  const USERFUNCTION = 'userevent.submit';
  public $lastid;

  public function __construct($lastid)
  {
    
    $this->lastid = $lastid;
  }


}