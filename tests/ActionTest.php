<?php
class ActionTest extends PHPUnit_Framework_TestCase {
    public function testConstructor() {
        $action = new \SirenPHP\Action('list-user', '/user');
        $this->setExpectedException('\InvalidArgumentException');
        $action = new \SirenPHP\Action('list-user', null);
    }

    public function testSetName() {
        $action = new \SirenPHP\Action('lit-user', '/user');
        $this->setExpectedException('\InvalidArgumentException');
        $action->setName(null);
    }

    public function testAppendField() {
        $action = new \SirenPHP\Action('insert-user', '/user');
        $action->setMethod('POST')
               ->appendField(new \SirenPHP\Field('first_name'))
               ->appendField(new \SirenPHP\Field('last_name'));

        $this->assertTrue($action->existField('first_name'));
        $this->assertTrue($action->existField('last_name'));
        $this->assertFalse($action->existField('user_id'));
    }

    public function testSerialize() {
        $action = new \SirenPHP\Action('insert-user', '/user');
        $this->assertEquals((string)$action, '{"name":"insert-user","href":"\/user"}');

        $action
            ->setMethod('POST')
            ->setType('application/json');
        $this->assertEquals((string)$action, '{"name":"insert-user","href":"\/user","method":"POST","type":"application\/json"}');

        $action->appendField(new \SirenPHP\Field('first_name'))->appendField(new \SirenPHP\Field('last_name'));

        $serialized = '{"name":"insert-user","href":"\/user","method":"POST","type":"application\/json","fields":[{"name":"first_name"},{"name":"last_name"}]}';
        $this->assertEquals((string)$action, $serialized);
    }
}
