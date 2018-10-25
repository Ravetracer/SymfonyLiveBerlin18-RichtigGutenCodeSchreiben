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
    const POSITION_PORT = 0;
    const POSITION_CARRIER = 1;
    const POSITION_UNKNOWN = 2;

    /**
     * @var string
     */
    private $shipName;

    /**
     * @var int
     */
    private $capacity;

    /**
     * @var int
     */
    private $position;

    /**
     * @var array
     */
    private $ports;

    /**
     * Ship constructor.
     *
     * @param string $shipName
     */
    public function __construct(string $shipName, $position, Port $port)
    {
        $this->ensureNameIsNotEmpty($shipName);
        $this->ensureCorrectPosition($position);

        $this->shipName = $shipName;
        $this->position = $position;
        $this->addPort($port);
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

    public function setPosition($position): Ship
    {
        $this->ensureCorrectPosition($position);

        $this->position = $position;

        return $this;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function addPort(Port $port): Ship
    {
        $this->ports[] = $port;

        return $this;
    }

    public function removePort(Port $port): Ship
    {
        $this->ensureAtLeastOnePort();

        unset($this->ports[\array_search($port, $this->ports, true)]);

        return $this;
    }

    public function ports(): array
    {
        return $this->ports;
    }


    private function ensureNameIsNotEmpty(string $name)
    {
        if (empty(\trim($name))) {
            throw new InvalidNameException('Ship name must be not empty!');
        }
    }

    private function ensureCapacityIsPositive(int $capacity)
    {
        if (0 > $capacity) {
            throw new InvalidCapacityException('The ship cannot have a negative capacity!');
        }
    }

    private function ensureCorrectPosition(int $position)
    {
        if (!\in_array($position, [self::POSITION_PORT, self::POSITION_CARRIER, self::POSITION_UNKNOWN], true)) {
            throw new InvalidPositionException('Please provide a correct position!');
        }
    }

    private function ensureAtLeastOnePort()
    {
        if (1 === count($this->ports)) {
            throw new InvalidNumberOfPortsException('You must have at least one destination port stored!');
        }
    }
}
