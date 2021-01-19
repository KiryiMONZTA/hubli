<?php

namespace OxidSupport\Hubli\Model;

class ContactList
{
    private static ?Object $instance = null;
    private array $list = [];
    
    private function __construct() { }

    public static function getInstance(): ContactList
    {
        if (self::$instance === null) {
            self::$instance = new ContactList();
        }

        return self::$instance;
    }

    public function getList(): array
    {
        return $this->list;
    }

    public function addContactToList(Contact $newContact): void
    {
        $duplicate = false;

        foreach ($this->list as $contact) {
            if ($contact->getEmail() == $newContact->getEmail()) {
                $duplicate = true;
                break;
            }
        }

        if (!$duplicate) {
            $this->list[] = $newContact;
        }
    }
}
