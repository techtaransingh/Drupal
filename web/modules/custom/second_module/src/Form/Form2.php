<?php

namespace Drupal\second_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class Form2 extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'form2';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {



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