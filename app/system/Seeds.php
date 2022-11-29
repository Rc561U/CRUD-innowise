<?php

namespace Crud\Mvc\system;


use Faker\Factory;

class Seeds
{
    public object $faker;

    public function __construct()
    {
        $this->faker = Factory::create();

    }

    public function fillUserTable($model)
    {
        $genders = ['Male', 'Female'];
        $statuses = ['Active', 'Inactive'];
        foreach (range(0, 30) as $number) {
            $query = $model->prepare("INSERT INTO  `test`.`users` (`email`,`full_name`,`gender`,`status`) VALUES (:email, :full_name, :gender, :status)");
            $query->execute([
                'email' => $this->faker->unique()->email(),
                'full_name' => $this->faker->name(),
                'gender' => $genders[array_rand($genders)],
                'status' => $statuses[array_rand($statuses)],
            ]);
        }

    }

}