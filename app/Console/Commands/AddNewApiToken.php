<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
            $account = Account::findOrFail($account_id);

            $service = ApiService::findOrFail($api_service_id);

            $tokenType = TokenType::findOrFail($token_type_id);

            if (! $service->tokenTypes()->where('token_type_id', $tokenType->id)->exists()) {
                echo("Token type " . $tokenType->name . " is not allowed for " . $service->name . "\n");
                exit;
            }

            // Создаём токен
            $token = Token::create([
                'account_id'     => $account_id,
                'api_service_id' => $api_service_id,
                'token_type_id'  => $token_type_id,
                'value'          => $value,
            ]);

        } catch (ModelNotFoundException $e) {
            echo("Account, service or token type not found.\n");

        } catch (Exception $e) {
            echo("Ошибка: " . $e->getMessage() . "\n");
        }
    }
}
