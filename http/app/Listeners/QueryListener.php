<?php
namespace App\Listeners;
use Faker\Provider\DateTime;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryListener{
    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        if (env('APP_ENV', 'production') == 'local') {
            foreach ($event->bindings as $index => $param) {
                if ($param instanceof DateTime) {
                    $event->bindings[$index] = $param->format('Y-m-d H:i:s');
                }
            }
            $sql = str_replace("?", "'%s'", $event->sql);
            array_unshift($event->bindings, $sql);
            Log::info(call_user_func_array('sprintf', $event->bindings));
        }
    }
}