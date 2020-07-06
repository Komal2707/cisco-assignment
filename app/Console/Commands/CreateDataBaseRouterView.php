<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDataBaseRouterView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'router:create-view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        \DB::statement("
                        CREATE VIEW
                            router_view AS
                                SELECT
                                    id,
                                    sap_id,
                                    hostname,
                                    type,
                                    loopback,
                                    mac_address,
                                    created_at,
                                    updated_at,
                                    deleted_at
                                FROM
                                    routers
                            
                ");
    }
}
