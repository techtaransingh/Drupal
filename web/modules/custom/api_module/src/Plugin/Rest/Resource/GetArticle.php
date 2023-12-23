<?php

namespace Drupal\api_module\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\node\Entity\Node;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "articles",
 *   label = @Translation("Article Listing"),
 *   uri_paths = {
 *     "canonical" = "/get/articles",
 *     "create"="/post/check"
 *   }
 * )
 */
class GetArticle extends ResourceBase
{

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get()
    {
        $response['is_success'] = false;
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'article')
            ->condition('status', 1);
        $result = $query->execute();
        $nodes = Node::loadMultiple($result);
        $data = [];
        foreach ($nodes as $node) {

            $title = $node->get('title')->value;
            $langcode = $node->get('langcode')->value;
            $status = $node->get('status')->value;

            $data[] = [
                'title' => $title,
                'langcode' => $langcode,
                'status' => $status,

            ];
        }
        if (!empty($data)) {
            $response['is_success'] = true;
            $response['data'] = $data;

        } else {
            $response['error'] = 'Something went wrong';
        }

        return new ResourceResponse($response);
    }
    public function post()
    {
        return new ResourceResponse('jhkfb ubioun');
    }
}