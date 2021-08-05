<?php

namespace LazForm\Fields\Traits;

use LazForm\Fields\Input;

trait DefaultAttributesTraits
{
    private bool $readOnly = false;
    private bool $disabled = false;

    /**
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return $this->readOnly;
    }

    /**
     * @param bool $readOnly
     * @return Input
     */
    public function readOnly(bool $readOnly): Input
    {
        $this->readOnly = $readOnly;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return DefaultAttributesTraits|Input
     */
    public function disabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        return $this;
    }
}