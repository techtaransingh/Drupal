<?php

namespace Drupal\first_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Class EditNodeUsersForm
 *
 * @package Drupal\first_module\Form
 */
class edit_node_users extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'edit_node_users';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $id = NULL)
    {
        // Fetch data for the specified ID
        $node = Node::load($id);

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => TRUE,
            '#default_value' => $node->field_name->value ?? '',
        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => TRUE,
            '#default_value' => $node->field_email->value ?? '',
        ];

        $form['profession'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Profession'),
            '#required' => TRUE,
            '#default_value' => $node->field_profession->value ?? '',
        ];

        $form['id'] = [
            '#type' => 'hidden',
            '#value' => $id,
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Update'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // Get form values
        $name = $form_state->getValue('name');
        $profession = $form_state->getValue('profession');
        $email = $form_state->getValue('email');

        // Get the node ID
        $id = $form_state->getValue('id');

        // Load the existing node
        $node = Node::load($id);

        // Update the node fields
        $node->field_name->value = $name;
        $node->field_profession->value = $profession;
        $node->field_email->value = $email;

        // Save the updated node
        $node->save();
        // \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        \Drupal::messenger()->addMessage(t('Edited successfully.'));
        // $form_state->setRedirect('first_module.nodeData');
    }
}