<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @author: Christian Nielebock <christian.nielebock@reservix.de
 * Date: 25.10.18
 * Copyright: (c) 2018 by Reservix GmbH
 */

namespace example;


final class Carrier
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $ships;

    /**
     * Carrier constructor.
     *
     * @param string $name
     * @param Ship   $ship
     */
    public function __construct(string $name, Ship $ship)
    {
        $this->ensureNameIsNotEmpty($name);

        $this->name = $name;
        $this->addShip($ship);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function addShip(Ship $ship): Carrier
    {
        $this->ships[] = $ship;

        return $this;
    }

    public function ships(): array
    {
        return $this->ships;
    }

    public function removeShip(Ship $ship): Carrier
    {
        $this->ensureAtLeastOneShip();

        unset($this->ships[\array_search($ship, $this->ships)]);
        return $this;
    }

    public function hasShipForRoute(array $route): bool
    {
        $routeNames = $this->getPortNames($route);

        foreach ($this->ships as $currentShip) {
            $shipPorts = $this->getPortNames($this->getShipPorts($currentShip));

            if ($routeNames === $shipPorts) {
                return true;
            }
        }
        return false;
    }

    public function getShipPorts(Ship $ship): array
    {
        return $ship->ports();
    }

    private function getPortNames(array $ports)
    {
        $names = [];

        /**
         * @var Port $currentPort
         */
        foreach ($ports as $currentPort) {
            $names[] = $currentPort->name();
        }

        return $names;
    }

    private function ensureNameIsNotEmpty(string $name)
    {
        if (empty(\trim($name))) {
            throw new InvalidNameException('Carrier name must be not empty!');
        }
    }

    private function ensureAtLeastOneShip(): void
    {
        if (2 > count($this->ships)) {
            throw new InvalidNumberOfShipsException('You must have at least one ship in the carrier!');
        }
    }
}
