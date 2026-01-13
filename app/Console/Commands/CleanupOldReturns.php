<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupOldReturns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "returns:cleanup {--dry-run : Show what would be deleted without actually deleting}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete return photos older than 90 days";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option("dry-run");
        $cutoffDate = Carbon::now()->subDays(90);

        $this->info(
            "Cleaning up return photos older than 90 days (before {$cutoffDate->format(
                "Y-m-d",
            )})...",
        );
        if ($isDryRun) {
            $this->warn("DRY RUN MODE - No files will be deleted");
        }

        $deletedCount = 0;
        $deletedSize = 0;

        // Get all directories in returns/ folder (format: YYYY-MM)
        $directories = Storage::disk("public")->directories("returns");

        foreach ($directories as $directory) {
            // Extract date from folder name (e.g., "returns/2024-01")
            $folderName = basename($directory);

            // Parse folder date (YYYY-MM format)
            try {
                $folderDate = Carbon::createFromFormat(
                    "Y-m",
                    $folderName,
                )->endOfMonth();

                // If folder is older than 90 days, delete entire folder
                if ($folderDate->lt($cutoffDate)) {
                    $files = Storage::disk("public")->allFiles($directory);
                    $folderSize = 0;

                    foreach ($files as $file) {
                        $folderSize += Storage::disk("public")->size($file);
                    }

                    if ($isDryRun) {
                        $this->line(
                            "Would delete folder: {$directory} (" .
                                count($files) .
                                " files, " .
                                $this->formatBytes($folderSize) .
                                ")",
                        );
                    } else {
                        Storage::disk("public")->deleteDirectory($directory);
                        $this->info(
                            "Deleted folder: {$directory} (" .
                                count($files) .
                                " files, " .
                                $this->formatBytes($folderSize) .
                                ")",
                        );
                    }

                    $deletedCount += count($files);
                    $deletedSize += $folderSize;
                }
            } catch (\Exception $e) {
                // Skip folders that don't match YYYY-MM format
                $this->warn("Skipping invalid folder name: {$folderName}");
                continue;
            }
        }

        if ($deletedCount > 0) {
            $this->info(
                "✓ Cleanup complete: {$deletedCount} files, " .
                    $this->formatBytes($deletedSize) .
                    " freed",
            );
        } else {
            $this->info("✓ No files to clean up");
        }

        return Command::SUCCESS;
    }

    /**
     * Format bytes to human-readable size
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ["B", "KB", "MB", "GB"];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . " " . $units[$i];
    }
}
