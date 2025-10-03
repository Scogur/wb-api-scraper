<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Token;
use App\Models\ApiService;
use App\Models\Account;
use App\Models\TokenType;

class AddNewApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-new-api-token {--account-id=} {--api-service-id=} {--token-type-id=} {--value=}';

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
        $account_id = $this->option('account-id');
        $api_service_id = $this->option('api-service-id');
        $token_type_id = $this->option('token-type-id');
        $value = $this->option('value');
        
        try {
            echo("Searching account with id=" . $account_id . "\n");
            $account = Account::findOrFail($account_id);
            echo("Searching api service with id=" . $api_service_id . "\n");
            $service = ApiService::findOrFail($api_service_id);
            echo("Searching token type with id=" . $token_type_id . "\n");
            $tokenType = TokenType::findOrFail($token_type_id);
            echo("Adding data to table.\n");
            $token = Token::create([
                'account_id'     => $account_id,
                'api_service_id' => $api_service_id,
                'token_type_id'  => $token_type_id,
                'value'          => $value,
            ]);
            echo("Done.\n");
        } catch (ModelNotFoundException $e) {
            echo("Account, service or token type not found.\n");

        } catch (Exception $e) {
            echo("Error: " . $e->getMessage() . "\n");
        }
    }
}
