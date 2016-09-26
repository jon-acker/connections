<?php

namespace Curve;

class Contributor
{
    /**
     * @var Acquaintances[]
     */
    private $acquaintances = [];

    /**
     * @var string
     */
    public $name;

    /**
     * @param string $name
     * @param Acquaintances|null $acquaintances
     */
    public function __construct($name, Acquaintances $acquaintances = null)
    {
        $this->name = $name;
        $this->acquaintances = $acquaintances ?: new Acquaintances();
    }

    /**
     * @return Acquaintances[]
     */
    public function getAcquaintances()
    {
        return $this->acquaintances->all($this->name);
    }

    /**
     * @param Contributor $person
     *
     * @return integer
     */
    public function distance(Contributor $person)
    {
        foreach ($this->getAcquaintances() as $acquaintance) {
            if ($acquaintance->name === $person->name) {
                return 1;
            }
        }

        return $this->acquaintancesDistance($person);
    }

    /**
     * @param Contributor $person
     *
     * @return integer
     */
    private function acquaintancesDistance(Contributor $person)
    {
        $distance = 0;

        foreach ($this->getAcquaintances() as $acquaintance) {
            if ($distance = $acquaintance->distance($person)) {
                $distance++;
                break;
            }
        }

        return $distance;
    }
}
