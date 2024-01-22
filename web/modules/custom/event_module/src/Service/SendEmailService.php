<?php
namespace Drupal\event_module\Service;



class SendEmailService
{
    public function test()
    {
        echo 'taran';

    }
    public function send_email_service($module, $key, $to, $langcode, $params, $send)
    {
        $mailManager = \Drupal::service('plugin.manager.mail');


        $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
        // print_r($result);
        // die;
        if ($result['result'] !== true) {

            \Drupal::messenger()->addMessage(t('There was a problem sending your message and it was not sent'), 'error');

        } else {

            \Drupal::messenger()->addMessage(t('Your message has been sent.'), 'status');

        }



    }
}