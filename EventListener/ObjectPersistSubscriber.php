<?php

namespace Manhattan\PublishBundle\EventListener;

/*
 * This file is part of the PublishBundle package.
 *
 * (c) Frodosghost <http://frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Manhattan\PublishBundle\Entity\Publish;
use Manhattan\Bundle\ConsoleBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ObjectPersistSubscriber implements EventSubscriber
{
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // If it is a photo then we run the upload() function
        if ($entity instanceof Publish) {
            if ($this->getSecurityToken()->getUser() instanceof User) {
                $entity->setCreatedBy($this->getSecurityToken()->getUser());
            }
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // If it is a photo then we run the preUpdate() function
        if ($entity instanceof Publish) {
            if ($this->getSecurityToken()->getUser() instanceof User) {
                $entity->setUpdatedBy($this->getSecurityToken()->getUser());
            }
        }
    }

    /**
     * Lazy Loading of security context.
     * Returns TokenInterface
     *
     * @link(Circular Reference when injecting Security Context, http://stackoverflow.com/a/8713339/174148)
     * @return TokenInterface
     */
    private function getSecurityToken()
    {
        if ($this->container->get('security.context')->getToken() instanceof TokenInterface) {
            return $this->container->get('security.context')->getToken();
        }

        return null;
    }

}
