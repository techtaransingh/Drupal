<?php
namespace Drupal\second_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;

class RecipeController extends ControllerBase
{

    public function formList()
    {
        $session = \Drupal::service('session');
        $chefId = $session->get('chefId');
        if (isset($chefId)) {
            $id = $chefId;
            // Unset the session variable.
            $session->remove('chefId');
            $query = \Drupal::entityQuery('node')
                ->condition('type', 'recipe')
                ->condition('field_created_by', $id)
                ->condition('status', 1);

            $nids = $query->execute();

            $data = [];
            if (!empty($nids)) {
                $nodes = Node::loadMultiple($nids);

                foreach ($nodes as $node) {

                    $dish = $node->get('field_dish')->value;
                    $ingredients = $node->get('field_ingredients')->value;
                    $preptime = $node->get('field_preptime')->value;
                    $image = $node->get('field_recipe_image')->entity;

                    if (!empty($image)) {

                        $image_url = $image->createFileUrl();


                    }
                    // print_r($image_url);


                    $data[] = [
                        'field_dish' => $dish,
                        'field_ingredients' => $ingredients,
                        'field_preptime' => $preptime,
                        'field_recipe_image' => $image_url,
                    ];
                }
            }
            // print_r($data);
            // die;
        }


        $listForm = \Drupal::formBuilder()->getForm('Drupal\second_module\Form\FormList');



        return array(
            '#theme' => 'chef_template',
            '#listForm' => $listForm,
            '#data' => $data,
        );
    }



}


?>