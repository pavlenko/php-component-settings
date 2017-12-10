<?php

namespace PE\Component\Settings;

use PE\Component\Settings\Builder\Builder;
use PE\Component\Settings\Exception\ExceptionInterface;
use PE\Component\Settings\Storage\StorageInterface;

class SettingsManager
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var Group[]
     */
    private $groups;

    /**
     * @var Setting[]
     */
    private $settings = [];

    /**
     * @param StorageInterface $storage
     * @param Builder          $builder
     *
     * @throws ExceptionInterface
     */
    public function __construct(StorageInterface $storage, Builder $builder)
    {
        $this->storage = $storage;
        $this->groups  = $builder->build();

        foreach ($this->groups as $group) {
            $this->settings += $group->getSettings();
        }
    }

    /**
     * @return Group[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Get values for entry group
     *
     * @param string $group
     *
     * @return array
     */
    public function getValues($group)
    {
        if (!array_key_exists($group, $this->groups)) {
            return [];
        }

        $result = [];
        $values = $this->storage->getGroup($group);

        foreach ($values as $key => $value) {
            if (array_key_exists($key, $this->settings)) {
                $result[$key] = $this->settings[$key]->getType()->decodeValue($value);
            }
        }

        return $result;
    }

    /**
     * Set values for entry group
     *
     * @param string $group
     * @param array  $values
     *
     * @return $this
     */
    public function setValues($group, array $values)
    {
        if (!array_key_exists($group, $this->groups)) {
            return $this;
        }

        $result = [];

        foreach ($values as $key => $value) {
            if (array_key_exists($key, $this->settings)) {
                $result[$key] = $this->settings[$key]->getType()->decodeValue($value);
            }
        }

        $this->storage->setGroup($group, $result);

        return $this;
    }

    /**
     * Get setting value
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getValue($name, $default = null)
    {
        if (!array_key_exists($name, $this->settings)) {
            // For unknown setting just return default instead of throw exception
            return $default;
        }

        if (null !== ($value = $this->storage->getValue($name))) {
            return $this->settings[$name]->getType()->decodeValue($value);
        }

        return $default;
    }

    /**
     * Set setting value
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setValue($name, $value)
    {
        if (!array_key_exists($name, $this->settings)) {
            // For unknown setting just do nothing
            return $this;
        }

        $this->storage->setValue(
            $this->settings[$name]->getGroup(),
            $name,
            $this->settings[$name]->getType()->encodeValue($value)
        );

        return $this;
    }
}