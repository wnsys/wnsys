<?php
namespace App\Listeners;
use Faker\Provider\DateTime;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View as ViewContract;
class ViewListener{
    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(ViewContract $event)
    {
       
    }
}