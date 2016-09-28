<?php

namespace Curve;

class Contributor
{
    /**
     * @var CoContributors[]
     */
    private $coContributors = [];

    /**
     * @var string
     */
    private $name;

    private static $pathTaken = [];

    private static $distance = 0;

    private static $found = [];

    private static $shortestDistance = 0;

    /**
     * @param string $name
     * @param CoContributors $coContributors
     */
    public function __construct($name, CoContributors $coContributors = null)
    {
        $this->name = $name;
        $this->coContributors = $coContributors ?: new CoContributors();
    }

    public static function initialize()
    {
        self::$pathTaken = [];
        self::$distance = 0;
        self::$found = [];
        self::$shortestDistance = 0;
    }

    /**
     * @return CoContributors[]
     */
    public function getCoContributors()
    {
        return $this->coContributors->all($this->name);
    }

    /**
     * @param Contributor $contributor
     *
     * @return integer
     */
    public function distance(Contributor $contributor)
    {
        array_push(self::$pathTaken, $this);

        foreach ($this->getCoContributors() as $k => $coContributor) {

            self::$distance += (int)($k === 0);

            if ($coContributor->matches($contributor)) {

                if ($this->wasFoundBefore($contributor)) {
                    return min(self::$shortestDistance, self::$distance);
                }

                self::$found[] = $contributor->name;
                self::$shortestDistance = self::$distance;

                return array_pop(self::$pathTaken)->distance($contributor);
            }
        }

        foreach ($this->getCoContributors() as $coContributor) {
            $coContributor->distance($contributor);
        }

        return self::$shortestDistance;
    }

    /**
     * @param Contributor $contributor
     * @return bool
     */
    public function matches(Contributor $contributor)
    {
        return $this->name === $contributor->name;
    }

    /**
     * @param Contributor $contributor
     * @return bool
     */
    private function wasFoundBefore(Contributor $contributor)
    {
        return in_array($contributor->name, self::$found);
    }
}
