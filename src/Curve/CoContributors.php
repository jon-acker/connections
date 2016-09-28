<?php

namespace Curve;

use Curve\Github\Loader;
use Curve\Github\MockApi;

class CoContributors
{
    /**
     * @var Contributor[]
     */
    private $list;

    /**
     * @param Contributor[]|null $list
     */
    public function __construct(array $list = null)
    {
        $this->list = $list;
        $this->loader = new Loader(new MockApi());
    }

    /**
     * @param $name
     * @return Contributor[]
     */
    public function all($name)
    {
        if (is_null($this->list)) {
            $this->list = $this->loader->load($name);
        }

        return $this->list;
    }

    /**
     * @param Contributor $contributor
     */
    public function add(Contributor $contributor)
    {
        $this->list[] = $contributor;
    }
}
