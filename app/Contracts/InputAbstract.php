<?php

namespace LazForm\Contracts;

use Exception;

abstract class InputAbstract
{
    ## define input having multiple options
    public array $options = [];
    public array|string $selectedOptions;
    protected string $label;
    private array $attributes;
    private string $labelDetails = "";

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return InputAbstract
     */
    public function options(array $options): InputAbstract
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getSelectedOptions(): array|string
    {
        return $this->selectedOptions;
    }

    /**
     * @param array|string $selectedOptions
     * @return InputAbstract
     */
    public function selectedOptions(array|string $selectedOptions): InputAbstract
    {
        $this->selectedOptions = $selectedOptions;
        return $this;
    }

    /**
     * @param string $html
     * @return InputAbstract
     */
    public function labelDetails(string $html): InputAbstract
    {
        $this->labelDetails = strip_tags($html, "<strong><p><label><br>");
        return $this;
    }

    /**
     * @return string
     */
    public function getLabelDetails(): string
    {
        return $this->labelDetails;
    }

    public function transformAttributes(string $html): string|null
    {
        $regex = "/([a-z]\w+)(=){1}([a-z ]\w+)/";

        return preg_replace_callback($regex, static function ($matches) {
            if (count($matches) > 0) {
                return strip_tags($matches[1]) . "=" . '"' . strip_tags($matches[3]) . '"';
            }
        }, $html);
    }

    /**
     * @return array|Exception
     * @throws Exception
     */
    public function getAttributes(): array
    {
        $attributes = [];
        $attrs = $this->attributes;

        foreach ($attrs as $attr) {
            foreach ($attr as $attribute => $value) {
                $attributes[$attribute] = $value;
            }
        }

        return $attributes;
    }


    /**
     * @param string $includeLabel
     * @return InputAbstract
     */
    public function label(string $includeLabel): InputAbstract
    {
        $this->label = strip_tags($includeLabel);

        return $this;
    }


    /**
     * @param string $attribute
     * @param string $value
     * @return InputAbstract
     */
    public function attribute(string $attribute, string $value): InputAbstract
    {
        $attrs = [];
        $attrs[strip_tags($attribute)] = strip_tags($value);

        $this->attributes[] = $attrs;
        return $this;
    }

    /**
     * @throws Exception
     */
    protected function buildAttributes(): array|string
    {
        $attributes = [];
        $attrs = $this->getAttributes();

        foreach ($attrs as $attribute => $value) {
            if ($attribute === 'class') {
                $attributes[$attribute] = "{$this->getThemeClass()} {$value}";
            } else {
                $attributes[$attribute] = '"'.$value.'"';
            }
        }

        return $attributes;
    }
}