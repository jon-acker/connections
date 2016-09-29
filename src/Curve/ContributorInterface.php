<?php

namespace Curve;

interface ContributorInterface
{
    /**
     * @param ContributorInterface $contributor
     *
     * @return integer
     */
    public function distance(ContributorInterface $contributor);

    /**
     * @param ContributorInterface $contributorInterface
     *
     * @return boolean
     */
    public function matches(ContributorInterface $contributor);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return ContributorInterface[]
     */
    public function getCoContributors();
}
