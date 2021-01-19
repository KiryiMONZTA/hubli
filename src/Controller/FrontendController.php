<?php

namespace OxidSupport\Hubli\Controller;

abstract class FrontendController
{
    protected const VIEWDIR = __DIR__ . '/../View/';
    protected const TPLNAME = '';
    protected const TPLFILEEXTENSION = '.tpl.php';

    abstract protected function run(): void;

    protected function render(): void
    {
        require_once $this::VIEWDIR . 'layout' . $this::TPLFILEEXTENSION;
    }
}
