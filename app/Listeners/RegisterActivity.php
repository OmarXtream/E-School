<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AssignmentViewer;

use Illuminate\Support\Facades\Auth;

class RegisterActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AssignmentViewer $event)
    {
        $this->CreateAct($event->assignment);
    }

    function CreateAct($assignment){
         $assignment->activities()->firstOrCreate(['assignment_id' => $assignment->id,'user_id' => Auth::id()]);

    }
}
