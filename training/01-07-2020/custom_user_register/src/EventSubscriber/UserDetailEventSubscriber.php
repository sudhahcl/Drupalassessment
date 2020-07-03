<?php

/**
 * @file
 * Contains \Drupal\user_details\UserDetailEventSubscriber.
 */
namespace Drupal\custom_user_register\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\custom_user_register\Event\UserDetailEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class UserDetailEventSubscriber.
 *
 * @package Drupal\custom_user_register
 */

class UserDetailEventSubscriber implements EventSubscriberInterface {
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {	
	return [
      UserDetailEvent::USERFUNCTION => 'DetailFun',
    ];

  }

  /**
   * Subscriber Callback for the event.
   * @param UserDetailEvent $userdetailevent
   */
  public function DetailFun(UserDetailEvent $userdetailevent) {
   
  $response = new RedirectResponse('custom_user_profile_form_list/'.$userdetailevent->lastid);
  $response->send();
  }


}