<?php

namespace App\Observers;

use App\Models\Clients;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AssignUserToOperation;

class ClientObserver
{

    public $afterCommit = true;
    /**
     * Handle the clients "created" event.
     *
     * @param  \App\Clients  $clients
     * @return void
     */
    public function created(Clients $clients)
    {

        AssignUserToOperation::assignUserToOperation($clients);

    }

    /**
     * Handle the clients "updated" event.
     *
     * @param  \App\Clients  $clients
     * @return void
     */
    public function updated(Clients $clients)
    {
        //
    }

    /**
     * Handle the clients "deleted" event.
     *
     * @param  \App\Clients  $clients
     * @return void
     */
    public function deleted(Clients $clients)
    {
        //
    }

    /**
     * Handle the clients "restored" event.
     *
     * @param  \App\Clients  $clients
     * @return void
     */
    public function restored(Clients $clients)
    {
        //
    }

    /**
     * Handle the clients "force deleted" event.
     *
     * @param  \App\Clients  $clients
     * @return void
     */
    public function forceDeleted(Clients $clients)
    {
        //
    }


}
