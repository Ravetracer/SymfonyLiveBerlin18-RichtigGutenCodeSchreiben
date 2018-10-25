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

class ContainerTest extends TestCase
{
    public function test_has_an_identification(): void
    {
        $id = ContainerId::fromString('CSQU3054383');
        $container = new Container($id);

        $this->assertSame($id, $container->containerId());
    }

    public function test_has_a_destination_port(): void
    {
        $id = ContainerId::fromString('CSQU3054383');
        $container = new Container($id);

        $port = new Port('Westhafen');
        $container->setPort($port);

        $this->assertSame($port, $container->port());
    }
}
