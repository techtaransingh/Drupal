<?php

namespace Drupal\second_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\second_module\Form
 */
class FormList extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'FormList';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'chef')
            ->condition('status', 1);

        $nids = $query->execute();

        $chef_options = [];
        if (!empty($nids)) {
            $nodes = Node::loadMultiple($nids);

            foreach ($nodes as $node) {

                $chef_name = $node->get('field_chefname')->value;
                $chef_id = $node->id();
                // Add the chef name to the options array.
                $chef_options[$chef_id] = $chef_name;
            }
        }



        $form['field_created_by'] = [
            '#type' => 'select',
            '#title' => $this->t('Created By(Chef Name)'),
            '#required' => TRUE,
            '#options' => $chef_options,

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
        $chefId = $form_state->getValue('field_created_by');
        $session = \Drupal::service('session');
        $session->set('chefId', $chefId);

        return $this->redirect('second_module.formList');
    }


}