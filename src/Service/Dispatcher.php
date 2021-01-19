<?php

namespace OxidSupport\Hubli\Service;

use OxidSupport\Hubli\Controller\DownloadController;
use OxidSupport\Hubli\Controller\UploadController;
use OxidSupport\Hubli\Controller\ErrorController;

class Dispatcher
{
    private const IMPORTDIR = __DIR__ . '/../../import/';
    private const EXPORTDIR = __DIR__ . '/../../export/';

    public function run(): void
    {
        if (isset($_FILES['upload'])) {
            if (null != $filename = (new Uploader())->upload($_FILES['upload']['tmp_name'], $this::IMPORTDIR)) {
                (new Importer())->import($this::IMPORTDIR . $filename);
                $exportFilenames = (new Exporter())->export($this::EXPORTDIR . $filename);
                (new DownloadController($exportFilenames))->run();
            } else {
                (new ErrorController())->run();
            }
        } else {
            (new UploadController())->run();
        }
    }
}
