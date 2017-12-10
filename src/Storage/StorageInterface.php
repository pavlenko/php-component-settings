<?php

namespace PE\Component\Settings\Storage;

interface StorageInterface
{
    /**
     * Get group values
     *
     * @param string $name
     *
     * @return array
     */
    public function getGroup($name);

    /**
     * Set group values
     *
     * @param string $name
     * @param array  $values
     */
    public function setGroup($name, array $values);

    /**
     * Get setting value
     *
     * @param string $name
     *
     * @return string|null
     */
    public function getValue($name);

    /**
     * Set setting value
     *
     * @param string $group
     * @param string $name
     * @param string $value
     */
    public function setValue($group, $name, $value);
}