<?php

namespace OxidSupport\Hubli\Controller;

class ErrorController extends FrontendController
{
    protected const TPLNAME = 'error';
    protected const TITLE = 'Error';

    public function run(): void
    {
        $this->render();
    }
}
