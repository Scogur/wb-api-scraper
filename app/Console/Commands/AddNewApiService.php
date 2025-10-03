<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddNewApiService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-new-api-service {--name=}';

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
            echo("Adding new Token Type with name=" . $name . "\n");
            TokenType::Create([
                'name' => $name,
            ]);
            echo("Done." . "\n");
        }
        catch (Exception $e) {
            echo("Error: " . $e->getMessage() . "\n");
        }
    }
}
