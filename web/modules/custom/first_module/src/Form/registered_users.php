<?php

namespace Drupal\first_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class registered_users extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'registered_users_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => TRUE,
        ];

        $form['mobile'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile'),
            '#required' => TRUE,
        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => TRUE,
        ];

        $form['age'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Age'),
            '#required' => TRUE,
        ];

        $form['gender'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Gender'),
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
        // Get form values
        $name = $form_state->getValue('name');
        $mobile = $form_state->getValue('mobile');
        $email = $form_state->getValue('email');
        $age = $form_state->getValue('age');
        $gender = $form_state->getValue('gender');

        // Save form values to your custom table
        $connection = \Drupal::database();
        $connection->insert('registered_users')
            ->fields([
                'name' => $name,
                'mobile' => $mobile,
                'email' => $email,
                'age' => $age,
                'gender' => $gender,
            ])
            ->execute();
        $messenger = \Drupal::messenger();

        $messenger->addMessage($this->t('User information saved successfully.'));
    }
    public function fetchData()
    {
        $query = \Drupal::database()->select('registered_users', 'ru');
        $query->fields('ru', ['id', 'name', 'mobile', 'email', 'age', 'gender']);
        $results = $query->execute()->fetchAll();
        return $results;
    }

}