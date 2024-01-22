<?php

namespace Drupal\event_module\Event;

use Drupal\user\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;
use Drupal\node\NodeInterface;


/**
 * Event that is fired when a user logs in.
 */
class sendEmail extends Event
{

    const EVENT_NAME = 'send_task_via_email';

    protected $node;

    /**
     * Constructs a new NodeCreationEvent.
     *
     * @param \Drupal\node\NodeInterface $node
     *   The node that was created.
     */
    public function __construct(NodeInterface $node)
    {
        $this->node = $node;

    }

    /**
     * 
     *
     * @return \Drupal\node\NodeInterface
     *   The created node.
     */
    public function getNode()
    {
        return $this->node;
    }
}