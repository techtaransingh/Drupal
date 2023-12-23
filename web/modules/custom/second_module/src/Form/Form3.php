<?php

namespace Drupal\second_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class Form3 extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'form3';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['city'] = [
            '#type' => 'textfield',
            '#title' => $this->t('City'),
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

    }


}