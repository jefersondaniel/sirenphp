<?php
class FieldTest extends PHPUnit_Framework_TestCase {
    public function testConstructor() {
        $field = new \SirenPHP\Field('user_id');
        $field = new \SirenPHP\Field('first_name', null, 'Jeferson');
        $field = new \SirenPHP\Field('last_name', 'text');
        $this->setExpectedException('\InvalidArgumentException');
        $field = new \SirenPHP\Field('last_name', 'unknow');
    }

    public function testFieldName() {
        $field = new \SirenPHP\Field('user_name');
        $this->setExpectedException('\InvalidArgumentException');
        $field->setName(null);
    }

    public function testSerialize() {
        $field = new \SirenPHP\Field('user_name');
        $this->assertEquals((string)$field, '{"name":"user_name"}');

        $field->setName('user_id')->setType('number');
        $this->assertEquals((string)$field, '{"name":"user_id","type":"number"}');

        $field->setValue(1);
        $this->assertEquals((string)$field, '{"name":"user_id","type":"number","value":1}');
    }
}
