<?php
namespace SirenPHP;

class Link implements JsonSerializable {
    private $rel  = array();
    private $href = null;

    public function __construct(array $rel, $href) {
        $this->setRel($rel);
        $this->setHref($href);
    }

    public function existRel($relName) {
        return in_array($relName, $this->rel);
    }

    public function appendRel($relName) {
        if ($this->existRel($relName))
            throw new \InvalidArgumentException("This relationship already exists");

        $this->rel[] = $relName;
        return $this;
    }

    public function setRel(array $rel) {
        $this->rel = $rel;
        return $this;
    }

    public function setHref($href) {
        if (!is_string($href))
            throw new \InvalidArgumentException("Href must be string");
        
        $this->href = $href;
        return $this;
    }

    public function getSerializableVars() {
        return array('rel'=>$this->rel, 'href'=>$this->href);
    }

    public function __toString() {
        return json_encode($this->getSerializableVars());
    }
} 
