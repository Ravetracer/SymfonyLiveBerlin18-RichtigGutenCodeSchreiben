<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @author: Christian Nielebock <christian.nielebock@reservix.de
 * Date: 25.10.18
 * Copyright: (c) 2018 by Reservix GmbH
 */

namespace example;

use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\TestCase;

final class CarrierTest extends TestCase
{
    /**
     * @var Ship
     */
    private $ship;

    /**
     * @var Ship
     */
    private $shipWithRoute;

    public function setUp()
    {
        $this->ship = new Ship('Excelsior', Ship::POSITION_CARRIER, new Port('Gloomhaven'));
        $this->shipWithRoute = new Ship('Defiant', Ship::POSITION_CARRIER, new Port('Gloomhaven'));
        $this->shipWithRoute->addPort(new Port('Sandypeak'))
            ->addPort(new Port('Icespire Harbour'));
    }

    public function test_carrier_has_a_name(): void
    {
        $name = 'Sandypeak';
        $carrier = new Carrier($name, $this->ship);

        $this->assertEquals($name, $carrier->name());
    }

    public function test_carrier_cannot_have_empty_name(): void
    {
        $this->expectException(InvalidNameException::class);
        $carrier = new Carrier('', $this->ship);
    }

    public function test_carrier_has_at_least_one_ship(): void
    {
        $carrier = new Carrier('Sandypeak', $this->ship);

        $this->assertCount(1, $carrier->ships());
    }

    public function test_carrier_cannot_have_no_ships(): void
    {
        $carrier = new Carrier('Sandypeak', $this->ship);

        $this->expectException(InvalidNumberOfShipsException::class);
        $carrier->removeShip($this->ship);
    }

    public function test_carrier_has_ship_for_specific_route(): void
    {
        $carrier = new Carrier('Sandypeak', $this->ship);
        $carrier->addShip($this->shipWithRoute);

        $hasRoute = $carrier->hasShipForRoute([
            new Port('Gloomhaven'),
            new Port('Sandypeak'),
            new Port('Icespire Harbour')
        ]);

        $this->assertTrue($hasRoute);
    }

    public function test_carrier_has_no_ship_for_specific_route(): void
    {
        $carrier = new Carrier('Sandypeak', $this->ship);
        $carrier->addShip($this->shipWithRoute);

        $dontHaveRoute = $carrier->hasShipForRoute([
            new Port('Sandypeak'),
            new Port('Icespire Harbour'),
            new Port('Gloomhaven')
        ]);

        $this->assertFalse($dontHaveRoute);
    }
}
