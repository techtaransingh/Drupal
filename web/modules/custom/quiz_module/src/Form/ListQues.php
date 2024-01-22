<?php

namespace Drupal\quiz_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\node\Entity\Node;

class ListQues extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'ListQues';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['table'] = [
            '#type' => 'tableselect',
            '#header' => [
                'id' => $this->t('ID'),
                'question' => $this->t('Question'),
                'option1' => $this->t('Option1'),
                'option2' => $this->t('Option2'),
                'option3' => $this->t('Option3'),
                'option4' => $this->t('Option4'),
                'correct_option' => $this->t('Correct Option'),
                'subject' => $this->t('Subject'),
                // Add more columns as needed.
            ],
            '#options' => $this->quesData(), // Replace with your actual data.
            '#empty' => $this->t('No items found'),
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
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        echo 'uhyg';
        $quizName = $form_state->get('quizName');
        echo $quizName;
        die;
    }

    private function quesData()
    {
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'questions')
            ->condition('status', 1);
        $questionNids = $query->execute();
        $questions = \Drupal\node\Entity\Node::loadMultiple($questionNids);
        $data = [];


        foreach ($questions as $ques) {
            $taxonomy_term_reference = $ques->field_subject->entity;

            // Check if the term reference field is not empty.
            if ($taxonomy_term_reference) {
                // Get the subject name from the taxonomy term.
                $subject_name = $taxonomy_term_reference->getName();
            } else {
                $subject_name = '';
            }
            $data[] = [
                'id' => $ques->id(),
                'question' => $ques->label(),
                'option1' => $ques->field_option1->value,
                'option2' => $ques->field_option2->value,
                'option3' => $ques->field_option3->value,
                'option4' => $ques->field_option4->value,
                'correct_option' => $ques->field_correct_option->value,
                'subject' => $subject_name,
            ];
        }
        return $data;
    }

}