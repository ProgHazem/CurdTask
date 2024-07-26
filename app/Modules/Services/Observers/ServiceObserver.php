<?php

namespace App\Modules\Services\Observers;

use App\Modules\Services\Models\Service;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     *
     * @param Service $service
     * @return void
     */
    public function created(Service $service)
    {
        //
    }

    /**
     * Handle the Service "updated" event.
     *
     * @param Service $service
     * @return void
     */
    public function updated(Service $service)
    {
        //
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param Service $service
     * @return void
     */
    public function deleted(Service $service)
    {
        //
    }

    /**
     * Handle the Service "restored" event.
     *
     * @param Service $service
     * @return void
     */
    public function restored(Service $service)
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     *
     * @param Service $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        //
    }
}
