<?php

namespace Drupal\event_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\user\Entity\User;
use Drupal\event_module\Event\sendEmail;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class ClientForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'client_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Client Name'),

        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Client Email'),

        ];

        $form['phone'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Client Phone'),

        ];

        $form['photo'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Client Photo'),

        ];

        $form['address'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Client Address'),

        ];
        $users_data = $this->users();

        $form['task_assigned_to'] = [
            '#type' => 'select',
            '#title' => $this->t('Task Assigned to'),
            '#options' => $users_data,
            '#default_value' => null,


        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // // Get form values
        $name = $form_state->getValue('name');
        $phone = $form_state->getValue('phone');
        $email = $form_state->getValue('email');
        $photo =
            $address = $form_state->getValue('address');
        $file = $form_state->getValue('photo', 0);
        if (!empty($file)) {
            $photo = \Drupal\file\Entity\File::load($file[0]);
            // Save the file as a managed file.
            $photo->setPermanent();
            $photo->save();

        }
        $task_assigned_to = $form_state->getValue('task_assigned_to');

        $node = Node::create([
            'type' => 'lead',
            'title' => $name, // Dynamic title based on the count
            'field_client_name' => $name,
            'field_client_phone' => $phone,
            'field_client_email' => $email,
            'field_client_photo' => $photo,
            'field_client_address' => $address,
            'field_task_assigned_to' => $task_assigned_to,
            // Add other fields as needed.
        ]);

        $node->save();
        $event = new sendEmail($node);


        $event_dispatcher = \Drupal::service('event_dispatcher');
        $event_dispatcher->dispatch($event, sendEmail::EVENT_NAME);


        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);

        // // Display a message
        \Drupal::messenger()->addMessage($this->t('Lead information node saved successfully.'));

    }

    protected function users()
    {
        $query = \Drupal::entityQuery('user')->condition('status', 1);
        $user_ids = $query->execute();

        $users_data = [];
        if (!empty($user_ids)) {
            $users = User::loadMultiple($user_ids);
            foreach ($users as $user) {
                $users_data[$user->id()] = $user->getAccountName();
            }
        }

        return $users_data;
    }
}