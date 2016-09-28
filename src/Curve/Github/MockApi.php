<?php

namespace Curve\Github;

class MockApi implements GitHubApi
{
    public function getRepositoriesContributedToBy($contributor)
    {
        $repositories = [
            'seladek' => [
                'Composer',
                'Monolog'
            ],
            'christoph' => [
                'PhpSpec',
                'Prophecy',
            ],
            'everzet' => [
                'Behat',
                'Prophecy'
            ],
            'ciaran' => [
                'Behat',
                'PhpSpec'
            ],
            'jon' => [
                'Composer'
            ],
            'marcello' => [
                'PhpSpec',
                'Composer'
            ],
            'sam' => [
                'Tolerance'
            ]
        ];

        return $repositories[$contributor];

    }

    public function getContributorsFor($repository)
    {
        $contributors = [
            'Behat' => [
                'jon',
                'everzet',

            ],
            'PhpSpec' => [
                'jon',
                'ciaran'
            ],
            'Prophecy' => [
                'ciaran',
            ],
            'Composer' => [
                'sam',
                'marcello'
            ],
            'Tolerance' => [

            ],
            'Monolog' => [

            ]
        ];

        return $contributors[$repository];

    }
}
