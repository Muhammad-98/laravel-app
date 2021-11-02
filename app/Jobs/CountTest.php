<?php

namespace App\Jobs;

use App\Models\Area;
use App\Models\City;
use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CountTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->onQueue('jobs');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         //$datetime=time();
         $StateIds=State::pluck('id')->toArray();
         foreach($StateIds as $StateId)
         {
             $StateName=State::where('id',$StateId)->value('name');
             $StateCities=City::where('state_id',$StateId)->pluck('id')->toArray();
             $CityAreas=Area::where('city_id',$StateId)->pluck('id')->toArray();
            Log::info($StateName.' has '.count($StateCities).' cities and '.count($CityAreas).' areas.');
         }
         
    }
}
