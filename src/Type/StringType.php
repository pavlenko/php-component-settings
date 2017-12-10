<?php

namespace PE\Component\Settings\Type;

/**
 * Type is string
 */
class StringType extends BaseType
{
    /**
     * @inheritDoc
     */
    public function decodeValue($value)
    {
        return (string) $value;
    }

    /**
     * @inheritDoc
     */
    public function encodeValue($value)
    {
        return (string) $value;
    }
}