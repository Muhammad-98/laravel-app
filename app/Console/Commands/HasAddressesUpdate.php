<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Area;
use App\Models\Address;

class HasAddressesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:HasAddressesUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change has addresses column';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $AreaAddresses=Address::select('area_id')->distinct()->get()->pluck('area_id');

        Area::whereIn('id', $AreaAddresses)
        ->update([
            'has_addresses'=>true ]);
     }
}
