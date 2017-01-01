<?php

namespace Ds\Bundle\NotificationBundle\Manager;

use Ds\Bundle\NotificationBundle\Entity\Notification;
use Ds\Bundle\CommunicationBundle\Entity\Communication;
use Ds\Bundle\CommunicationBundle\Entity\Content;

/**
 * Class CommunicationManager
 */
class CommunicationManager
{
    /**
     * Create entity
     *
     * @param \Ds\Bundle\NotificationBundle\Entity\Notification $notification
     * @return \Ds\Bundle\CommunicationBundle\Entity\Communication
     */
    public function createEntity(Notification $notification)
    {
        $communication = new Communication;
        $communication->setTitle($notification->getTitle());
        $communication->setDescription($notification->getDescription());

        foreach ($notification->getChannels() as $channel) {
            $content = new Content;
            $content
                ->setCommunication($communication)
                ->setChannel($channel)
                ->setProfile(null)
                ->setTemplate(null)
                ->setTitle('')
                ->setPresentation('');
            $communication->addContent($content);
        }

        return $communication;
    }
}
