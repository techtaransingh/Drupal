<?php

namespace Drupal\second_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class Form1 extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'form1';
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