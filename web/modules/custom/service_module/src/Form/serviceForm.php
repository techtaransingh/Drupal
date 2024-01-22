<?php

namespace Drupal\service_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\service_module\Service\PasswordGeneratorService;


/**
 * Class RegisteredUsersForm
 *
 * @package Drupal\service_module\Form
 */
class serviceForm extends FormBase
{
    protected $passwordGeneratorService;

    public function __construct(PasswordGeneratorService $passwordGeneratorService)
    {
        $this->passwordGeneratorService = $passwordGeneratorService;
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('service_module.password_generator')
        );
    }
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'service_form';
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
        $form['email'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Email'),
            '#required' => TRUE,
        ];
        $form['phone'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Phone'),
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
        $name = $form_state->getValue('name');
        $email = $form_state->getValue('email');
        $phone = $form_state->getValue('phone');
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'service_users');
        $count = $query->count()->execute();
        // $passwordGeneratorService = \Drupal::service('password_generator');

        // Generate a password.
        $password = $this->passwordGeneratorService->generatePassword();

        $node = \Drupal\node\Entity\Node::create([
            'type' => 'service_users',
            'title' => $name,
            'field_service_user_email' => $email,
            'field_service_user_name' => $name,
            'field_service_user_phone' => $phone,
            'field_service_user_password' => $password

        ]);

        $node->save();
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node:' . $node->id()]);


        // Display a message
        \Drupal::messenger()->addMessage($this->t('Service User node saved successfully.'));


    }


}