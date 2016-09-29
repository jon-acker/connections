<?php

namespace Curve\Github;

class MockApi implements GitHubApi
{
    public function getRepositoriesContributedToBy($contributor)
    {
        $repositories = [
            'everzet' => [
                'Behat',
                'Prophecy'
            ],
            'ciaran' => [
                'Behat'
            ],
            'jon' => [
                'Composer'
            ],
            'marcello' => [

            ]
        ];

        return $repositories[$contributor];

    }

    public function getContributorsFor($repository)
    {
        $contributors = [
            'Behat' => [
                'jon',
                'ciaran',
                'marcello'
            ],
            'Composer' => [
                'marcello'
            ],
            'Prophecy' => [

            ]
        ];

        return $contributors[$repository];

    }
}
