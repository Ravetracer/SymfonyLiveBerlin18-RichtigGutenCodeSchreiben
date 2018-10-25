<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @author: Christian Nielebock <christian.nielebock@reservix.de
 * Date: 25.10.18
 * Copyright: (c) 2018 by Reservix GmbH
 */

namespace example;


class Ship
{
    /**
     * @var string
     */
    private $shipName;

    /**
     * @var int
     */
    private $capacity;

    /**
     * Ship constructor.
     *
     * @param string $shipName
     */
    public function __construct(string $shipName)
    {
        $this->ensureNameIsNotEmpty($shipName);

        $this->shipName = $shipName;
    }

    public function name(): string
    {
        return $this->shipName;
    }

    public function setCapacity(int $capacity): Ship
    {
        $this->ensureCapacityIsPositive($capacity);

        $this->capacity = $capacity;

        return $this;
    }

    public function capacity(): int
    {
        return $this->capacity;
    }

    private function ensureNameIsNotEmpty(string $name)
    {
        if (empty(trim($name))) {
            throw new InvalidNameException('Ship name must be not empty!');
        }
    }

    private function ensureCapacityIsPositive(int $capacity)
    {
        if (0 > $capacity) {
            throw new InvalidCapacityException('The ship cannot have a negative capacity!');
        }
    }
}
