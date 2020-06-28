<?php

/**
 * @file
 * Contains \Drupal\user_details\UserDetailEventSubscriber.
 */
namespace Drupal\user_details\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\user_details\Event\UserDetailEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class UserDetailEventSubscriber.
 *
 * @package Drupal\user_details
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
   // echo "TEST";
    // return "The Example Event has been subscribed, which has bee dispatched on submit of the form with " . $userdetailevent->getloggerMsg() . " as Reference");
  // echo "test event subcriber";
  // print_r($userdetailevent->lastid);
  // // die("Test");
  // print_r($userdetailevent->first_name);
  // exit;
	\Drupal::logger('user_details')->notice("User Detail Inserted Successfully.");
  }


}