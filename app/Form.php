<?php

namespace LazForm;

class Form
{
    private function getThemeClass(): string
    {
        return 'form-control';
    }

    public function setTheme(): string
    {
        return '';
    }

    public function build(): string
    {
        return '';
    }

    public static function __callStatic($func, $args)
    {
        if (count($args) <= 0) {
            return new ("\\LazForm\\Fields\\$func");
        }
    }


}