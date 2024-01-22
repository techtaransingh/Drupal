<?php

namespace Drupal\service_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\service_module\Service\MyApiService;
use Drupal\service_module\Service\EventDateService;





/**
 * MyApiController class.
 */
class MyApiController extends ControllerBase
{

    protected $apiClient;
    protected $dateEvent;

    public function __construct(MyApiService $api_client, EventDateService $dateEvent)
    {
        $this->apiClient = $api_client;
        $this->dateEvent = $dateEvent;
    }

    public static function create(ContainerInterface $container)
    {

        return new static(
            $container->get('service_module.external_api_data'),
            $container->get('service_module.event_date')
        );
    }


    /**
     * Controller callback.
     */
    public function myApiCallback()
    {
        $apiUrl = 'https://jsonplaceholder.typicode.com/posts';
        $apiResponse = $this->apiClient->callApi($apiUrl);
        // print_r($apiResponse);
        // die;


        return array(
            '#theme' => 'apiData_template',
            '#results' => $apiResponse,
        );

    }
    public function externalApi()
    {
        $url = 'https://dummyjson.com/users';
        $response = \Drupal::httpClient()->get($url);
        $data = json_decode($response->getBody(), TRUE);
        print_r($data);
        die;
        return $data;
    }
    public function event_list()
    {
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'event') // Specify the content type
            ->condition('status', 1);
        $artistNids = $query->execute();
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node_list:event']);

        $events = \Drupal\node\Entity\Node::loadMultiple($artistNids);
        $data = [];
        foreach ($events as $event) {
            $date_check = $this->dateEvent->check_date($event->field_date->value);
            $data[] = [
                'id' => $event->id(),
                'date' => $event->field_date->value,
                'event_name' => $event->field_event_name->value,
                'venue' => $event->field_venue->value,
                'date_check' => $date_check['action'],
                'today' => $date_check['today'],

            ];
        }
        // print_r($date_check);
        // die;

        return array(
            '#theme' => 'event_list_template',
            '#data' => $data,
        );
    }
}