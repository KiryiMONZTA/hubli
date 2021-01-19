<?php

namespace OxidSupport\Hubli\Model;

class Log
{
    private static ?Log $instance = null;
    private array $messages = [];
    
    private function __construct() { }

    public static function getInstance(): Log
    {
        if (self::$instance === null) {
            self::$instance = new Log();
        }

        return self::$instance;
    }

    public function addMessage(string $message): void
    {
        $this->messages[] = $message;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
