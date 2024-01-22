<?php

namespace Drupal\service_module\Service;

/**
 * Service for generating passwords.
 */
class PasswordGeneratorService
{

    /**
     * Generates a random password.
     *
     * @param int $length
     *   The length of the password.
     *
     * @return string
     *   The generated password.
     */
    public function generatePassword($length = 12)
    {
        // Your password generation logic goes here.
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_';
        $password = '';
        $charactersLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }

        return $password;
    }

}