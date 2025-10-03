<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Company;

class AddNewCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-new-company {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name');
        try {
            echo("Adding new account with name=" . $name . "\n");
            Company::Create([
                'name' => $name,
            ]);
            echo("Done." . "\n");
        }
        catch (Exception $e) {
            echo("Error: " . $e->getMessage() . "\n");
        }
    }
}
