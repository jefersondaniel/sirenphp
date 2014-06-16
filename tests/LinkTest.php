<?php
class LinkTest extends PHPUnit_Framework_TestCase {
    public function testConstructor() {
        $this->setExpectedException('\InvalidArgumentException');
        $link = new \SirenPHP\Link(array('self'), null);
    }

    public function testRepeatedRelation() {
        $link = new \SirenPHP\Link(array('self'), '/user/1');
        $link->appendRel('canonical');
        $this->setExpectedException('\InvalidArgumentException');
        $link->appendRel('self');
    }

    public function testSerialization() {
        $link = new \SirenPHP\Link(array('item'), '/item/1');
        $json = (string)$link;
        $this->assertEquals($json, '{"rel":["item"],"href":"\/item\/1"}');
    }
}
