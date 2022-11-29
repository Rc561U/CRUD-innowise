<?php

namespace Crud\Mvc\app\models;

use Crud\Mvc\core\AbstractModel;
use Crud\Mvc\core\traits\Validator;
use PDO;

class User extends AbstractModel
{
    use Validator;

    public string $userEmailOld;

    public function createUser($request): bool|array
    {
        $postData = $request->getPost();
        $errors = $this->validate($postData);
        if (!$errors) {
            $query = $this->database->prepare("INSERT INTO  `test`.`users` (`email`,`full_name`,`gender`,`status`) VALUES (:email, :full_name, :gender, :status)");
            $query->execute([
                'email' => $postData['email'],
                'full_name' => $postData['name'],
                'gender' => $postData['gender'],
                'status' => $postData['status'],
            ]);
            return false;
        } else {
            return $errors;
        }
    }


    public function readUser(): array
    {
        $query = $this->database->query('SELECT * FROM test.users');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getUserById($id)
    {
        $sth = $this->database->prepare('SELECT * FROM `users` WHERE user_id = ?');
        $sth->execute([$id]);
        return $sth->fetch(PDO::FETCH_ASSOC) ?? false;
    }


    public function updateUserById($request)
    {
        $postData = $request->getPost();
        $this->userEmailOld = $this->getEmailById($postData['id']);
        $errors = $this->validate($postData);
        if (!$errors) {
            $query = $this->database->prepare("UPDATE users SET email = :email, full_name = :full_name, gender = :gender, status = :status WHERE user_id = :user_id ");
            $query->execute([
                'email' => $postData['email'],
                'full_name' => $postData['name'],
                'gender' => $postData['gender'],
                'status' => $postData['status'],
                'user_id' => $postData['id']
            ]);
        } else {
            return $errors;
        }
    }


    public function getEmailById($id)
    {
        $sth = $this->database->prepare('SELECT `email` FROM `users` WHERE user_id = ?');
        $sth->execute([$id]);
        return $sth->fetch(PDO::FETCH_ASSOC)['email'] ?? false;
    }


    public function deleteUserById($id)
    {
        $sql = 'DELETE FROM users WHERE user_id = :user_id';
        $statement = $this->database->prepare($sql);
        $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
        return $statement->execute();
    }


    public function getEmail($email)
    {
        $sth = $this->database->prepare('SELECT `email` FROM `users` WHERE `email` = ?');
        $sth->execute([$email]);
        return $sth->fetch(PDO::FETCH_ASSOC)['email'] ?? false;
    }

    function get_count($table): int
    {
        $res = $this->database->query("SELECT COUNT(*) FROM {$table}");
        return $res->fetchColumn();
    }

    function get_users($start, $per_page): array
    {
        $res = $this->database->query("SELECT * FROM `users` LIMIT $start, $per_page");
        return $res->fetchAll();
    }


    function deleteCheckedUsers(array $ids)
    {
        $query = "DELETE FROM `users` WHERE `user_id` in (" . str_repeat("?,", count($ids) - 1) . "?)";
        $stmt = $this->database->prepare($query);
        return $stmt->execute($ids);
    }
}
