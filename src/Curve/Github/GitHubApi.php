<?php
/**
 * Created by PhpStorm.
 * User: jacker
 * Date: 26/09/2016
 * Time: 13:20
 */

namespace Curve\Github;

interface GitHubApi
{
    public function getRepositoriesContributedToBy($contributor);

    public function getContributorsFor($repository);

}
