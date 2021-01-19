<?php

namespace OxidSupport\Hubli\Model;

class Contact
{
    private const LOGMSG_PREFERREDLANGUAGE_MISSING = 'Preferred language of contact <i>%s</i> was missing and set to the standard language.';
    private const LOGMSG_PREFERREDLANGUAGE_UNIDENTIFIED = 'Preferred language of contact <i>%s</i> was unidentified and set to the standard language.';
    private const LOGMSG_SALUTATION_MISSING = 'Salutation of contact <i>%s</i> was missing and should be set in the CRM.';
    private const LOGMSG_SALUTATION_UNIDENTIFIED = 'Salutation of contact <i>%s</i> was unidentified and should be verified in the CRM.';
    private const LOGMSG_FIRSTNAME_MISSING = 'First name of contact <i>%s</i> was missing.';
    private const LOGMSG_LASTNAME_MISSING = 'Last name of contact <i>%s</i> was missing.';
    private const LOGMSG_EMAIL_MISSING = 'FATAL: E-mail of a contact was missing. The contact was not added to the contact list!';

    private string $preferredLanguage = '';
    private string $salutation = '';
    private string $firstName = '';
    private string $lastName = '';
    private string $email = '';

    public function __construct(
        string $preferredLanguage,
        string $salutation,
        string $firstName,
        string $lastName,
        string $email
    ) {
        $this->setEmail($email);

        if ($this->email != '') {
            $this->setPreferredLanguage($preferredLanguage);
            $this->setSalutation($salutation);
            $this->setFirstName($firstName);
            $this->setLastName($lastName);
    
            ContactList::getInstance()->addContactToList($this);
        }
    }

    public function getProperties(): array
    {
        return get_object_vars($this);
    }

    public function getPreferredLanguage(): string
    {
        return $this->preferredLanguage;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setPreferredLanguage(string $preferredLanguage): void
    {
        $config = DataConfig::getInstance();

        if ($preferredLanguage != '')
        {
            if (false !== $index = array_search($preferredLanguage, $config->getValuesIn('preferredLanguage'))) {
                $this->preferredLanguage = $config->getValuesOut('preferredLanguage')[$index];
            } else {
                (Log::getInstance())->addMessage(sprintf($this::LOGMSG_PREFERREDLANGUAGE_UNIDENTIFIED, $this->email));
                $this->preferredLanguage = $config->getValuesOut('preferredLanguage')[0];
            }
        } else {
            (Log::getInstance())->addMessage(sprintf($this::LOGMSG_PREFERREDLANGUAGE_MISSING, $this->email));
            $this->preferredLanguage = $config->getValuesOut('preferredLanguage')[0];
        }
    }

    private function setSalutation(string $salutation): void
    {
        if ($salutation != '') {
            $preferredLanguage = $this->preferredLanguage;

            $config = DataConfig::getInstance();
            $possibleSalutationsIn = $config->getValuesIn('salutation');
            $possibleSalutationsOut = $config->getValuesOut('salutation')->$preferredLanguage;
    
            $unidentifiedSalutation = false;

            foreach ($possibleSalutationsIn as $salutationLanguage => $salutationsPerLanguage)
            {
                if (false !== $index = array_search($salutation, $salutationsPerLanguage)) {
                    $this->salutation = $possibleSalutationsOut[$index];
                    $unidentifiedSalutation = false;
                    break;
                } else {
                    $unidentifiedSalutation = true;
                }
            }

            if ($unidentifiedSalutation) {
                (Log::getInstance())->addMessage(sprintf($this::LOGMSG_SALUTATION_UNIDENTIFIED, $this->email));
            }
        } else {
            (Log::getInstance())->addMessage(sprintf($this::LOGMSG_SALUTATION_MISSING, $this->email));
        }

    }

    private function setFirstName(string $firstName): void
    {
        if ($firstName != '') {
            $this->firstName = $firstName;
        } else {
            (Log::getInstance())->addMessage(sprintf($this::LOGMSG_FIRSTNAME_MISSING, $this->email));
        }        
    }

    private function setLastName(string $lastName): void
    {
        if ($lastName != '') {
            $this->lastName = $lastName;
        } else {
            (Log::getInstance())->addMessage(sprintf($this::LOGMSG_LASTNAME_MISSING, $this->email));
        } 
    }

    private function setEmail(string $email): void
    {
        if ($email != '') {
            $this->email = $email;
        } else {
            (Log::getInstance())->addMessage($this::LOGMSG_EMAIL_MISSING);
        } 
    }
}
