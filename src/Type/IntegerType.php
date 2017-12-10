<?php

namespace PE\Component\Settings\Type;

/**
 * Type is ceil number
 */
class IntegerType extends BaseType
{
    /**
     * @inheritDoc
     */
    public function decodeValue($value)
    {
        return (int) $value;
    }

    /**
     * @inheritDoc
     */
    public function encodeValue($value)
    {
        return (string) (int) $value;
    }
}