<?php

namespace LazForm\Type;
use LazForm\Contracts\FormElementInterface;

class CheckBox implements FormElementInterface
{
    /**
     * @var array
     */
    private array $selectedOptions = [];

    /**
     * @return array
     */
    public function getSelectedOptions(): array
    {
        return $this->selectedOptions;
    }

    /**
     * @param array $selectedOptions
     * @return CheckBox
     */
    public function defaultOptions(array $selectedOptions): CheckBox
    {
        $this->selectedOptions = $selectedOptions;
        return $this;
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
     * @return CheckBox
     */
    public function options(array $options): CheckBox
    {
        $this->options = $options;
        return $this;
    }
    /**
     * @var array
     */
    private array $options = [];

   //@TODO // selected values
    //@TODO // options

    public function build()
    {
        // TODO: Implement build() method.
    }
}