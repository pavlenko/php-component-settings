<?php

namespace PE\Component\Settings\Builder;

use PE\Component\Settings\Group;

class Builder
{
    /**
     * @var GroupBuilder[]
     */
    private $groups = [];

    /**
     * @param string $name
     *
     * @return GroupBuilder
     */
    public function create($name)
    {
        if (!array_key_exists($name, $this->groups)) {
            $this->groups[$name] = new GroupBuilder($name);
        }

        return $this->groups[$name];
    }

    /**
     * @return Group[]
     */
    public function build()
    {
        return array_map(function(GroupBuilder $builder){
            return $builder->build();
        }, $this->groups);
    }
}