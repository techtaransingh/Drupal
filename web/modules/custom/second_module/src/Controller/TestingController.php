<?php
namespace Drupal\second_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class TestingController extends ControllerBase
{
    public function testing()
    {
        $people = [
            ['name' => 'Rajesh', 'age' => 25, 'phone' => '1234567890'],
            ['name' => 'Harman', 'age' => 30, 'phone' => '9876543210'],
            ['name' => 'Rajkumar', 'age' => 22, 'phone' => '5551234567'],
            ['name' => 'Bobby', 'age' => 28, 'phone' => '7893216540'],
        ];


        return array(
            '#theme' => 'second_template',
            '#people' => $people,
        );
    }

}


?>