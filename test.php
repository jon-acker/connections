<?php
use Curve\PathFinder;

require_once 'vendor/autoload.php';

$finder = new PathFinder();

expect($finder->distanceFrom('ciaran')->to('jon'))->toBe(1);
expect($finder->distanceFrom('christoph')->to('sam'))->toBe(2);
expect($finder->distanceFrom('jon')->to('ciaran'))->toBe(2);
expect($finder->distanceFrom('seladek')->to('everzet'))->toBe(3);
expect($finder->distanceFrom('seladek')->to('nonexist'))->toBe(0);

echo "√ All tests pass \n";
