<?php
namespace SirenPHP;

abstract class BaseEntity {
    protected $class = array();

    public function setClass(array $class) {
        $this->class = $class;
        return $this;
    }

    public function existClass($class) {
        return in_array($class, $this->class);
    }

    public function appendClass($className) {
        if ( $this->existClass($className) ) {
            throw new \InvalidArgumentException('class already exists');
        }

        $this->class[] = $className;
        return $this;
    }
}
