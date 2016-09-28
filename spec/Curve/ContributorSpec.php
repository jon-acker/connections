<?php

namespace spec\Curve;

use Curve\CoContributors;
use Curve\Contributor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContributorSpec extends ObjectBehavior
{
    function let()
    {
        Contributor::initialize();
    }
    
    function it_returns_distance_of_0_when_there_is_no_connection()
    {
        $this->beConstructedWith('jon', new CoContributors([]));

        $p2 = new Contributor('mike');

        $this->distance($p2)->shouldBe(0);
    }

    function it_returns_distance_of_1_with_one_coContributor()
    {
        $mike = new Contributor('mike', new CoContributors([]));

        $this->beConstructedWith('jon', new CoContributors([$mike]));

        $this->distance($mike)->shouldBe(1);
    }

    function it_returns_distance_of_1_with_more_than_one_coContributor()
    {

        $mike = new Contributor('mike', new CoContributors([]));
        $jack = new Contributor('jack', new CoContributors([]));

        $this->beConstructedWith('jon', new CoContributors([$mike, $jack]));

        $this->distance($jack)->shouldBe(1);
    }

    function it_returns_distance_of_2_when_connection_spans_two_people()
    {

        $mick = new Contributor('mick', new CoContributors([]));
        $mike = new Contributor('mike', new CoContributors([]));
        $jack = new Contributor('jack', new CoContributors([$mick]));

        $this->beConstructedWith('jon', new CoContributors([$mike, $jack]));

        $this->distance($mick)->shouldBe(2);
    }

    function it_returns_distance_when_connection_spans_more_than_two_people()
    {
        $anna  = new Contributor('anna', new CoContributors([]));
        $mick  = new Contributor('mick',new CoContributors([]));
        $mary  = new Contributor('mary', new CoContributors([$anna]));
        $james = new Contributor('james', new CoContributors([$mary]));
        $mike  = new Contributor('mike', new CoContributors([]));
        $jack  = new Contributor('jack', new CoContributors([$mick, $james]));

        $this->beConstructedWith('jon', new CoContributors([$mike, $jack]));

        $this->distance($mary)->shouldBe(3);
    }

    function it_returns_shortest_distance()
    {
        $anna  = new Contributor('anna', new CoContributors([]));
        $mick  = new Contributor('mick',new CoContributors([]));
        $mary  = new Contributor('mary', new CoContributors([$anna]));
        $james = new Contributor('james', new CoContributors([$mary]));
        $jacksFriends = new CoContributors([$mick, $james ]);

        $mike  = new Contributor('mike', new CoContributors([]));
        $jack  = new Contributor('jack', $jacksFriends);

        $this->beConstructedWith('jon', new CoContributors([$mike, $jack]));

        $this->distance($anna)->shouldBe(4);
    }
}
