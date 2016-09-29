<?php

namespace Curve\Contributor;

use Curve\Contributor;
use Curve\Github\Loader;

class LazyContributorFactory
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * LazyContributorFactory constructor.
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function named($name)
    {
        return new LazyContributor(new Contributor($name), $this->loader);
    }
}
