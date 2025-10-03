<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Account;
use App\Models\Company;

class AddNewAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-new-account {--company-id=} {--name=}';

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
        $company_id = $this->option('company-id');
        echo("Searching company with id=" . $company_id . "\n");
        try {
            $company = Company::findOrFail($company_id);
            echo("Adding new account with company_id=" . $company_id . "and name=" . $name . "\n");
            $account = $company->accounts()->create([
                'name' => $name,
            ]);
            echo("Done." . "\n");
        } catch (ModelNotFoundException $e) {
            echo("Company with id={$request->input('company_id')} not found.\n");
        } catch (\Exception $e) {
            echo("Error: " . $e->getMessage() . "\n");
        }
    }
}
