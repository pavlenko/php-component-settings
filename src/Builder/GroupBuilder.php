<?php

namespace PE\Component\Settings\Builder;

use PE\Component\Settings\Group;

class GroupBuilder
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
     * @var SettingBuilder[]
     */
    private $settings = [];

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
     * @param string $name
     *
     * @return SettingBuilder
     */
    public function create($name)
    {
        if (!array_key_exists($name, $this->settings)) {
            $this->settings[$name] = new SettingBuilder($name, $this->name);
        }

        return $this->settings[$name];
    }

    /**
     * @return Group
     */
    public function build()
    {
        $settings = array_map(function(SettingBuilder $builder){
            return $builder->build();
        }, $this->settings);

        return new Group($this->name, $this->label, $settings);
    }
}