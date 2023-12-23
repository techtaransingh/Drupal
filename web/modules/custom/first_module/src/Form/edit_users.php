<?php

namespace Drupal\first_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class edit_users extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'edit_users';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $id = NULL)
    {
        // Fetch data for the specified ID
        $result = $this->fetchData($id);

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => TRUE,
            '#default_value' => isset($result->name) ? $result->name : '',
        ];

        $form['mobile'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile'),
            '#required' => TRUE,
            '#default_value' => isset($result->mobile) ? $result->mobile : '',
        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => TRUE,
            '#default_value' => isset($result->email) ? $result->email : '',
        ];

        $form['age'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Age'),
            '#required' => TRUE,
            '#default_value' => isset($result->age) ? $result->age : '',
        ];

        $form['gender'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Gender'),
            '#required' => TRUE,
            '#default_value' => isset($result->gender) ? $result->gender : '',
        ];

        $form['id'] = [
            '#type' => 'hidden',
            '#value' => isset($result->id) ? $result->id : '',
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
        $mobile = $form_state->getValue('mobile');
        $email = $form_state->getValue('email');
        $age = $form_state->getValue('age');
        $gender = $form_state->getValue('gender');

        // Check if there's an existing record to update
        $existingRecordId = $form_state->getValue('id'); // Replace 'record_id' with the actual ID field name in your table

        if ($existingRecordId) {
            // Update existing record
            $connection = \Drupal::database();
            $connection->update('registered_users')
                ->fields([
                    'name' => $name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'age' => $age,
                    'gender' => $gender,
                ])
                ->condition('id', $existingRecordId) // Replace 'id' with the actual ID field name in your table
                ->execute();



        }
        \Drupal::messenger()->addMessage(t('Edited successfully.'));
        return $this->redirect('first_module.fetchData');
    }



    /**
     * Fetch data for the specified ID.
     *
     * @param int $id
     *   The entry ID to fetch.
     *
     * @return object
     *   The database result object.
     */
    public function fetchData($id)
    {
        $query = \Drupal::database()->select('registered_users', 'ru');
        $query->fields('ru', ['id', 'name', 'mobile', 'email', 'age', 'gender']);
        $query->condition('ru.id', $id);
        $result = $query->execute()->fetch();

        return $result;
    }
}