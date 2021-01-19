<?php

namespace OxidSupport\Hubli\Service;

class Uploader
{
    private const VALID_MIMETYPES = ['text/csv', 'text/plain'];

    public function upload(string $tmpFilename, string $importDir): ?string
    {
        $filename = hash_file('md5', $tmpFilename) . '.csv';

        if (move_uploaded_file($tmpFilename, $importDir . $filename)) {
            if (
                $this->validateFileExtension($importDir . $filename)
                && $this->validateMimeType($importDir . $filename)
            ) {
                return $filename;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    private function validateFileExtension(string $filename): bool
    {
        if (pathinfo($filename, PATHINFO_EXTENSION) == 'csv') {
            return true;
        } else {
            return false;
        }
    }

    private function validateMimeType(string $filename): bool
    {
        if (array_search(mime_content_type($filename), $this::VALID_MIMETYPES)) {
            return true;
        } else {
            return false;
        }
    }
}
