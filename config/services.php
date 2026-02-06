<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    "postmark" => [
        "key" => env("POSTMARK_API_KEY"),
    ],

    "resend" => [
        "key" => env("RESEND_API_KEY"),
    ],

    "ses" => [
        "key" => env("AWS_ACCESS_KEY_ID"),
        "secret" => env("AWS_SECRET_ACCESS_KEY"),
        "region" => env("AWS_DEFAULT_REGION", "us-east-1"),
    ],

    "slack" => [
        "notifications" => [
            "bot_user_oauth_token" => env("SLACK_BOT_USER_OAUTH_TOKEN"),
            "channel" => env("SLACK_BOT_USER_DEFAULT_CHANNEL"),
        ],
    ],

    "stripe" => [
        "key" => env("STRIPE_KEY"),
        "secret" => env("STRIPE_SECRET"),
        "webhook_secret" => env("STRIPE_WEBHOOK_SECRET"),
    ],

    /*
    |--------------------------------------------------------------------------
    | ShipStation API Configuration
    |--------------------------------------------------------------------------
    |
    | ShipStation is used to integrate with the Rollo thermal printer for
    | automated label generation and printing. Get your API credentials from:
    | https://ship1.shipstation.com/settings/api
    |
    | Documentation: https://www.shipstation.com/docs/api/
    |
    */

    "shipstation" => [
        "api_key" => env("SHIPSTATION_API_KEY"),
        "api_secret" => env("SHIPSTATION_API_SECRET"),
        "store_id" => env("SHIPSTATION_STORE_ID"),

	'printer_name' => env('SHIPSTATION_PRINTER_NAME', 'Rollo_X1040'),

        // Return address configuration
        "return_address" => [
            "name" => env("RETURN_ADDRESS_NAME", "VisorPlate"),
            "company" => env("RETURN_ADDRESS_COMPANY", ""),
            "line1" => env("RETURN_ADDRESS_LINE1"),
            "line2" => env("RETURN_ADDRESS_LINE2", ""),
            "city" => env("RETURN_ADDRESS_CITY"),
            "state" => env("RETURN_ADDRESS_STATE"),
            "postal_code" => env("RETURN_ADDRESS_ZIP"),
            "country" => env("RETURN_ADDRESS_COUNTRY", "US"),
            "phone" => env("RETURN_ADDRESS_PHONE", ""),
        ],

        // Package defaults for VisorPlate product
        "package_length" => env("PACKAGE_LENGTH", 14), // inches
        "package_width" => env("PACKAGE_WIDTH", 8), // inches
        "package_height" => env("PACKAGE_HEIGHT", 1), // inches
        "package_weight" => env("PACKAGE_WEIGHT", 12), // ounces
    ],

    "mailgun" => [
        "domain" => env("MAILGUN_DOMAIN"),
        "secret" => env("MAILGUN_SECRET"),
        "endpoint" => env("MAILGUN_ENDPOINT", "api.mailgun.net"),
        "scheme" => "https",
    ],

    // While not 3rd Party, I guess it goes here?
    "visorplate" => [
        "order_notification_email" => env(
            "ORDER_NOTIFICATION_EMAIL",
            "contact@visorplate-us.com",
        ),
    ],

    'print_agent' => [
        'secret' => env('PRINT_AGENT_SECRET'),
    ],
];
