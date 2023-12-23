<?php

namespace Drupal\second_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class Chef extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'chef';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {



        $form['field_chefname'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Chef Name'),
            '#required' => TRUE,
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
        $field_chefname = $form_state->getValue('field_chefname');
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'chef');
        $count = $query->count()->execute();


        $node = \Drupal\node\Entity\Node::create([
            'type' => 'chef',
            'title' => $field_chefname,
            'field_chefname' => $field_chefname,


        ]);

        $node->save();
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        // Display a message
        \Drupal::messenger()->addMessage($this->t('Chef node saved successfully.'));


    }


}