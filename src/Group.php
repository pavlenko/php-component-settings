<?php

namespace PE\Component\Settings;

class Group
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
     * @var Setting[]
     */
    private $settings;

    /**
     * @param string    $name
     * @param string    $label
     * @param Setting[] $settings
     */
    public function __construct($name, $label, array $settings)
    {
        $this->name     = $name;
        $this->label    = $label;
        $this->settings = $settings;
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
     * @return Setting[]
     */
    public function getSettings()
    {
        return $this->settings;
    }
}