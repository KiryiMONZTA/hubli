<?php

namespace OxidSupport\Hubli\Controller;

use OxidSupport\Hubli\Model\Log;

class DownloadController extends FrontendController
{
    protected const TPLNAME = 'download';
    protected const TITLE = 'Download';

    private const DOWNLOADDIR = 'download/';
    public static array $downloadFiles = [];
    public static array $logMessages = [];

    public function __construct(array $exportFilenames)
    {
        foreach ($exportFilenames as $language => $exportFilename) {
            rename($exportFilename, $this::DOWNLOADDIR . basename($exportFilename));

            $this::$downloadFiles[] = [
                'language' => strtoupper($language),
                'link' => $this::DOWNLOADDIR . basename($exportFilename),
                'name' => date('Y-m-d') . '-' . $language . '.csv',
            ];
        }

        $this::$logMessages = (Log::getInstance())->getMessages();
    }

    public function run(): void
    {
        $this->render();
    }
}
