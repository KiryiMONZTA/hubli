<?php

namespace OxidSupport\Hubli\Service;

use OxidSupport\Hubli\Model\DataConfig;
use OxidSupport\Hubli\Model\Contact;

class Importer
{
    public function import(string $importFilename)
    {
        $this->createContactsFromRecordList($this->buildRecordList($importFilename));
    }

    private function buildRecordList(string $importFilename): array
    {
        $importFile = fopen($importFilename, 'r');
        $header = fgetcsv($importFile);
        $numberOfAttributes = count($header);

        $recordList = [];

        while ($record = fgetcsv($importFile)) {
            for ($i = 0; $i < $numberOfAttributes; $i++) {
                $recordAssoc[$header[$i]] = $record[$i];
            }

            $recordList[] = $recordAssoc;
        }

        fclose($importFile);
        
        return $recordList;
    }

    private function createContactsFromRecordList(array $recordList): void
    {
        foreach ($recordList as $record) {
            $config = DataConfig::getInstance();

            new Contact(
                $record[$config->getNameIn('preferredLanguage')],
                $record[$config->getNameIn('salutation')],
                $record[$config->getNameIn('firstName')],
                $record[$config->getNameIn('lastName')],
                $record[$config->getNameIn('email')]
            );
        }
    }
}
