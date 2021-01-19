<?php

namespace OxidSupport\Hubli\Controller;

class UploadController extends FrontendController
{
    protected const TPLNAME = 'upload';
    protected const TITLE = 'Upload';

    public function run(): void
    {
        $this->render();
    }
}
