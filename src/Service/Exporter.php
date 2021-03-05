<?php

namespace OxidSupport\Hubli\Service;

use OxidSupport\Hubli\Model\DataConfig;
use OxidSupport\Hubli\Model\ContactList;

class Exporter
{
    public function export(string $generalExportFilename): array
    {
        $exportFiles = [];
        $exportFilenames = [];
        $header = $this->getHeader();

        foreach ($this->getLanguages() as $language) {
            $exportFilename = $this->generateExportFilename($generalExportFilename, $language);
            $exportFilenames[$language] = $exportFilename;

            $exportFiles[$language] = fopen($exportFilename, 'w');
            fputcsv($exportFiles[$language], $header);
        }

        foreach (ContactList::getInstance()->getList() as $contact) {
            fputcsv($exportFiles[$contact->getPreferredLanguage()], $contact->getProperties());
        }

        foreach ($exportFiles as $file) {
            fclose($file);
        }

        foreach ($exportFilenames as $filename) {
            $this->ensureUtf8Encoding($filename);
        }

        return $exportFilenames;
    }

    private function getHeader(): array
    {
        $config = DataConfig::getInstance();

        $header = [
            $config->getNameOut('preferredLanguage'),
            $config->getNameOut('salutation'),
            $config->getNameOut('firstName'),
            $config->getNameOut('lastName'),
            $config->getNameOut('email'),
        ];

        return $header;
    }

    private function getLanguages(): array
    {
        return (DataConfig::getInstance())->getValuesOut('preferredLanguage');
    }

    private function generateExportFilename(string $generalExportFilename, string $language): string
    {
        return substr($generalExportFilename, 0, -4) . '-' . $language . '.csv';
    }

    private function ensureUtf8Encoding(string $filename): void
    {
        $contents = file_get_contents($filename);

        if (!mb_detect_encoding($contents, 'UTF-8', true)) {
            file_put_contents($filename, utf8_encode($contents));
        }
    }
}
