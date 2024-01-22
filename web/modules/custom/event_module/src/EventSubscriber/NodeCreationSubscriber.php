<?php

namespace Drupal\event_module\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\event_module\Service\SendEmailService;
use Drupal\event_module\Event\sendEmail;
use Drupal\user\Entity\User;
use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigSave;

class NodeCreationSubscriber implements EventSubscriberInterface
{


  protected $SendEmailService;


  public function __construct(SendEmailService $SendEmailService)
  {
    $this->SendEmailService = $SendEmailService;
    // echo ConfigEvents::SAVE;
    // die;
  }



  public static function getSubscribedEvents()
  {
    return [
      sendEmail::EVENT_NAME => 'sendEmailEvent',
      'config.save' => 'configSave',
    ];
  }

  public function sendEmailEvent(sendEmail $sendEmail)
  {


    $nodeResult = $sendEmail->getNode();

    $assignedUserId = $nodeResult->get('field_task_assigned_to')->target_id;
    $user = User::load($assignedUserId);
    $userEmail = $user->getEmail();
    $userName = $user->getDisplayName();

    $module = 'second_module';
    $key = 'create_page';
    $to = 'techtaransingh@gmail.com';
    $params['message'] = 'Task assigned to ' . $userName;
    $params['node_title'] = 'Test Node';
    $langcode = 'ENG';
    $send = true;


    $this->SendEmailService->send_email_service($module, $key, $to, $langcode, $params, $send);


  }
  public function configSave(ConfigCrudEvent $event)
  {
    \Drupal::logger('event_module')->notice('Message from core subscribed event');
    echo 'config ccheck';
    die;
    \Drupal::messenger()->addMessage($this->t('Message from core subscribed event'));

  }
}