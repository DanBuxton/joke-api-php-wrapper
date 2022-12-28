<?php

namespace JokeApiWrapper\Exceptions;

use Exception;

class MalformedResponse extends Exception
{
    public function __construct(string $message = "Malformed JSON")
    {
        parent::__construct($message);
    }
}