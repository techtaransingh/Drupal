<?php

namespace Drupal\second_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\second_module\Form
 */
class Recipe extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'recipe';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'chef')
            ->condition('status', 1);

        $nids = $query->execute();

        $chef_options = [];
        if (!empty($nids)) {
            $nodes = Node::loadMultiple($nids);

            foreach ($nodes as $node) {

                $chef_name = $node->get('field_chefname')->value;
                $chef_id = $node->id();
                // Add the chef name to the options array.
                $chef_options[$chef_id] = $chef_name;
            }
        }
    
        $form['field_dish'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Dish'),
            '#required' => TRUE,
        ];
        $form['field_ingredients'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Ingredients'),
            '#required' => TRUE,
        ];
        $form['field_preptime'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Prep Time'),
            '#required' => TRUE,
        ];

        $form['field_created_by'] = [
            '#type' => 'select',
            '#title' => $this->t('Created By(Chef Name)'),
            '#required' => TRUE,
            '#options' => $chef_options,

        ];
        $form['field_recipe_image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Upload Image'),
            // '#description' => $this->t('Upload an image file'),
            '#upload_validators' => [
            'file_validate_extensions' => ['png gif jpg jpeg'],
              ],
            //   '#required' => TRUE,
          ];
       

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $file = $form_state->getValue('field_recipe_image',0);
        
        // Get form values
        $dish = $form_state->getValue('field_dish');
        $ingredients = $form_state->getValue('field_ingredients');
        $preptime = $form_state->getValue('field_preptime');
        $created_by = $form_state->getValue('field_created_by');
// echo $chefId;
// die;
 if (!empty($file)) {
      $file = \Drupal\file\Entity\File::load($file[0]);
      // Save the file as a managed file.
      $file->setPermanent();
      $file->save();

    }

        $query = \Drupal::entityQuery('node')
            ->condition('type', 'recipe');
        $count = $query->count()->execute();


        $node = \Drupal\node\Entity\Node::create([
            'type' => 'recipe',
            'title' => $dish,
            'field_dish' => $dish,
            'field_ingredients' => $ingredients,
            'field_preptime' => $preptime,
            'field_created_by' => $created_by,
            'field_recipe_image' =>$file,
        ]);

        $node->save();
//         print_r($file);
// die;
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        // Display a message
        \Drupal::messenger()->addMessage($this->t('Recipe node saved successfully.'));

    }


}