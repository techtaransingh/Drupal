<?php

namespace Drupal\api_module\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Demo Resource.
 *
 * @RestResource(
 *   id = "chefForm",
 *   label = @Translation("Chef Form Inputs"),
 *   uri_paths = {
 *    
 *     "create" = "/post/chef"
 *   }
 * )
 */
class PostChef extends ResourceBase
{

    /**
     * Responds to entity Post requests.
     *
     * @param array $data
     *   The incoming data.
     *
     * @return \Drupal\rest\ResourceResponse
     *   The response object.
     */

    // public function get()
    // {
    //     return new ResourceResponse('higyutf ukj');
    // }
    public function post(array $data = [])
    {
        print_r($data);
        // save the data into node further

        return new ResourceResponse($data);
    }

}