<?php

namespace PE\Component\Settings\Type;

/**
 * Type like checkbox
 */
class BooleanType extends BaseType
{
    /**
     * @inheritDoc
     */
    public function decodeValue($value)
    {
        return (bool) $value;
    }

    /**
     * @inheritDoc
     */
    public function encodeValue($value)
    {
        return (string) (int) $value;
    }
}