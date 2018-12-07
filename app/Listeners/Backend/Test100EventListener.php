<?php
namespace App\Listeners\Backend;

/**
 * Class Test100EventListener.
 */
/**
 * Class Test100Created.
 */
class Test100EventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Test100 Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Test100  Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Test100 Deleted');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Test100\Test100Created::class,
            'App\Listeners\Backend\Test100EventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Test100\Test100Updated::class,
            'App\Listeners\Backend\Test100EventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Test100\Test100Deleted::class,
            'App\Listeners\Backend\Test100EventListener@onDeleted'
        );
    }
}
