<?php

namespace Curve\Contributor;

use Curve\Contributor;
use Curve\ContributorInterface;
use Curve\Github\Loader;

class LazyContributor implements ContributorInterface
{
    /**
     * @var Contributor
     */
    private $contributor;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * LazyContributor constructor.
     */
    public function __construct(Contributor $contributor, Loader $loader)
    {
        $this->contributor = $contributor;
        $this->loader = $loader;
    }

    /**
     * @param ContributorInterface $contributor
     * @return integer
     */
    public function distance(ContributorInterface $contributor)
    {
        $this->load();

        return $this->contributor->distance($contributor);
    }

    /**
     * @param ContributorInterface $contributor
     * @return bool
     */
    public function matches(ContributorInterface $contributor)
    {
        return $this->contributor->matches($contributor);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->contributor->getName();
    }

    /**
     * @return ContributorInterface[]
     */
    public function getCoContributors()
    {
        $this->load();

        return $this->contributor->getCoContributors();
    }

    public function initialize()
    {
        $this->loader->initialize();
        $this->contributor->initialize();
    }

    private function load()
    {
        if (!$this->loaded) {
            $contributors = $this->loader->load($this->contributor->getName());
            $this->contributor->setCoContributors($contributors);
            $this->loaded = true;
        }
    }

}
