<?php

namespace LazForm\Type\FieldType;

use BenSampo\Enum\Enum;

final class Type extends Enum
{
    const EMAIL = 'email';
    const CHECKBOX = 'checkbox';
    const NUMBER = 'number';
    const RADIO = 'radio';
    const DATE = 'date';
    const DATETIME = 'datetime';
    const TEXT = 'text';
    const PASSWORD = 'password';
    const BUTTON = 'button';
    const RANGE = "range";
    const RESET = "reset";
    const SEARCH = "search";
    const SUBMIT = "submit";
    const TEL = "tel";
    const TIME = "time";
    const URL = "url";
    const WEEK = "week";
    const COLOR = "color";
    const DATETIME_LOCAL = "datetime-local";
    const FILE = "file";
    const HIDDEN = "hidden";
    const IMAGE = "image";
    const MONTH = "month";

}