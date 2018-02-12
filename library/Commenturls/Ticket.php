<?php


namespace Icinga\Module\Commenturls;

use Icinga\Application\Config;
use Icinga\Web\Hook\TicketHook;

class Ticket extends TicketHook
{
    /**
     *
     * @var \Icinga\Application\Hook\Ticket\TicketPattern[]
     */
    protected $ticketPatterns;

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        $ticketPatterns = array();
        $ticketPatterns['URL'] = $this->createTicketPattern(
          'URL',
          '/(http(s)?:\\/\\/.)(www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{2,256}\\.[a-z]{2,6}\\b([-a-zA-Z0-9@:%_\\+.~#?&;\\/\\/=]*)/');
        $this->ticketPatterns = $ticketPatterns;
    }

    /**
     * {@inheritdoc}
     *
     * @return  \Icinga\Application\Hook\Ticket\TicketPattern[]
     */
    public function getPattern()
    {
        return $this->ticketPatterns;
    }

    /**
     * {@inheritdoc}
     */
    public function createLink($match)
    {
        return sprintf('<a href="%s" target="_blank">%s</a>', $match[0], $match[0]);
    }
}
