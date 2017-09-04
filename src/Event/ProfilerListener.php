<?php declare(strict_types=1);
/**
 * This file is part of TwigView.
 *
 ** (c) 2014 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\TwigView\Event;

use Cake\Event\EventListenerInterface;
use Cake\Event\EventManager;
use WyriHaximus\TwigView\Lib\Twig\Extension;

/**
 * Class ExtensionsListener.
 * @package WyriHaximus\TwigView\Event
 */
class ProfilerListener implements EventListenerInterface
{
    /**
     * Return implemented events.
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            ConstructEvent::EVENT => 'construct',
        ];
    }

    /**
     * Event handler.
     *
     * @param ConstructEvent $event Event.
     *
     */
    public function construct(ConstructEvent $event)
    {
        $profile = new \Twig_Profiler_Profile();
        $event->
            getTwig()->
            addExtension(new Extension\Profiler($profile));

        EventManager::instance()->dispatch(ProfileEvent::create($profile));
    }
}
