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

/**
 * Schedule automated database backups
 *
 * Full backup (database + files) runs daily at 3:00 AM
 * Includes orders, newsletter_signups, and return photos
 * Stored locally and remotely (S3/B2)
 */
Schedule::command("backup:run --only-db")
    ->dailyAt("03:00")
    ->emailOutputOnFailure(
        env("BACKUP_NOTIFICATION_EMAIL", "contact@visorplate.com"),
    )
    ->appendOutputTo(storage_path("logs/backup.log"));

/**
 * Schedule backup cleanup to maintain retention policy
 *
 * Runs daily at 4:00 AM (after backup completes)
 * Keeps 30 days of daily backups per config
 * Removes old backups to save storage space
 */
Schedule::command("backup:clean")
    ->dailyAt("04:00")
    ->emailOutputOnFailure(
        env("BACKUP_NOTIFICATION_EMAIL", "contact@visorplate.com"),
    )
    ->appendOutputTo(storage_path("logs/backup-cleanup.log"));

/**
 * Schedule backup health monitoring
 *
 * Runs daily at 5:00 AM (after backup and cleanup)
 * Checks that backups are fresh and not too large
 * Sends notifications if backups are unhealthy
 */
Schedule::command("backup:monitor")
    ->dailyAt("05:00")
    ->emailOutputOnFailure(
        env("BACKUP_NOTIFICATION_EMAIL", "contact@visorplate.com"),
    )
    ->appendOutputTo(storage_path("logs/backup-monitor.log"));
