<?php
/**
 * @package    Grav\Framework\Collection
 *
 * @copyright  Copyright (C) 2015 - 2018 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Framework\Collection;

use Doctrine\Common\Collections\ArrayCollection as BaseArrayCollection;

/**
 * General JSON serializable collection.
 *
 * @package Grav\Framework\Collection
 */
class ArrayCollection extends BaseArrayCollection implements CollectionInterface
{
    /**
     * Reverse the order of the items.
     *
     * @return static
     */
    public function reverse()
    {
        // TODO: remove when PHP 5.6 is minimum (with doctrine/collections v1.4).
        if (!method_exists($this, 'createFrom')) {
            return new static(array_reverse($this->toArray()));
        }

        return $this->createFrom(array_reverse($this->toArray()));
    }

    /**
     * Shuffle items.
     *
     * @return static
     */
    public function shuffle()
    {
        $keys = $this->getKeys();
        shuffle($keys);

        // TODO: remove when PHP 5.6 is minimum (with doctrine/collections v1.4).
        if (!method_exists($this, 'createFrom')) {
            return new static(array_replace(array_flip($keys), $this->toArray()));
        }

        return $this->createFrom(array_replace(array_flip($keys), $this->toArray()));
    }

    /**
     * Split collection into chunks.
     *
     * @param int $size     Size of each chunk.
     * @return array
     */
    public function chunk($size)
    {
        return array_chunk($this->toArray(), $size, true);
    }

    /**
     * Implementes JsonSerializable interface.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
