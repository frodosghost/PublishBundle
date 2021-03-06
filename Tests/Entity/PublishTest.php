<?php

namespace Manhattan\PublishBundle\Tests\Entity;

use Manhattan\PublishBundle\Entity\Publish;

/**
 * PublishTest
 *
 * @author James Rickard <james@frodosghost.com>
 */
class PublishTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test onCreate Behaviour
     */
    public function testGetPublishOptions()
    {
        $publish = $this->getMockForAbstractClass('Manhattan\PublishBundle\Entity\Publish');

        $publish_options = array(
            1 => 'Draft',
            2 => 'Publish',
            4 => 'Archive',
            8 => 'Locked'
        );

        $this->assertEquals($publish_options, $publish->getPublishOptions(), '->getPublishOptions() returns the correct array.');
    }

    /**
     * Tests that the retruned PublishDate is formatted correctly.
     */
    public function testGetDate()
    {
        $publish = $this->getMockForAbstractClass('Manhattan\PublishBundle\Entity\Publish');

        $date = new \DateTime();

        $publish->setPublishDate($date);

        $this->assertEquals($date->format('Y-m-d'), $publish->getDate(), '->getDate() returns the correctly formatted Publish Date.');
    }

    public function testSetPublishState()
    {
        $publish = $this->getMockForAbstractClass('Manhattan\PublishBundle\Entity\Publish');
        $this->assertEquals($publish::DRAFT, $publish->getPublishState(), '->getPublishState() returns draft when object created.');

        $publish->setPublishState($publish::ARCHIVE);
        $this->assertEquals($publish::ARCHIVE, $publish->getPublishState(), '->getPublishState() returns Archive when set.');
        $this->assertNull($publish->getPublishDate(), '->getPublishDate() returns NULL when publish state is ARCHIVE');

        $publish->setPublishState($publish::PUBLISH);
        $this->assertEquals($publish::PUBLISH, $publish->getPublishState(), '->getPublishState() returns Archive when set.');
        $this->assertInstanceOf('\DateTime', $publish->getPublishDate(), '->getPublishDate() returns as DateTime when publish state is set.');
    }

}
