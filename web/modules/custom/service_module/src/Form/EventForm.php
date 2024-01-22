<?php

namespace Drupal\service_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
// use Drupal\Core\Datetime\DrupalDateTime;

// use Symfony\Component\DependencyInjection\ContainerInterface;



/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\service_module\Form
 */
class EventForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'event_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {



        $form['event_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Event Name'),
            '#required' => TRUE,
        ];
        $form['date'] = [
            '#type' => 'date',
            '#title' => $this->t('Date'),
            '#required' => TRUE,
        ];
        $form['venue'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Venue'),
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
        $name = $form_state->getValue('event_name');
        $date = $form_state->getValue('date');

        // echo $date;
        // die;
        $venue = $form_state->getValue('venue');



        $node = \Drupal\node\Entity\Node::create([
            'type' => 'event',
            'title' => $name,
            'field_venue' => $venue,
            'field_event_name' => $name,
            'field_date' => $date,


        ]);

        $node->save();
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        // Display a message
        \Drupal::messenger()->addMessage($this->t('Event node saved successfully.'));


    }


}