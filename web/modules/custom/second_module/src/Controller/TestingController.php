<?php

namespace Drupal\second_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for wcp_module routes.
 */
class TestingController extends ControllerBase
{

    /**
     * Builds the response.
     */
    public function email_testing()
    {

        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'second_module';
        $key = 'create_page';
        $to = 'techtaransingh@gmail.com';
        $params['message'] = 'Testing from website ';
        $params['node_title'] = 'Test Node';
        $langcode = 'ENG';
        $send = true;

        $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

        if ($result['result'] !== true) {

            \Drupal::messenger()->addMessage(t('There was a problem sending your message and it was not sent'), 'error');

        } else {

            \Drupal::messenger()->addMessage(t('Your message has been sent.'), 'status');

        }

        $build['content'] = [
            '#type' => 'item',
            '#markup' => $this->t('It works!'),
        ];

        return $build;
    }
    public function email_testing2()
    {

        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'second_module';
        $key = 'welcome_page';
        $to = 'techtaransingh@gmail.com';
        $params['message'] = 'Testing from website ';
        $params['node_title'] = 'Test welcome Node';
        $langcode = 'ENG';
        $send = true;
        $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

        if ($result['result'] !== true) {

            \Drupal::messenger()->addMessage(t('There was a problem sending your message and it was not sent'), 'error');

        } else {

            \Drupal::messenger()->addMessage(t('Your message has been sent.'), 'status');

        }

        $build['content'] = [
            '#type' => 'item',
            '#markup' => $this->t('It works!'),
        ];

        return $build;
    }


}