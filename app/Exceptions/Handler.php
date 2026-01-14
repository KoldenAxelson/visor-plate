<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        // Don't alert on 404s - they're usually bots or typos
        NotFoundHttpException::class => "info",
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * These exceptions won't be sent to Flare/Sentry and won't spam your inbox.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        // CSRF token mismatches from bots/expired sessions
        TokenMismatchException::class,
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        "current_password",
        "password",
        "password_confirmation",
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Add custom context for better debugging
            $this->addErrorContext($e);
        });
    }

    /**
     * Add custom context to errors for better debugging in Flare/Sentry
     */
    protected function addErrorContext(Throwable $e): void
    {
        // Add request context if available
        if (request()) {
            context([
                "url" => request()->fullUrl(),
                "method" => request()->method(),
                "ip" => request()->ip(),
                "user_agent" => request()->userAgent(),
            ]);
        }

        // Add user context if authenticated
        if (auth()->check()) {
            context([
                "user_id" => auth()->id(),
                "user_email" => auth()->user()->email ?? null,
            ]);
        }

        // Add session context for checkout/webhook errors
        if (request()->has("session_id")) {
            context([
                "stripe_session_id" => request()->get("session_id"),
            ]);
        }

        // Add order context if available
        if (
            request()->routeIs("checkout.*") ||
            request()->routeIs("stripe.*")
        ) {
            context([
                "is_payment_flow" => true,
                "route" => request()->route()?->getName(),
            ]);
        }
    }
}
