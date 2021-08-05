<?php
namespace LazForm\Contracts;

interface InputTypeInterface
{
    public function getFieldType(): string;
    //public function getAttributes(): array;
}