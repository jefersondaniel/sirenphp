<?php
namespace SirenPHP;

class Field implements JsonSerializable {
    public static $POSSIBLE_TYPES = array(
        'hidden', 'text', 'search', 'tel', 'url', 'email', 'password',
        'datetime', 'date', 'month', 'week', 'time', 'datetime-local',
        'number', 'range', 'color', 'checkbox', 'radio', 
        'file', 'submit', 'image', 'reset', 'button'    
    );

    private $name   = null;
    private $type   = null;
    private $value  = null;

    public function __construct($name, $type = null, $value = null) {
        $this->setName($name);
        $this->setType($type);
        $this->setValue($value);
    }

    public function setName($name) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Name must be string');
        }

        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setType($type) {
        if (null !== $type && !in_array($type, self::$POSSIBLE_TYPES)) {
            throw new \InvalidArgumentException(
                'Type must be one of: ' . implode(', ', self::$POSSIBLE_TYPES)
            );
        }

        $this->type = $type;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function getSerializableVars() {
        $vars = array('name'=>$this->name);
        if ($this->type !== null) {
            $vars['type'] = $this->type;
        }

        if ($this->value !== null) {
            $vars['value'] = $this->value;
        }

        return $vars;
    }
    
    public function __toString() {
        $vars = $this->getSerializableVars(); 
        return json_encode($vars);
    }
}
