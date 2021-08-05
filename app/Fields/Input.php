<?php

namespace LazForm\Fields;

use Exception;

class Input
{
    use Traits\DefaultAttributesTraits;

    private string $type;
    private string $value = "";
    private string $includeLabel;
    private array $attributes;
    private string $labelDetails;

    /**
     * @param string $html
     * @return Input
     */
    public function labelDetails(string $html): Input
    {
        $this->labelDetails = strip_tags($html, "<strong><p><label>");
        return $this;
    }

    /**
     * @throws Exception
     */
    public function __toString(): string
    {
        $labelDetails = html_entity_decode($this->getLabelDetails());

        return $this->transformAttributes(
            "<strong><label for={$this->getAttributes()['id']}>{$this->isIncludeLabel()}</label></strong><br>{$labelDetails}<br><br><input type={$this->getFieldType()} {$this->buildAttributes()}/>"
        );
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
     * @return array
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
     * @return bool
     */
    public function isIncludeLabel(): string
    {
        return $this->includeLabel;
    }

    public function getFieldType(): string
    {
        return $this->type;
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

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param array $attributes
     */
    public function attributes(array $attributes): Input
    {
        $attrs = [];

        foreach ($attributes as $key => $attribute) {
            $attrs[strip_tags($key)] = strip_tags($attribute);
        }

        $this->attributes = $attrs;
        return $this;
    }

    /**
     * @param string $value
     * @return Input
     */
    public function value(string $value): Input
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function type(string $type): Input
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $includeLabel
     * @return $this
     */
    public function label(string $includeLabel): Input
    {
        $this->includeLabel = strip_tags($includeLabel);

        return $this;
    }
}