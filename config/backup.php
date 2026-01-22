<?php

return [
    "backup" => [
        /*
         * The name of this application. You can use this name to monitor
         * the backups.
         */
        "name" => env("APP_NAME", "visorplate"),

        "source" => [
            "files" => [
                /*
                 * The list of directories and files that will be included in the backup.
                 */
                "include" => [
                    // Don't include return photos (temporary storage, 90-day retention)
                    //storage_path("app/public/returns"),
                ],

                /*
                 * These directories and files will be excluded from the backup.
                 */
                "exclude" => [
                    // Exclude cache and temporary files
                    storage_path("app/public/cache"),
                    storage_path("framework/cache"),
                    storage_path("framework/sessions"),
                    storage_path("framework/testing"),
                    storage_path("framework/views"),
                    storage_path("logs"),
                    storage_path("app/public/.gitignore"),
                ],

                /*
                 * Determines if symlinks should be followed.
                 */
                "follow_links" => false,

                /*
                 * Determines if it should avoid unreadable folders.
                 */
                "ignore_unreadable_directories" => false,

                /*
                 * The relative path to the folder you want to store the backups in.
                 */
                "relative_path" => null,
            ],

            /*
             * The names of the connections to the databases that should be backed up
             * MySQL, PostgreSQL, SQLite and Mongo databases are supported.
             */
            "databases" => [
                // Use the default database connection from .env (mysql/pgsql/sqlite)
                env("DB_CONNECTION", "mysql"),
            ],
        ],

        /*
         * The database dump can be compressed to decrease disk space usage.
         * Out of the box Laravel-backup supplies
         * Spatie\DbDumper\Compressors\GzipCompressor::class.
         */
        "database_dump_compressor" => null,

        /*
         * The file extension used for the database dump files.
         * If not specified, the file extension will be .sql for uncompressed
         * dumps and .sql.gz for compressed dumps.
         */
        "database_dump_file_extension" => "",

        "destination" => [
            /*
             * The filename prefix used for the backup zip file.
             */
            "filename_prefix" => "visorplate-backup-",

            /*
             * The disk names on which the backups will be stored.
             */
            "disks" => [
                "local",
                // Uncomment when configured in production
                "s3",
                // 'b2', // Backblaze B2 alternative (maybe)
            ],
        ],

        /*
         * The directory where the temporary files will be stored.
         */
        "temporary_directory" => storage_path("app/backup-temp"),

        /*
         * The password to be used for archive encryption.
         * Set to `null` to disable encryption.
         */
        "password" => env("BACKUP_ARCHIVE_PASSWORD"),

        /*
         * The encryption algorithm to be used for archive encryption.
         * You can set it to `null` or `false` to disable encryption.
         */
        "encryption" => "default",
    ],

    /*
     * You can get notified when specific events occur. Out of the box you can use 'mail' and 'slack'.
     * For Slack you need to install laravel/slack-notification-channel.
     */
    "notifications" => [
        "notifications" => [
            \Spatie\Backup\Notifications\Notifications\BackupHasFailedNotification::class => [
                "mail",
            ],
            \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFoundNotification::class => [
                "mail",
            ],
            \Spatie\Backup\Notifications\Notifications\CleanupHasFailedNotification::class => [
                "mail",
            ],
            \Spatie\Backup\Notifications\Notifications\BackupWasSuccessfulNotification::class => [
                "mail",
            ],
            \Spatie\Backup\Notifications\Notifications\HealthyBackupWasFoundNotification::class => [],
            \Spatie\Backup\Notifications\Notifications\CleanupWasSuccessfulNotification::class => [],
        ],

        /*
         * Here you can specify the notifiable to which the notifications should be sent.
         * The default notifiable will use the variables specified in this config file.
         */
        "notifiable" => \Spatie\Backup\Notifications\Notifiable::class,

        "mail" => [
            "to" => env("BACKUP_NOTIFICATION_EMAIL", "contact@visorplate.com"),

            "from" => [
                "address" => env("MAIL_FROM_ADDRESS", "contact@visorplate.com"),
                "name" => env("MAIL_FROM_NAME", "VisorPlate Backup"),
            ],
        ],

        "slack" => [
            "webhook_url" => env("BACKUP_SLACK_WEBHOOK_URL", ""),

            /*
             * If this is set to null the default channel of the webhook will be used.
             */
            "channel" => null,

            "username" => null,

            "icon" => null,
        ],

        "discord" => [
            "webhook_url" => env("BACKUP_DISCORD_WEBHOOK_URL", ""),

            /*
             * If this is an empty string, the name field on the webhook will be used.
             */
            "username" => "",

            "avatar_url" => "",
        ],
    ],

    /*
     * Here you can specify which backups should be monitored.
     * If a backup does not meet the specified requirements the
     * UnHealthyBackupWasFound event will be fired.
     */
    "monitor_backups" => [
        [
            "name" => env("APP_NAME", "visorplate"),
            "disks" => ["local", "s3"],
            "health_checks" => [
                \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumAgeInDays::class => 1,
                \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes::class => 5000,
            ],
        ],
    ],

    "cleanup" => [
        /*
         * The strategy that will be used to cleanup old backups. The default strategy
         * will keep all backups for a certain amount of days. After that period only
         * a daily backup will be kept. After that period only weekly backups will
         * be kept and so on.
         */
        "strategy" =>
            \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,

        /*
         * The number of days for which backups must be kept.
         */
        "default_strategy" => [
            /*
             * Keep all backups for this many days.
             */
            "keep_all_backups_for_days" => 7,

            /*
             * Keep daily backups for this many days.
             */
            "keep_daily_backups_for_days" => 30,

            /*
             * Keep weekly backups for this many weeks.
             */
            "keep_weekly_backups_for_weeks" => 8,

            /*
             * Keep monthly backups for this many months.
             */
            "keep_monthly_backups_for_months" => 4,

            /*
             * Keep yearly backups for this many years.
             */
            "keep_yearly_backups_for_years" => 2,

            /*
             * After cleaning up, delete directories that are now empty.
             */
            "delete_oldest_backups_when_using_more_megabytes_than" => 5000,
        ],
    ],

    /*
     * You can get notified when specific events occur.
     */
    "send_notification_when_backup_starts" => false,

    /*
     * You can get notified when specific events occur.
     */
    "send_notification_when_backup_succeeds" => true,

    /*
     * You can get notified when specific events occur.
     */
    "send_notification_when_backup_fails" => true,

    /*
     * You can get notified when specific events occur.
     */
    "send_notification_when_cleanup_has_run" => false,
];
