<?php

namespace Curve;

use Curve\Github\Api;
use Curve\Github\MockApi;

class Acquaintances
{
    /**
     * @var Person[]
     */
    private $list;

    private $repository;

    private static $processedProjects = [];

    /**
     * @param Contributor[]|null $list
     */
    public function __construct(array $list = null)
    {
        $this->repository = new MockApi();
        $this->list = $list;
    }

    /**
     * @param string $name Name of contributors repository to load
     */
    public function load($name)
    {
        $projects = $this->repository->getRepositoriesContributedToBy($name);
        $this->list = [];

        foreach ($projects as $project) {
            if (in_array($project, self::$processedProjects)) {
                continue;
            }

            $list = array_map(function($u) { return new Contributor($u); }, $this->repository->getContributorsFor($project));

            $this->list = array_merge($this->list, $list);

            self::$processedProjects[] = $project;
        }
    }

    public function all($name)
    {
        if ($this->list === null) {
            $this->load($name);
        }

        return $this->list;
    }
}
