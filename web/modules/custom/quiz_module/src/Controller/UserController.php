<?php
namespace Drupal\quiz_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;

class UserController extends ControllerBase
{
    public function userDashboard()
    {
        $current_user = \Drupal::currentUser();
        $uid = $current_user->id();
        $username = $current_user->getAccountName();
        $role = $current_user->getRoles();
        // print_r($username);
        // die;


        return array(
            '#theme' => 'user_template',
            '#role' => $role,
            '#username' => $username,

        );
    }
    public function listQuestions()
    {
        // $query = \Drupal::entityQuery('node')
        //     ->condition('type', 'questions')
        //     ->condition('status', 1);
        // $questionNids = $query->execute();
        // $questions = \Drupal\node\Entity\Node::loadMultiple($questionNids);
        // $data = [];
        // foreach ($questions as $ques) {
        //     $data[] = [
        //         'id' => $ques->id(),
        //         'question' => $ques->label(),
        //         'option1' => $ques->field_option1->value,
        //         'option2' => $ques->field_option2->value,
        //         'option3' => $ques->field_option3->value,
        //         'option4' => $ques->field_option4->value,
        //         'correct_option' => $ques->field_correct_option->value,
        //         'subject' => $ques->field_subject->value,
        //     ];
        // }
        // print_r($data);
        // die;
        return \Drupal::formBuilder()->getForm('Drupal\quiz_module\Form\ListQues');

    }

    public function listQuiz()
    {
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'quiz')
            ->condition('status', 1);
        $quizNids = $query->execute();
        $quiz = \Drupal\node\Entity\Node::loadMultiple($quizNids);
        return array(
            '#theme' => 'quiz_template',
            '#quiz' => $quiz, );
    }
    public function questionList_quiz($id = false)
    {
        echo $id;
        echo 'ojiuh';
    }
}
?>