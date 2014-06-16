<?php
namespace SirenPHP;

class Action implements JsonSerializable {
    private $name   = null;
    private $class  = array();
    private $method = null;
    private $href   = null;
    private $type   = null;
    private $title  = null;
    private $fields = array();

    public function __construct($name, $href) {
        $this->setName($name);
        $this->setHref($href);
    }

    public function setName($name) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('name must be string');
        }

        $this->name = $name;
        return $this;
    }

    public function setClass(array $class) {
        $this->class = $class;
        return $this;
    }

    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }

    public function setHref($href) {
        if (!is_string($href)) {
            throw new \InvalidArgumentException('Href must be string');
        }
        $this->href = $href;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function existField($fieldName) {
        return in_array($fieldName, array_keys($this->fields));
    }

    public function appendField(Field $field) {
        $this->fields[$field->getName()] = $field;
        return $this;
    }

    public function getSerializableVars() {
        $vars = array('name'=>$this->name, 'href'=>$this->href);
        
        if (count($this->class) > 0) {
            $vars['class'] = $this->class;
        }

        if ($this->method !== null) {
            $vars['method'] = $this->method;
        }

        if ($this->type !== null) {
            $vars['type'] = $this->type;
        }

        if ($this->title !== null) {
            $vars['title'] = null;
        }

        if (count($this->fields) > 0) {
            $vars['fields'] = array();
            foreach ($this->fields as $field) {
                $vars['fields'][] = $field->getSerializableVars();
            }
        }

        return $vars;
    }

    public function __toString() {
        return json_encode($this->getSerializableVars());
    }
}
