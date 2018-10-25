<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @author: Christian Nielebock <christian.nielebock@reservix.de
 * Date: 25.10.18
 * Copyright: (c) 2018 by Reservix GmbH
 */

namespace example;


final class Container
{

    /**
     * @var ContainerId
     */
    private $containerId;

    /**
     * @var Port
     */
    private $port;

    /**
     * Container constructor.
     *
     * @param ContainerId $id
     */
    public function __construct(ContainerId $containerId)
    {
        $this->containerId = $containerId;
    }

    public function containerId(): ContainerId
    {
        return $this->containerId;
    }

    public function setPort(Port $port): Container
    {
        $this->port = $port;

        return $this;
    }

    public function port(): Port
    {
        return $this->port;
    }
}
