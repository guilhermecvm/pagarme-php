<?php

namespace Guilhermecvm\Pagarme\Exceptions;

class RequestException extends \Exception
{
    protected $errors;
    protected $url;
    protected $method;

    public function __construct($response, $code = 0, Exception $previous = null)
    {
        $this->errors = isset($response['errors']) ? $response['errors'] : [];
        $this->url = isset($response['url']) ? $response['url'] : null;
        $this->method = isset($response['method']) ? $response['method'] : null;

        if (empty($this->errors)) {
            $message = 'Ocorreu um erro inesperado.';
        }
        else {
            $message = implode(', ', array_map(function($error) {
                // parameter_name
                // type
                // message
                return $error['message'];
            }, $this->errors));
        }


        parent::__construct($message, $code, $previous);
    }
}
