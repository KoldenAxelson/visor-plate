<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SocialInterestController extends Controller
{
    /**
     * Track social interest and show thank you page
     * Only logs the FIRST platform click per unique visitor
     */
    public function track(Request $request)
    {
        $platform = $request->query("platform");

        // Validate platform
        if (!in_array($platform, ["facebook", "x", "instagram"])) {
            abort(404);
        }

        // Check if visitor already logged via cookie
        $alreadyLogged = $request->cookie("social_interest_logged");

        if (!$alreadyLogged) {
            // Hash IP for privacy (never store actual IP)
            $ipHash = hash("sha256", $request->ip());

            // Check if this IP hash already exists in database
            $existingLog = DB::table("social_interest_logs")
                ->where("ip_hash", $ipHash)
                ->exists();

            if (!$existingLog) {
                // First time visitor - log their interest
                DB::table("social_interest_logs")->insert([
                    "platform" => $platform,
                    "ip_hash" => $ipHash,
                    "user_agent" => $request->userAgent(),
                    "referrer" => $request->header("referer"),
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);

                Log::info("Social interest logged", [
                    "platform" => $platform,
                    "ip_hash_preview" => substr($ipHash, 0, 8) . "...", // Only log partial for privacy
                ]);
            }
        }

        // Show thank you page and set cookie (expires in 1 year)
        return response()
            ->view("social-interest", ["platform" => $platform])
            ->cookie("social_interest_logged", "true", 525600); // 1 year in minutes
    }
}
