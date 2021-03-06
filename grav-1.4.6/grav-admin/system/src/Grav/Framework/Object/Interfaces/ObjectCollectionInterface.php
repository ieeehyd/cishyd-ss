<?php
/**
 * @package    Grav\Framework\Object
 *
 * @copyright  Copyright (C) 2015 - 2018 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Framework\Object\Interfaces;

use Grav\Framework\Collection\CollectionInterface;

/**
 * ObjectCollection Interface
 * @package Grav\Framework\Collection
 */
interface ObjectCollectionInterface extends CollectionInterface, ObjectInterface
{
    /**
     * Create a copy from this collection by cloning all objects in the collection.
     *
     * @return static
     */
    public function copy();

    /**
     * @param string $key
     * @return $this
     */
    public function setKey($key);

    /**
     * @return array
     */
    public function getObjectKeys();

    /**
     * @param string $property      Object property to be fetched.
     * @param mixed $default        Default value if not set.
     * @return array                Property value.
     */
    public function getProperty($property, $default = null);

    /**
     * @param string $name          Method name.
     * @param array  $arguments     List of arguments passed to the function.
     * @return array                Return values.
     */
    public function call($name, array $arguments);

    /**
     * Group items in the collection by a field and return them as associated array.
     *
     * @param string $property
     * @return array
     */
    public function group($property);

    /**
     * Group items in the collection by a field and return them as associated array of collections.
     *
     * @param string $property
     * @return static[]
     */
    public function collectionGroup($property);
}
