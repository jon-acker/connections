<?php

namespace spec\Curve;

use Curve\Contributor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin Contributor
 */
class ContributorSpec extends ObjectBehavior
{
    function let()
    {
        Contributor::initialize();
    }
    
    function it_returns_distance_of_0_when_there_is_no_connection()
    {
        $this->beConstructedWith('jon');

        $this->setCoContributors([]);

        $p2 = new Contributor('mike');

        $this->distance($p2)->shouldBe(0);
    }

    function it_returns_distance_of_1_with_one_coContributor()
    {
        $mike = new Contributor('mike');

        $this->beConstructedWith('jon');
        $this->setCoContributors([$mike]);

        $this->distance($mike)->shouldBe(1);
    }

    function it_returns_distance_of_1_with_more_than_one_co_contributor()
    {

        $mike = new Contributor('mike');
        $jack = new Contributor('jack');

        $this->beConstructedWith('jon');
        $this->setCoContributors([$mike, $jack]);

        $this->distance($jack)->shouldBe(1);
    }

    function it_returns_distance_of_2_when_connection_spans_two_people()
    {
        $mick = new Contributor('mick');

        $mike = new Contributor('mike');
        $mike->setCoContributors([]);

        $jack = new Contributor('jack');
        $jack->setCoContributors([$mick]);

        $this->beConstructedWith('jon');
        $this->setCoContributors([$mike, $jack]);

        $this->distance($mick)->shouldBe(2);
    }

    function it_returns_distance_when_connection_spans_more_than_two_people()
    {
        $anna  = new Contributor('anna');

        $mick  = new Contributor('mick');
        $mick->setCoContributors([]);

        $mary  = new Contributor('mary');
        $mary->setCoContributors([$anna]);

        $james = new Contributor('james');
        $james->setCoContributors([$mary]);

        $mike  = new Contributor('mike');
        $mike->setCoContributors([]);

        $jack  = new Contributor('jack');
        $jack->setCoContributors([$mick, $james]);

        $this->beConstructedWith('jon');
        $this->setCoContributors([$mike, $jack]);

        $this->distance($mary)->shouldBe(3);
    }

    function it_returns_shortest_distance()
    {
        $anna  = new Contributor('anna');

        $mick  = new Contributor('mick');
        $mick->setCoContributors([]);

        $mary  = new Contributor('mary');
        $mary->setCoContributors([$anna]);

        $james = new Contributor('james');
        $james->setCoContributors([$mary]);

        $mike  = new Contributor('mike');
        $mike->setCoContributors([]);

        $jack  = new Contributor('jack');
        $jack->setCoContributors([$mick, $james, $anna ]);

        $this->beConstructedWith('jon');
        $this->setCoContributors([$mike, $jack]);

        $this->distance($anna)->shouldBe(2);
    }
}
