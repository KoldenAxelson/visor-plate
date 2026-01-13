<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command("inspire", function () {
    $this->comment(Inspiring::quote());
})
    ->purpose("Display an inspiring quote")
    ->hourly();

/**
 * Schedule automated cleanup of old return photos
 *
 * Runs daily at 3:00 AM
 * Deletes return photos older than 90 days
 * Logs output to storage/logs/cleanup.log
 */
Schedule::command("returns:cleanup")
    ->dailyAt("03:00")
    ->appendOutputTo(storage_path("logs/cleanup.log"));
