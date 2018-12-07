<?php
namespace App\Listeners\Backend;

/**
 * Class Test99EventListener.
 */
/**
 * Class Test99Created.
 */
class Test99EventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Test99 Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Test99  Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Test99 Deleted');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Test99\Test99Created::class,
            'App\Listeners\Backend\Test99EventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Test99\Test99Updated::class,
            'App\Listeners\Backend\Test99EventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Test99\Test99Deleted::class,
            'App\Listeners\Backend\Test99EventListener@onDeleted'
        );
    }
}
