<?php

namespace Curve;

use Curve\Github\Loader;

class PathFinder
{

    /**
     * @var Contributor
     */
    private $contributor;


    public function distanceFrom($name)
    {
        Contributor::initialize();
        Loader::initialize();

        $this->contributor = new Contributor($name);

        return $this;
    }

    public function to($name)
    {
        return $this->contributor->distance(new Contributor($name));
    }

}
