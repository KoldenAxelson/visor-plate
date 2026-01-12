<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SocialInterestController extends Controller
{
    /**
     * Track social interest and show appropriate UI state
     *
     * Three states:
     * 1. First-time visitor: Auto-log, show thank you
     * 2. Same platform: Show "already voted" confirmation
     * 3. Different platform: Show swap option
     */
    public function track(Request $request)
    {
        $platform = $request->query("platform");

        // Validate platform
        if (!in_array($platform, ["facebook", "x", "instagram"])) {
            abort(404);
        }

        // Hash IP for privacy (never store actual IP)
        $ipHash = hash("sha256", $request->ip());

        // Check for existing vote in database
        $existingVote = DB::table("social_interest_logs")
            ->where("ip_hash", $ipHash)
            ->first();

        // Check cookie
        $cookiePlatform = $request->cookie("social_interest_platform");

        // Determine state and handle accordingly
        $state = $this->determineState(
            $existingVote,
            $cookiePlatform,
            $platform,
        );

        // Handle first-time visitors (auto-log)
        if ($state === "first-time") {
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
                "ip_hash_preview" => substr($ipHash, 0, 8) . "...",
            ]);
        }

        // Prepare data for view
        $viewData = [
            "platform" => $platform,
            "state" => $state,
            "existingPlatform" => $existingVote
                ? $existingVote->platform
                : null,
        ];

        // Show appropriate page and set/update cookie
        return response()
            ->view("social-interest", $viewData)
            ->cookie("social_interest_platform", $platform, 525600); // Store platform for 1 year
    }

    /**
     * Handle vote swapping when user clicks "Switch my vote" button
     */
    public function swap(Request $request)
    {
        $newPlatform = $request->input("platform");

        // Validate platform
        if (!in_array($newPlatform, ["facebook", "x", "instagram"])) {
            return back()->with("error", "Invalid platform");
        }

        // Hash IP
        $ipHash = hash("sha256", $request->ip());

        // Check for existing vote
        $existingVote = DB::table("social_interest_logs")
            ->where("ip_hash", $ipHash)
            ->first();

        if (!$existingVote) {
            // No existing vote found, treat as new vote
            DB::table("social_interest_logs")->insert([
                "platform" => $newPlatform,
                "ip_hash" => $ipHash,
                "user_agent" => $request->userAgent(),
                "referrer" => $request->header("referer"),
                "created_at" => now(),
                "updated_at" => now(),
            ]);

            Log::info("Social interest logged (new via swap)", [
                "platform" => $newPlatform,
                "ip_hash_preview" => substr($ipHash, 0, 8) . "...",
            ]);
        } else {
            // Update existing vote
            DB::table("social_interest_logs")
                ->where("ip_hash", $ipHash)
                ->update([
                    "platform" => $newPlatform,
                    "updated_at" => now(),
                ]);

            Log::info("Social interest swapped", [
                "from" => $existingVote->platform,
                "to" => $newPlatform,
                "ip_hash_preview" => substr($ipHash, 0, 8) . "...",
            ]);
        }

        // Redirect back with success message and update cookie
        return redirect()
            ->route("social.interest", ["platform" => $newPlatform])
            ->with("success", "Your vote has been switched!")
            ->cookie("social_interest_platform", $newPlatform, 525600);
    }

    /**
     * Determine which UI state to show
     */
    private function determineState(
        $existingVote,
        $cookiePlatform,
        $requestedPlatform,
    ) {
        // No existing vote in DB = first-time visitor
        if (!$existingVote) {
            return "first-time";
        }

        // Existing vote matches requested platform = same platform
        if ($existingVote->platform === $requestedPlatform) {
            return "same-platform";
        }

        // Existing vote differs from requested platform = different platform (show swap option)
        return "different-platform";
    }
}
