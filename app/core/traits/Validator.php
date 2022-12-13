<?php

namespace Crud\Mvc\core\traits;

trait Validator
{
    public array $errors = [];

    public function validate($requestData)
    {
        $this->checkEmail($requestData['email'] ?? null);
        $this->checkFullName($requestData['name'] ?? null);
        $this->checkGender($requestData['gender'] ?? null);
        $this->checkStatus($requestData['status'] ?? null);
        return $this->errors;
    }


    public function checkEmail($email, $flag = false): void
    {
//        if ($flag && !$this->isEmailExist($email)) {
//            $this->errors['email'] = 'UsersApi with this email is not exists';
//        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'No valid email';
        }

        if (isset($this->userEmailOld)) {
            if ($this->userEmailOld !== $email && $this->getEmail($email)) {
                $this->errors['email'] = 'Email already exists';
            }
        } else {
            if ($this->getEmail($email)) {
                $this->errors['email'] = 'Email already exists';
            }
        }

    }

    public function checkFullName($name): void
    {
        if (!preg_match("/^([a-zA-Z' ]+)$/", $name)) {
            $this->errors['name'] = 'Name has unsupported type';
        }
    }

    public function checkGender($gender)
    {
        if (!($gender === "Male" or $gender === "Female")) {
            $this->errors['gender'] = 'Gender false';
        }
    }

    public function checkStatus($status)
    {
        if (!($status == "Active" or $status == "Inactive")) {
            $this->errors['status'] = 'Status false';
        }
    }

}