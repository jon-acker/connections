<?php
use Curve\Contributor;

require_once 'vendor/autoload.php';


$person1 = new Contributor('christoph');
$person2 = new Contributor('sam');

expect($person1->distance($person2))->toBe(2);

$person1 = new Contributor('seladek');
$person2 = new Contributor('marcello');

expect($person1->distance($person2))->toBe(0);
