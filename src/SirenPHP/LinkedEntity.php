<?php
namespace SirenPHP;

class LinkedEntity extends BaseEntity {
    private $href = null;

    public function __construct($href, array $rel, array $class=array()) {
        $this->setHref($href);
        $this->setRel($rel);
        $this->setClass($class);
    }

    public function setHref($href) {
        if (!is_string($href)) {
            throw new \InvalidArgumentException('href must be string');
        }

        $this->href = $href;
        return $this;
    }
    
    public function setRel($rel) {
        foreach ($rel as $r) {
            if (!is_string($r)) {
                throw new \InvalidArgumentExcpetion('rel must be an array of strings');
            }
        }

        $this->rel = $rel;
        return $this;
    }

    public function getSerializableVars() {
        $vars = get_object_vars($this);
        if (0 === count($this->class)) {
            unset($vars['class']);
        }
        return $vars;
    }

    public function __toString() {
        return json_encode($this->getSerializableVars());
    }
}
