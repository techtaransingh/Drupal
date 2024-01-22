<?php
namespace Drupal\service_module\Service;

use Drupal\Core\Datetime\DrupalDateTime;

class EventDateService
{
    // public function __construct()
    // {
    //     echo 'event date construct ';
    //     die;
    // }
    public function check_date($date)
    {
        // Get today's date formatted as 'Y-m-d' without time
        $today = (new DrupalDateTime('now'))->format('Y-m-d');

        // Get the date from the input formatted as 'Y-m-d' without time
        $fieldDate = (new DrupalDateTime($date))->format('Y-m-d');

        // echo $fieldDate . '</br>';
        // echo $today . '</br>';
        if ($fieldDate > $today) {
            $action = 'The event is in the future.';
        } elseif ($fieldDate < $today) {
            $action = 'The event has already occurred.';
        } else {
            $action = 'The event is today.';
        }
        // die;
        return [
            'action' => $action,
            'today' => $today
        ];
    }
}

?>