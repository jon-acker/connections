<?php

namespace spec\Curve;

use Curve\Acquaintances;
use Curve\Contributor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContributorSpec extends ObjectBehavior
{
    function it_returns_distance_of_0_when_there_is_no_connection()
    {
        $this->beConstructedWith('jon', new Acquaintances([]));

        $p2 = new Contributor('mike');

        $this->distance($p2)->shouldBe(0);
    }

    function it_returns_distance_of_1_with_one_acquaintance()
    {
        $mike = new Contributor('mike');

        $this->beConstructedWith('jon', new Acquaintances([$mike]));

        $this->distance($mike)->shouldBe(1);
    }

    function it_returns_distance_of_1_with_more_than_one_acquaintance()
    {

        $mike = new Contributor('mike');
        $jack = new Contributor('jack');

        $this->beConstructedWith('jon', new Acquaintances([$mike, $jack]));

        $this->distance($mike)->shouldBe(1);
        $this->distance($jack)->shouldBe(1);
    }

    function it_returns_distance_of_2_when_connection_spans_two_people()
    {

        $mick = new Contributor('mick');
        $mike = new Contributor('mike', new Acquaintances([]));
        $jack = new Contributor('jack', new Acquaintances([$mick]));

        $this->beConstructedWith('jon', new Acquaintances([$mike, $jack]));

        $this->distance($mick)->shouldBe(2);
    }

    function it_returns_distance_when_connection_spans_more_than_two_people()
    {
        $anna  = new Contributor('anna');
        $mick  = new Contributor('mick',new Acquaintances([]));
        $mary  = new Contributor('mary', new Acquaintances([$anna]));
        $james = new Contributor('james', new Acquaintances([$mary]));
        $mike  = new Contributor('mike', new Acquaintances([]));
        $jack  = new Contributor('jack', new Acquaintances([$mick, $james]));

        $this->beConstructedWith('jon', new Acquaintances([$mike, $jack]));

        $this->distance($mary)->shouldBe(3);
        $this->distance($anna)->shouldBe(4);
    }

    function it_returns_shortest_distance()
    {
        $anna  = new Contributor('anna', new Acquaintances([]));
        $mick  = new Contributor('mick',new Acquaintances([]));
        $mary  = new Contributor('mary', new Acquaintances([$anna]));
        $james = new Contributor('james', new Acquaintances([$mary]));
        $mike  = new Contributor('mike', new Acquaintances([]));
        $jack  = new Contributor('jack', new Acquaintances([$mick, $james, $anna]));

        $this->beConstructedWith('jon', new Acquaintances([$mike, $jack]));

        $this->distance($mary)->shouldBe(3);
        $this->distance($anna)->shouldBe(2);
    }
}
