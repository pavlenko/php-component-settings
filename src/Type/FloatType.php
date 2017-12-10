<?php

namespace PE\Component\Settings\Type;

/**
 * Type is decimal number
 */
class FloatType extends BaseType
{
    /**
     * @var int
     */
    private $precision;

    /**
     * @param int   $precision
     * @param array $options
     */
    public function __construct($precision, array $options = [])
    {
        parent::__construct($options);
        $this->precision = (int) $precision;
    }

    /**
     * @inheritDoc
     */
    public function decodeValue($value)
    {
        return round((float) $value, $this->precision);
    }

    /**
     * @inheritDoc
     */
    public function encodeValue($value)
    {
        return (string) round((float) $value, $this->precision);
    }
}