<?php

namespace Drupal\quiz_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\node\Entity\Node;

class PrepareQuiz extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'PrepareQuiz';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['quizName'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Quiz Name'),
            '#required' => TRUE,
        ];

        $form['level'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Difficulty Level'),
        ];


        $form['date'] = [
            '#type' => 'date',
            '#title' => $this->t('Conducted Date'),
            '#required' => TRUE,
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Next'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $quizName = $form_state->getValue('quizName');


        if (empty($quizName)) {
            $form_state->setErrorByName('quizName', $this->t('Please provide the quiz name.'));
        }


    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // $quizName = $form_state->getValue('quizName');
        // $date = $form_state->getValue('date');
        // $level = $form_state->getValue('level');
        // $subject = $form_state->getValue('subject');

        // // Check if the quiz title already exists.
        // $query = \Drupal::entityQuery('node')
        //     ->condition('type', 'quiz')
        //     ->condition('title', $quizName);
        // $count = $query->count()->execute();

        // if ($count == 0) {
        //     // Create and save the quiz node.
        //     $node = Node::create([
        //         'type' => 'quiz',
        //         'title' => $quizName,
        //         'field_quiz_date' => $date,
        //         'field_quiz_level' => $level,
        //         'field_quiz_subject' => $subject,
        //     ]);

        //     $node->save();

        //     // Create and save the taxonomy term.
        //     $term = Term::create([
        //         'vid' => 'subjects', // Replace 'subjects' with the machine name of your vocabulary.
        //         'name' => $subject,
        //     ]);
        //     $term->save();
        //     \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        //     // Display a message
        //     \Drupal::messenger()->addMessage($this->t('Quiz node saved successfully.'));

        // } else {
        //     \Drupal::messenger()->addMessage($this->t('A quiz with the title "%quiz" already exists.', ['%quiz' => $quizName]), 'error');
        // }
    }


}