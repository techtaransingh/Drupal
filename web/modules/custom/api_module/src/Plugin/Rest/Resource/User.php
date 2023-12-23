<?php

namespace Drupal\api_module\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\node\Entity\Node;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "user",
 *   label = @Translation("User Data"),
 *   uri_paths = {
 *     "canonical" = "/get/users",
 *     "create" = "/post/users"
 *   }
 * )
 */
class User extends ResourceBase
{

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get()
    {
        $response['is_success'] = false;
        $query = \Drupal::entityQuery('user')
            ->condition('status', 1);
        $user_ids = $query->execute();
        $users = \Drupal\user\Entity\User::loadMultiple($user_ids);


        if (!empty($users)) {
            $response['is_success'] = true;
            $response['data'] = $users;

        } else {
            $response['error'] = 'Something went wrong';
        }

        return new ResourceResponse($response);
    }

    /**
     * Responds to entity Post requests.
     *
     * @param array $data
     *   The incoming data.
     *
     * @return \Drupal\rest\ResourceResponse
     *   The response object.
     */
    public function post($data = [])
    {
        $response['is_success'] = false;
        if (!empty($data['name']) && !empty($data['email']) && !empty($data['password'] && !empty($data['status']))) {

            $user = \Drupal\user\Entity\User::create([
                'name' => $data['name'],
                'mail' => $data['email'],
                'pass' => $data['password'],
                'status' => $data['status'],

            ]);

            if ($user->save()) {
                $response['msg'] = 'User added successfully';
                $response['is_success'] = true;
            } else {
                $response['msg'] = 'Something went wrong';
            }
        } else {

            foreach ($data as $key => $value) {
                if (empty($value)) {
                    $response['msg'][] = $key . ' is required';
                }
            }

        }

        return new ResourceResponse($response);
    }
}