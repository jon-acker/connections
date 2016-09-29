<?php

namespace Curve;

class Contributor implements ContributorInterface
{
    /**
     * @var Contributor[]
     */
    private $coContributors = null;

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
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function initialize()
    {
        self::$pathTaken = [];
        self::$distance = 0;
        self::$found = [];
        self::$shortestDistance = 0;
    }

    /**
     * @return ContributorInterface[]
     */
    public function getCoContributors()
    {
        return $this->coContributors;
    }

    /**
     * @param ContributorInterface $contributor
     *
     * @return integer
     */
    public function distance(ContributorInterface $contributor)
    {
        array_push(self::$pathTaken, $this);

        foreach ($this->coContributors as $k => $coContributor) {

            self::$distance += (int)($k === 0);

            if ($coContributor->matches($contributor)) {

                if ($this->wasFoundBefore($contributor)) {
                    return min(self::$shortestDistance, self::$distance);
                }

                self::$found[] = $contributor->getName();
                self::$shortestDistance = self::$distance;

                return array_pop(self::$pathTaken)->distance($contributor);
            }
        }

        foreach ($this->coContributors as $coContributor) {
            $coContributor->distance($contributor);
        }

        return self::$shortestDistance;
    }

    /**
     * @param ContributorInterface $contributor
     * @return bool
     */
    public function matches(ContributorInterface $contributor)
    {
        return $this->name === $contributor->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param ContributorInterface[] $contributors
     */
    public function setCoContributors(array $contributors)
    {
        $this->coContributors = $contributors;
    }

    /**
     * @param ContributorInterface $contributor
     * @return bool
     */
    private function wasFoundBefore(ContributorInterface $contributor)
    {
        return in_array($contributor->getName(), self::$found);
    }
}
