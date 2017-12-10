<?php

namespace PE\Component\Settings\Builder;

use PE\Component\Settings\Exception\ExceptionInterface;
use PE\Component\Settings\Exception\RuntimeException;
use PE\Component\Settings\Setting;
use PE\Component\Settings\Type\TypeInterface;

class SettingBuilder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $label;

    /**
     * @var TypeInterface
     */
    private $type;

    /**
     * @var string
     */
    private $group;

    /**
     * @param string $name
     * @param string $group
     */
    public function __construct($name, $group)
    {
        $this->name  = $name;
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param TypeInterface $type
     *
     * @return $this
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Setting
     *
     * @throws ExceptionInterface
     */
    public function build()
    {
        if (!($this->type instanceof TypeInterface)) {
            throw new RuntimeException('Type is required');
        }

        return new Setting($this->name, $this->label, $this->type, $this->group);
    }
}