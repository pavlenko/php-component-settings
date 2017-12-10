<?php

namespace PE\Component\Settings\Type;

use PE\Component\Settings\Exception\ExceptionInterface;
use PE\Component\Settings\Exception\InvalidArgumentException;

/**
 * Type is list of some of predefined values
 */
class SetType extends BaseType
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
        if (!is_array($decoded = json_decode($value, true))) {
            return [];
        }

        return array_filter($decoded, function($item){
            return array_key_exists((string) $item, $this->values);
        });
    }

    /**
     * @inheritDoc
     */
    public function encodeValue($value)
    {
        $filtered = array_filter((array) $value, function($item){
            return array_key_exists((string) $item, $this->values);
        });

        return (string) json_encode($filtered);
    }
}