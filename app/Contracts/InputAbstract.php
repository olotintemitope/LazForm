<?php

namespace LazForm\Contracts;

use Exception;

abstract class InputAbstract
{
    ## define input having multiple options
    public array $options = [];
    public array|string $selectedOptions;
    protected string $label;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
    private array $attributes;
    private string $labelDetails = "";

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
        $regex = "/([a-z]\w+)(=){1}([a-z]\w+)/";

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
    public function getAttributes(): array|Exception
    {
        if (!isset($this->attributes['name'])) {
            throw new Exception('name attribute is required');
        }

        if (!isset($this->attributes['id'])) {
            throw new Exception('id attribute is required');
        }

        return $this->attributes;
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
     * @param array $attributes
     */
    public function attributes(array $attributes): InputAbstract
    {
        $attrs = [];

        foreach ($attributes as $key => $attribute) {
            $attrs[strip_tags($key)] = strip_tags($attribute);
        }

        $this->attributes = $attrs;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function buildAttributes(): string
    {
        $attr = [];

        $filteredAttrs = array_filter($this->getAttributes(), function ($value, $attr) {
            return !in_array($attr, ['id', 'for', 'name', 'value']);
        }, ARRAY_FILTER_USE_BOTH);

        $filteredAttrs['id'] = $this->getAttributes()['id'];
        $filteredAttrs['name'] = $this->getAttributes()["name"];
        $filteredAttrs['value'] = '"'.($this->getValue()).'"';
        $filteredAttrs['placeholder'] = '"'.($this->getAttributes()['placeholder']).'"';

        if ($this->readOnly) {
            $filteredAttrs['readonly'] = 'readonly';
        }

        if ($this->disabled) {
            $filteredAttrs['disabled'] = 'disabled';
        }

        foreach ($filteredAttrs as $key => $value) {
            if ($key === 'class') {
                $attr[] = "{$key}={$this->getThemeClass()} {$value}";
            } else {
                $attr[] = "{$key}={$value}";
            }
        }
        return implode(' ', $attr);
    }
}