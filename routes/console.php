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
 *
 * Sends ONE consolidated success email after backing up to all destinations
 * Failure notifications come from both Spatie and Laravel scheduler
 */
Schedule::command("backup:run --only-db")
    ->dailyAt("03:00")
    ->emailOutputTo(
        config("backup.notifications.mail.to")
    )
    ->emailOutputOnFailure(
        config("backup.notifications.mail.to")
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
        config("backup.notifications.mail.to")
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
        config("backup.notifications.mail.to")
    )
    ->appendOutputTo(storage_path("logs/backup-monitor.log"));

/**
 * Schedule automated label printing via Rollo thermal printer
 *
 * Runs weekdays at 8:00 AM
 * Only runs if Rollo printer is online
 * Batch prints all pending orders
 * Updates order status and queues tracking emails
 *
 * Philosophy: Terminal-first operations
 * Manual override available via: php artisan orders:print-pending
 */
Schedule::command("orders:print-pending")
    ->weekdays()
    ->at("08:00")
    ->emailOutputOnFailure(
        config("backup.notifications.mail.to")
    )
    ->appendOutputTo(storage_path("logs/rollo.log"));
