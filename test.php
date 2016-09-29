<?php
use Curve\PathFinder;

require_once 'vendor/autoload.php';

use Curve\Contributor\LazyContributorFactory;
use Curve\Github\Loader;
use Curve\Github\MockApi;

$contributorFactory = new LazyContributorFactory(new Loader(new MockApi()));

$finder = new PathFinder($contributorFactory);

expect($finder->distanceFrom('ciaran')->to('jon'))->toBe(1);
expect($finder->distanceFrom('christoph')->to('sam'))->toBe(2);
expect($finder->distanceFrom('jon')->to('ciaran'))->toBe(2);
expect($finder->distanceFrom('seladek')->to('everzet'))->toBe(3);
expect($finder->distanceFrom('seladek')->to('nonexist'))->toBe(0);

echo "√ All tests pass \n";
