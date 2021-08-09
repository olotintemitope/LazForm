<?php

namespace LazForm;

use JetBrains\PhpStorm\Pure;

/**
 * @method static Input()
 */
class Form
{
    private string $action;
    private string $method;
    private string $encrypt;
    private string $acceptCharset = "utf-8";
    private string $autoComplete;
    private string $name;
    private string $noValidate;

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     * @return Form
     */
    public function action($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     * @return Form
     */
    public function method($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEncrypt()
    {
        return $this->encrypt;
    }

    /**
     * @param mixed $encrypt
     * @return Form
     */
    public function encrypt($encrypt)
    {
        $this->encrypt = $encrypt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAcceptCharset()
    {
        return $this->acceptCharset;
    }

    /**
     * @param mixed $acceptCharset
     * @return Form
     */
    public function acceptCharset($acceptCharset)
    {
        $this->acceptCharset = $acceptCharset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAutoComplete()
    {
        return $this->autoComplete;
    }

    /**
     * @param mixed $autoComplete
     * @return Form
     */
    public function autoComplete($autoComplete)
    {
        $this->autoComplete = $autoComplete;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Form
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNoValidate()
    {
        return $this->noValidate;
    }

    /**
     * @param mixed $noValidate
     * @return Form
     */
    public function noValidate($noValidate)
    {
        $this->noValidate = $noValidate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param mixed $rel
     * @return Form
     */
    public function rel($rel)
    {
        $this->rel = $rel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     * @return Form
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }
    private string $rel;
    private string $target;

    public static function __callStatic($func, $args)
    {
        if (count($args) <= 0) {
            return new ("\\LazForm\\Fields\\$func");
        }
    }



    #[Pure] public static function open(): static
    {
        return new static;
    }

    public function setTheme(): string
    {
        return '';
    }

    private function getThemeClass(): string
    {
        return 'form-control';
    }

}