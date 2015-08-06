SirenPHP
========

[![Latest Stable Version](https://poser.pugx.org/jefersondaniel/siren-php/v/stable.svg)](https://packagist.org/packages/jefersondaniel/siren-php) [![Total Downloads](https://poser.pugx.org/jefersondaniel/siren-php/downloads.svg)](https://packagist.org/packages/jefersondaniel/siren-php) [![Latest Unstable Version](https://poser.pugx.org/jefersondaniel/siren-php/v/unstable.svg)](https://packagist.org/packages/jefersondaniel/siren-php) [![License](https://poser.pugx.org/jefersondaniel/siren-php/license.svg)](https://packagist.org/packages/jefersondaniel/siren-php)

Siren hypermedia type implementation for PHP

## Introduction

Siren is a hypermedia specification for representing entities.  As HTML is used for visually representing documents on a Web site, Siren is a specification for presenting entities via a Web API.  Siren offers structures to communicate information about entities, actions for executing state transitions, and links for client navigation.  

[See siren specification](https://github.com/kevinswiber/siren)

## Installing with composer

    composer.phar require jefersondaniel/siren-php
    
## Encoding a resource

```php
$collection = new \SirenPHP\Entity('/collection/1', array('count'=>3), array('collection'));
$collection->appendEntity(array('item'), new \SirenPHP\Entity('/book/1', array('name'=>'The Book 1'), array('book')));
$collection->appendLink(new \SirenPHP\Link(array('next'), '/collection/2'));
  
echo $collection->__toString();
```
