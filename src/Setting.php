<?php

namespace PE\Component\Settings;

use PE\Component\Settings\Type\TypeInterface;

class Setting
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
     * @param string        $name
     * @param string        $label
     * @param TypeInterface $type
     * @param string        $group
     */
    public function __construct($name, $label, TypeInterface $type, $group)
    {
        $this->name  = $name;
        $this->label = $label;
        $this->type  = $type;
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
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }
}