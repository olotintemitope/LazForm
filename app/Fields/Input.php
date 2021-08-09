<?php

namespace LazForm\Fields;

use Exception;
use LazForm\Contracts\InputAbstract;

class Input extends InputAbstract
{
    use Traits\DefaultAttributesTraits;

    private string $type;
    private string $value = "";

    /**
     * @throws Exception
     */
    public function __toString(): string
    {
        $labelDetails = html_entity_decode($this->getLabelDetails());

        return $this->transformAttributes(
            "<label for={$this->getAttributes()['id']}>{$this->getLabel()}</label><br/>{$labelDetails}<br/><input type={$this->getFieldType()} {$this->buildAttributes()}/>"
        );
    }

    public function getFieldType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
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
}