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
        $ship = new Ship($shipName);

        $this->assertEquals($shipName, $ship->name());
    }

    public function test_ship_cannot_have_empty_name(): void
    {
        $this->expectException(InvalidNameException::class);

        $ship = new Ship('');
    }

    public function test_ship_has_positive_capacity(): void
    {
        $shipName = 'Excelsior';
        $ship = new Ship($shipName);
        $ship->setCapacity(2);

        $this->assertGreaterThan(0, $ship->capacity());
    }

    public function test_ship_cannot_have_negative_capacity(): void
    {
        $this->expectException(InvalidCapacityException::class);
        $shipName = 'Excelsior';
        $ship = new Ship($shipName);
        $ship->setCapacity(-2);
    }

    public function skip_test_ship_has_a_position($shipName): void
    {
        $ship = new Ship($shipName);

        $position = 'port';

        $ship->setPosition($position);

        $this->assertEquals($position, $ship->position());
    }
}
