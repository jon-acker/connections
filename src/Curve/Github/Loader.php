<?php

namespace Curve\Github;

use Curve\Contributor;
use Curve\Contributor\LazyContributor;

class Loader
{
    /**
     * @var array
     */
    private static $processedProjects = [];

    /**
     * @var GitHubApi
     */
    private $api;

    /**
     * Loader constructor.
     */
    public function __construct(GitHubApi $api)
    {
        $this->api = $api;
    }

    public static function initialize()
    {
        self::$processedProjects = [];

    }

    /**
     * @param string $name Name of contributor whose repositories we want to load
     *
     * @return Contributor[]
     */
    public function load($name)
    {
        $coContributors = [];

        $projects = $this->api->getRepositoriesContributedToBy($name);

        foreach ($projects as $project) {
            if (in_array($project, self::$processedProjects)) {
                continue;
            }

            $coContributors += array_map(function($name) {
                return new LazyContributor(new Contributor($name), $this);
            }, $this->api->getContributorsFor($project));;

            self::$processedProjects[] = $project;
        }

        return $coContributors;
    }
}
