<?php

/*
 * This file is part of the PublishBundle package.
 *
 * (c) Frodosghost <http://frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Manhattan\PublishBundle\Entity;

use Manhattan\Bundle\ConsoleBundle\Entity\User;

/**
 * Manhattan\PublishBundle\Entity\Publish
 *
 * This abstract class is for easy addition of the publish state field to be used with models.
 */
abstract class Publish
{
    /**
     * Publish States
     *
     * @link(Bitwise Operators, http://php.net/manual/en/language.operators.bitwise.php)
     */
    const DRAFT = 1;

    const PUBLISH = 2;

    const ARCHIVE = 4;

    const LOCKED = 8;

    /**
     * @var integer
     */
    protected $publishState;

    /**
     * @var \DateTime
     */
    protected $publishDate;

    /**
     * @var Manhattan\Bundle\ConsoleBundle\Entity\User
     */
    protected $createdBy;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var Manhattan\Bundle\ConsoleBundle\Entity\User
     */
    protected $updatedBy;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->publishState = self::DRAFT;
    }


    /**
     * Set setPublishDate
     *
     * @param  DateTime $publishDate
     * @return Publish
     */
    public function setPublishDate(\DateTime $publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Returns format for URL
     */
    public function getDate()
    {
        return $this->getPublishDate()->format('Y-m-d');
    }

    /**
     * Set publishState
     *
     * @param integer $publishState
     * @return Publish
     */
    public function setPublishState($publishState)
    {
        $this->publishState = $publishState;

        if ($publishState === self::PUBLISH) {
            $this->setPublishDate(new \DateTime());
        }

        return $this;
    }

    /**
     * Get publishState
     *
     * @return integer
     */
    public function getPublishState()
    {
        return $this->publishState;
    }

    /**
     * Set createdBy
     *
     * @param  Manhattan\Bundle\ConsoleBundle\Entity\User $createdBy
     * @return Publish
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return Manhattan\Bundle\ConsoleBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Post
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedBy
     *
     * @param  Manhattan\Bundle\ConsoleBundle\Entity\User $updatedBy
     * @return Publish
     */
    public function setUpdatedBy(User $updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return Manhattan\Bundle\ConsoleBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     * @return Post
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Returns array of static values for configuring form select values
     *
     * @return array
     */
    public function getPublishOptions()
    {
        return array(
            self::DRAFT   => 'Draft',
            self::PUBLISH => 'Publish',
            self::ARCHIVE => 'Archive',
            self::LOCKED  => 'Locked'
        );
    }

}
