<?php
namespace Drupal\first_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;


class WelcomeController extends ControllerBase
{
    public function welcome()
    {
        return array(
            '#markup' => 'Welcome to our Website.'
        );
    }
    public function demo()
    {
        $check = 'mitroooooo';
        return array(
            '#theme' => 'first_template',
            '#check' => $check
        );
    }
    public function theme()
    {

        return array(
            '#theme' => 'web_template',

        );
    }
    public function fetchData()
    {
        $query = \Drupal::database()->select('registered_users', 'ru');
        $query->fields('ru', ['id', 'name', 'mobile', 'email', 'age', 'gender']);
        $results = $query->execute()->fetchAll();
        return array(
            '#theme' => 'fetchData_template',
            '#results' => $results,
        );

    }

    public function deleteEntry($id = false)
    {
        $connection = \Drupal::database();
        $connection->delete('registered_users')
            ->condition('id', $id)
            ->execute();


        \Drupal::messenger()->addMessage(t('Deleted successfully.'));
        // Redirect to some page.
        return $this->redirect('first_module.fetchData');
    }



}


?>