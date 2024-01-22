<?php

namespace Drupal\quiz_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\node\Entity\Node;

/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\first_module\Form
 */
class AddQues extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'AddQues';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Retrieve terms from the 'your_vocabulary_name' vocabulary.
        $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('subjects');

        // Build an array of term names keyed by term ID.
        $subject_options = [];
        foreach ($terms as $term) {
            $subject_options[$term->tid] = $term->name;
        }


        $form['question'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Question'),

        ];

        $form['option1'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Option 1'),

        ];

        $form['option2'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Option 2'),

        ];
        $form['option3'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Option 3'),

        ];
        $form['option4'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Option 4'),

        ];
        $form['correctOption'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Correct option'),

        ];
        $form['subject'] = [
            '#type' => 'select',
            '#title' => $this->t('Select Subject'),
            '#options' => $subject_options,

        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        // $name = $form_state->getValue('name');
        // $profession = $form_state->getValue('profession');
        // $email = $form_state->getValue('email');
        // if (empty($name)) {
        //     $form_state->setErrorByName('name', $this->t('Please provide the name.'));
        // }
        // if (empty($profession)) {
        //     $form_state->setErrorByName('profession', $this->t('Please provide the profession.'));
        // }
        // if (empty($email)) {
        //     $form_state->setErrorByName('email', $this->t('Please provide the email.'));
        // }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {

        $question = $form_state->getValue('question');
        $option1 = $form_state->getValue('option1');
        $option2 = $form_state->getValue('option2');
        $option3 = $form_state->getValue('option3');
        $option4 = $form_state->getValue('option4');
        $correctOption = $form_state->getValue('correctOption');
        $subject = $form_state->getValue('subject');

        $query = \Drupal::entityQuery('node')
            ->condition('type', 'questions');
        $count = $query->count()->execute();
        // Create and save the quiz node.
        $node = Node::create([
            'type' => 'questions',
            'title' => $question,
            'field_option1' => $option1,
            'field_option2' => $option2,
            'field_option3' => $option3,
            'field_option4' => $option4,
            'field_correct_option' => $correctOption,
            'field_subject' => $subject,
        ]);

        $node->save();
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        // Display a message
        \Drupal::messenger()->addMessage($this->t('Question node saved successfully.'));
    }

}