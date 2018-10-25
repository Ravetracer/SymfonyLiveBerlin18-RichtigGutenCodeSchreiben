<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @author: Christian Nielebock <christian.nielebock@reservix.de
 * Date: 25.10.18
 * Copyright: (c) 2018 by Reservix GmbH
 */

namespace example;

use PHPUnit\Framework\TestCase;

class ShipTest extends TestCase
{

    public function test_ship_has_a_name(): void
    {
        $shipName = 'Excelsior';
        $ship = new Ship($shipName, Ship::POSITION_PORT, new Port('Gloomhaven'));

        $this->assertEquals($shipName, $ship->name());
    }

    public function test_ship_cannot_have_empty_name(): void
    {
        $this->expectException(InvalidNameException::class);

        new Ship('', Ship::POSITION_PORT, new Port('Gloomhaven'));
    }

    public function test_ship_has_positive_capacity(): void
    {
        $ship = new Ship('Excelsior', Ship::POSITION_PORT, new Port('Gloomhaven'));
        $ship->setCapacity(2);

        $this->assertGreaterThan(0, $ship->capacity());
    }

    public function test_ship_cannot_have_negative_capacity(): void
    {
        $this->expectException(InvalidCapacityException::class);
        $ship = new Ship('Excelsior', Ship::POSITION_PORT, new Port('Gloomhavenn'));
        $ship->setCapacity(-2);
    }

    public function test_ship_has_a_position(): void
    {
        $ship = new Ship('Excelsior', Ship::POSITION_PORT, new Port('Gloomhaven'));

        $this->assertEquals(Ship::POSITION_PORT, $ship->position());
    }

    public function test_ship_cannot_have_invalid_position(): void
    {
        $ship = new Ship('Excelsior', Ship::POSITION_PORT, new Port('Gloomhaven'));
        $position = 8;

        $this->expectException(InvalidPositionException::class);

        $ship->setPosition($position);
    }

    public function test_ship_has_at_least_one_destination_port(): void
    {
        $port = new Port('Gloomhaven');
        $ship = new Ship('Excelsior', Ship::POSITION_PORT, $port);

        $this->assertGreaterThan(0, count($ship->ports()));
    }

    public function test_ship_cannot_have_zero_ports(): void
    {
        $port = new Port('Gloomhaven');
        $ship = new Ship('Excelsior', Ship::POSITION_PORT, $port);

        $this->expectException(InvalidNumberOfPortsException::class);
        $ship->removePort($port);
    }
}
