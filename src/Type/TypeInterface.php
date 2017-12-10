<?php

namespace PE\Component\Settings\Type;

interface TypeInterface
{
    /**
     * @return array
     */
    public function getOptions();

    /**
     * Get single option or default
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOption($name, $default = null);

    /**
     * Decode value from storage representation
     *
     * @param string $value
     *
     * @return mixed
     */
    public function decodeValue($value);

    /**
     * Encode value to storage representation
     *
     * @param mixed $value
     *
     * @return string
     */
    public function encodeValue($value);
}