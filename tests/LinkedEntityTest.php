<?php
class LinkedEntityTest extends PHPUnit_Framework_TestCase {
    public function testConstructor() {
        $entity = new \SirenPHP\LinkedEntity('http://api.io/user/1');
        $this->setExpectedException('\InvalidArgumentException');
        $entity = new \SirenPHP\LinkedEntity(null);
    }

    public function testSerialize() {
        $entity = new \SirenPHP\LinkedEntity('http://api.io/activity/1');
        $this->assertEquals((string)$entity, '{"href":"http:\/\/api.io\/activity\/1"}');

        $entity = new \SirenPHP\LinkedEntity('http://lol.io/user/1');
        $entity->appendClass('user');
        $this->assertEquals((string)$entity, '{"href":"http:\/\/lol.io\/user\/1","class":["user"]}');
    }
}    
