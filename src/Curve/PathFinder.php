<?php

namespace Curve;

use Curve\Contributor\LazyContributorFactory;
use Curve\Github\Loader;

class PathFinder
{

    /**
     * @var Contributor
     */
    private $contributor;
    
    /**
     * @var LazyContributorFactory
     */
    private $contributorFactory;

    /**
     * @param LazyContributorFactory $contributorFactory
     */
    public function __construct(LazyContributorFactory $contributorFactory)
    {
        $this->contributorFactory = $contributorFactory;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function distanceFrom($name)
    {
        $contributor = $this->contributorFactory->named($name);
        $contributor->initialize();

        $this->contributor = $contributor;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return integer
     */
    public function to($name)
    {
        return $this->contributor->distance($this->contributorFactory->named($name));
    }
}
