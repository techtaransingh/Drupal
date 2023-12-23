<?php

namespace Drupal\api_module\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\node\Entity\Node;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "recipe",
 *   label = @Translation("Recipe Data Listing"),
 *   uri_paths = {
 *     "canonical" = "/get/recipes"
 *   }
 * )
 */
class GetRecipe extends ResourceBase
{

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get()
    {
        $response['is_success'] = false;
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'recipe')
            ->condition('status', 1);

        $nids = $query->execute();
        $nodes = Node::loadMultiple($nids);
        $data = [];
        foreach ($nodes as $node) {

            $dish = $node->get('field_dish')->value;
            $ingredients = $node->get('field_ingredients')->value;
            $preptime = $node->get('field_preptime')->value;
            $image = $node->get('field_recipe_image')->entity;

            // if (!empty($image)) {

            //     $image_url = $image->createFileUrl();
            // }
            $data[] = [
                'field_dish' => $dish,
                'field_ingredients' => $ingredients,
                'field_preptime' => $preptime,
                'field_recipe_image' => $image,
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

}