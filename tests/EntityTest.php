<?php
class EntityTest extends PHPUnit_Framework_TestCase {
    public function testConstructor() {
        $entity = new \SirenPHP\Entity('http://localhost/api/project', array(
            'projectId' => '1',
            'name' => 'The Test Project'
        ));

        $this->setExpectedException('\InvalidArgumentException');
        $entity = new \SirenPHP\Entity(null, array());
    }

    public function testSetTitle() {
        $entity = new \SirenPHP\Entity('url', array());
        $this->setExpectedException('\InvalidArgumentException');
        $entity->setTitle(array());
    }

    public function testSerialize() {
        $collection = new \SirenPHP\Entity('/collection/1', array('count'=>3), array('collection'));
        $collection->appendEntity(array('item'), new \SirenPHP\Entity('/book/1', array('name'=>'The Book 1'), array('book')));
        $collection->appendEntity(array('item'), new \SirenPHP\Entity('/book/2', array('name'=>'The Book 2'), array('book')));
        $collection->appendEntity(array('item'), new \SirenPHP\Entity('/book/3', array('name'=>'The Book 3'), array('book')));
        $collection->appendEntity(array('item'), new \SirenPHP\LinkedEntity('/wikipedia/1', array('wikipedia'))); 
        $collection->appendLink(new \SirenPHP\Link(array('next'), '/collection/2'));


        $resultString = '{"class":["collection"],"properties":{"count":3},"entities":[{"rel":["item"],"class":["book"],"properties":{"name":"The Book 1"},"links":[{"rel":["self"],"href":"\/book\/1"}]},{"rel":["item"],"class":["book"],"properties":{"name":"The Book 2"},"links":[{"rel":["self"],"href":"\/book\/2"}]},{"rel":["item"],"class":["book"],"properties":{"name":"The Book 3"},"links":[{"rel":["self"],"href":"\/book\/3"}]},{"href":"\/wikipedia\/1","class":["wikipedia"],"rel":["item"]}],"links":[{"rel":["self"],"href":"\/collection\/1"},{"rel":["next"],"href":"\/collection\/2"}]}';
        $this->assertEquals((string)$collection, $resultString);
    }
}
