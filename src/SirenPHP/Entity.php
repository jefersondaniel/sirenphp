<?php
namespace SirenPHP;

class Entity extends BaseEntity {
    private $properties = array();
    private $entities = array();
    private $actions  = array();
    private $links    = array();
    private $title    = '';

    public function __construct($selfHref, array $properties, array $class=array()) {
        $this->appendLink(new Link(array('self'), $selfHref));
        $this->setProperties($properties);
        $this->setClass($class);
    }

    public function setProperties(array $properties) {
        $this->properties = $properties;
        return $this;
    }

    public function appendEntity(array $rel, BaseEntity $entity) {
        $copyEntity = clone $entity;
        $copyEntity->rel = $rel;
        $this->entities[] = $copyEntity;
 
        return $this;
    }

    public function appendAction(Action $action) {
        $this->actions[] = $action;
        return $this;
    }

    public function appendLink(Link $link) {
        $this->links[] = $link;
        return $this;
    }

    public function setTitle($title) {
        if (!is_null($title) && !is_string($title)) {
            throw new \InvalidArgumentException('Title must be string');
        }

        $this->title = $title;
        return $this;
    }

    public function getSerializableVars() {
        $vars = array();

        if (isset($this->rel)) {
            $vars['rel'] = $this->rel;
        }

        if (count($this->class) > 0) {
            $vars['class'] = $this->class;
        }
    
        if (count($this->properties) > 0) {
            $vars['properties'] = $this->properties;
        }

        if (count($this->entities) > 0) {
            $vars['entities'] = array();
            foreach ($this->entities as $entity) {
                $vars['entities'][] = $entity->getSerializableVars();
            }
        }
        
        if (count($this->actions) > 0) {
            $vars['actions'] = array();
            foreach ($this->actions as $action) {
                $vars['actions'][] = $action->getSerializableVars();
            }
        }

        if (count($this->links) > 0) {
            $vars['links'] = array();
            foreach ($this->links as $link) {
                $vars['links'][] = $link->getSerializableVars();
            }
        }

        if ($this->title !== '') {
            $vars['title'] = $this->title;
        }

        return $vars;
    }

    public function __toString() {
        return json_encode($this->getSerializableVars());
    }
}
