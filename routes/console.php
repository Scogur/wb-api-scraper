<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

$schedule_ids = config('api.accounts_schedule', []);
foreach ($schedule_ids as $id) {
    Schedule::command('app:fetch-api-data', ['--account'=>$id, '--fresh'])
        ->twiceDaily(8, 20)
        ->sendOutputTo(storage_path('logs/fetch-api-data.log'));
}
