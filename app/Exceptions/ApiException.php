<?php

namespace App\Exceptions;

use Exception;
use Log;

class ApiException extends Exception
{
    protected $errors = [];
    protected $data = [];

    
    public function __construct($errors = [], $data = [], $code = 422)
    {
        $message = '';

        if (!is_array($errors))
            $errors = [$errors];

        $firstError = reset($errors);

        if (array_key_exists('message', $errors)) {
            $message = $errors['message'];
            unset($errors['message']);
        }

        if (!$message && is_array($firstError) && (array_key_exists('message', $firstError) || property_exists($firstError, 'message')))
            $message = $firstError['message'] ?? $firstError->message;

        if (!$message && is_string($firstError))
            $message = $firstError;

        if (!$message)
            $message = 'An error occurred while processing the request';

        parent::__construct($message);

        $local = $this->getTrace()[0];
        
        $this->errors = $errors;
        $this->data = $data;
        $this->code = $code;
        $this->file = $local['file'];
        $this->line = $local['line'];
    }


    public function getErrors()
    {
        return $this->errors;
    }


    public function getData()
    {
        return $this->data;
    }
}