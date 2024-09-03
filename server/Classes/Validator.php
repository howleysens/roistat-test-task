<?php
namespace Classes;

class Validator
{
    public static function validate($name, $email, $phone, $price, $isSpentTimeOut)
    {
        $errors = [];

        if (empty($name)) {
            $errors[] = "Name field is required.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if ($price <= 0 || !is_numeric($price)) {
            $errors[] = "Price should be positive number.";
        }

        return $errors;
    }
}
