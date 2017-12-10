<?php

namespace PE\Component\Settings\Type;

use PE\Component\Settings\Exception\ExceptionInterface;
use PE\Component\Settings\Exception\InvalidArgumentException;

/**
 * Type is one of predefined list
 */
class EnumType extends BaseType
{
    /**
     * @var string[]
     */
    private $values;

    /**
     * @param string[] $values
     * @param array    $options
     *
     * @throws ExceptionInterface
     */
    public function __construct(array $values, array $options = [])
    {
        parent::__construct($options);

        if (count(array_filter(array_keys($values), 'is_string')) === 0) {
            throw new InvalidArgumentException('Values array must have a string keys');
        }

        $this->values = $values;
    }

    /**
     * @return string[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @inheritDoc
     */
    public function decodeValue($value)
    {
        // If value is not an values key - return null
        return array_key_exists((string) $value, $this->values) ? (string) $value : null;
    }

    /**
     * @inheritDoc
     */
    public function encodeValue($value)
    {
        // If value is not an values key - return empty string
        return (string) (array_key_exists((string) $value, $this->values) ? (string) $value : null);
    }
}