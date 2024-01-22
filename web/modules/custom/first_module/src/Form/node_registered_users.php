<?php

namespace Drupal\first_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class node_registered_users extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'node_registered_users_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),

        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email'),

        ];

        $form['profession'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Profession'),

        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $name = $form_state->getValue('name');
        $profession = $form_state->getValue('profession');
        $email = $form_state->getValue('email');
        if (empty($name)) {
            $form_state->setErrorByName('name', $this->t('Please provide the name.'));
        }
        if (empty($profession)) {
            $form_state->setErrorByName('profession', $this->t('Please provide the profession.'));
        }
        if (empty($email)) {
            $form_state->setErrorByName('email', $this->t('Please provide the email.'));
        }
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

        // Query to get the count of existing 'artist' nodes
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'artist');
        $count = $query->count()->execute();

        // Create a new 'artist' node
        $node = \Drupal\node\Entity\Node::create([
            'type' => 'artist',
            'title' => 'Entry ' . ($count + 1), // Dynamic title based on the count
            'field_name' => $name,
            'field_profession' => $profession,
            'field_email' => $email,
            // Add other fields as needed.
        ]);

        $node->save();
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        // Display a message
        \Drupal::messenger()->addMessage($this->t('User information node saved successfully.'));

    }

}