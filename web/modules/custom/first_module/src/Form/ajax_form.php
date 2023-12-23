<?php

namespace Drupal\first_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;


class ajax_form extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'ajax_plants_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {





        $form['field_plant_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Plant Title'),
            '#required' => TRUE,
            '#default_value' => '',
            '#suffix' => "<div id='field_plant_title-validation-message'></div>"
        ];

        $form['field_plant_description'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Plant Description'),
            '#required' => TRUE,
            '#default_value' => '',
            '#suffix' => "<div id='field_plant_description-validation-message'></div>"
        ];

        $form['actions'] = [
            '#type' => 'actions',
        ];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Send'),
            '#ajax' => [
                'callback' => '::submitFormAjax',
                'wrapper' => 'form-wrapper',
            ],
        ];
        // $form['#prefix'] =
        $form['#suffix'] = '<div id="form-wrapper"></div>';

        return $form;
    }

    public function submitFormAjax(array &$form, FormStateInterface $form_state)
    {
        if ($form_state->hasAnyErrors()) {
            $response = new AjaxResponse();

            foreach ($form_state->getErrors() as $name => $error) {
                $error_message = $error->render();
                $response->addCommand(new HtmlCommand("#$name-validation-message", $error_message));
            }

            return $response;
        }

        $title = $form_state->getValue('field_plant_title');
        $description = $form_state->getValue('field_plant_description');

        $node = \Drupal\node\Entity\Node::create([
            'type' => 'plants',
            'title' => $title,
            'field_plant_description' => $description,
        ]);

        $node->save();

        // Create an AjaxResponse for the success message.
        $response_text = $this->t('Hello, @title! Node created successfully.', ['@title' => $title]);
        $response = new AjaxResponse();
        $response->addCommand(new HtmlCommand('#form-wrapper', $response_text));

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $title = $form_state->getValue('field_plant_title');
        $description = $form_state->getValue('field_plant_description');

        if (empty($title)) {
            $form_state->setErrorByName('field_plant_title', $this->t('Please provide the job title.'));
        }

        if (empty($description)) {
            $form_state->setErrorByName('field_plant_description', $this->t('Please provide the job description.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $this->messenger()->addStatus($this->t('The message has been sent.'));
        $form_state->setRedirect('<front>');
    }

}