<?php
/**
 * @package    Grav\Framework\Object
 *
 * @copyright  Copyright (C) 2015 - 2018 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Framework\Object\Base;

use Grav\Framework\Object\Interfaces\ObjectInterface;

/**
 * ObjectCollection Trait
 * @package Grav\Framework\Object
 */
trait ObjectCollectionTrait
{
    use ObjectTrait {
        setKey as public;
    }

    /**
     * Create a copy from this collection by cloning all objects in the collection.
     *
     * @return static
     */
    public function copy()
    {
        $list = [];
        foreach ($this->getIterator() as $key => $value) {
            $list[$key] = is_object($value) ? clone $value : $value;
        }

        // TODO: remove when PHP 5.6 is minimum (with doctrine/collections v1.4).
        if (!method_exists($this, 'createFrom')) {
            return new static($list);
        }

        return $this->createFrom($list);
    }

    /**
     * @return array
     */
    public function getObjectKeys()
    {
        return $this->call('getKey');
    }

    /**
     * @param string $property      Object property to be matched.
     * @return array                Key/Value pairs of the properties.
     */
    public function doHasProperty($property)
    {
        $list = [];

        /** @var ObjectInterface $element */
        foreach ($this->getIterator() as $id => $element) {
            $list[$id] = $element->hasProperty($property);
        }

        return $list;
    }

    /**
     * @param string $property      Object property to be fetched.
     * @param mixed $default        Default value if not set.
     * @return array                Key/Value pairs of the properties.
     */
    public function doGetProperty($property, $default = null)
    {
        $list = [];

        /** @var ObjectInterface $element */
        foreach ($this->getIterator() as $id => $element) {
            $list[$id] = $element->getProperty($property, $default);
        }

        return $list;
    }

    /**
     * @param string $property  Object property to be updated.
     * @param string $value     New value.
     * @return $this
     */
    public function doSetProperty($property, $value)
    {
        /** @var ObjectInterface $element */
        foreach ($this->getIterator() as $element) {
            $element->setProperty($property, $value);
        }

        return $this;
    }

    /**
     * @param string $property  Object property to be updated.
     * @return $this
     */
    public function doUnsetProperty($property)
    {
        /** @var ObjectInterface $element */
        foreach ($this->getIterator() as $element) {
            $element->unsetProperty($property);
        }

        return $this;
    }

    /**
     * @param string $property  Object property to be updated.
     * @param string $default   Default value.
     * @return $this
     */
    public function doDefProperty($property, $default)
    {
        /** @var ObjectInterface $element */
        foreach ($this->getIterator() as $element) {
            $element->defProperty($property, $default);
        }

        return $this;
    }

    /**
     * @param string $method        Method name.
     * @param array  $arguments     List of arguments passed to the function.
     * @return array                Return values.
     */
    public function call($method, array $arguments = [])
    {
        $list = [];

        foreach ($this->getIterator() as $id => $element) {
            $list[$id] = method_exists($element, $method)
                ? call_user_func_array([$element, $method], $arguments) : null;
        }

        return $list;
    }

    /**
     * Group items in the collection by a field and return them as associated array.
     *
     * @param string $property
     * @return array
     */
    public function group($property)
    {
        $list = [];

        /** @var ObjectInterface $element */
        foreach ($this->getIterator() as $element) {
            $list[(string) $element->getProperty($property)][] = $element;
        }

        return $list;
    }

    /**
     * Group items in the collection by a field and return them as associated array of collections.
     *
     * @param string $property
     * @return static[]
     */
    public function collectionGroup($property)
    {
        $collections = [];
        foreach ($this->group($property) as $id => $elements) {
            // TODO: remove when PHP 5.6 is minimum (with doctrine/collections v1.4).
            if (!method_exists($this, 'createFrom')) {
                $collection = new static($elements);
            } else {
                $collection = $this->createFrom($elements);
            }

            $collections[$id] = $collection;
        }

        return $collections;
    }

    /**
     * @return \Traversable
     */
    abstract public function getIterator();
}
