#!/bin/bash
# VisorPlate Comprehensive Diagnostic & Test Script
# Run on server: bash diagnose-and-test.sh

echo "========================================="
echo "VISORPLATE DIAGNOSTIC & TEST SCRIPT"
echo "Generated: $(date)"
echo "========================================="
echo ""

cd /home/forge/visorplate-us.com/current || exit 1

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "1️⃣  CHECKING EMAIL CONFIGURATION"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Email notification address:${NC}"
grep ORDER_NOTIFICATION_EMAIL .env || echo "❌ ORDER_NOTIFICATION_EMAIL not set in .env!"

echo -e "\n${YELLOW}Mailgun configuration:${NC}"
grep "MAIL_FROM_ADDRESS" .env
grep "MAIL_FROM_NAME" .env
echo "MAILGUN_DOMAIN: $(grep MAILGUN_DOMAIN .env | cut -d'=' -f2)"
echo "MAILGUN_SECRET: $(grep MAILGUN_SECRET .env | cut -d'=' -f2 | head -c 20)..."

echo -e "\n${YELLOW}Queue configuration:${NC}"
grep "QUEUE_CONNECTION" .env

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "2️⃣  CHECKING FOR DUPLICATE CLASS ISSUE"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Searching for SendNoOrdersEmail class locations:${NC}"
find app/ -name "*SendNoOrdersEmail*" -type f

echo -e "\n${YELLOW}Checking if class is in Jobs folder (correct):${NC}"
if [ -f "app/Jobs/SendNoOrdersEmail.php" ]; then
    echo -e "${GREEN}✅ Found in app/Jobs/SendNoOrdersEmail.php${NC}"
    grep "namespace" app/Jobs/SendNoOrdersEmail.php
else
    echo -e "${RED}❌ Not found in app/Jobs/${NC}"
fi

echo -e "\n${YELLOW}Checking if class incorrectly exists in Commands folder:${NC}"
if [ -f "app/Console/Commands/Orders/SendNoOrdersEmail.php" ]; then
    echo -e "${RED}❌ DUPLICATE FOUND in app/Console/Commands/Orders/${NC}"
    echo "This will cause class redeclaration errors!"
else
    echo -e "${GREEN}✅ Not found in Commands folder (good)${NC}"
fi

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "3️⃣  TESTING EMAIL JOB MANUALLY"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Dispatching test email job...${NC}"
php artisan tinker --execute="
    \$orders = App\Models\Order::where('id', 1)->get();
    if (\$orders->isEmpty()) {
        echo '❌ Order #1 not found\n';
        exit(1);
    }
    
    echo '✅ Order found, dispatching email job...\n';
    try {
        App\Jobs\SendDailyOrderSummaryEmail::dispatch(\$orders);
        echo '✅ Job dispatched successfully\n';
        echo 'Job queued. Checking queue...\n';
    } catch (\Exception \$e) {
        echo '❌ Error dispatching job: ' . \$e->getMessage() . '\n';
    }
"

echo -e "\n${YELLOW}Checking queue status:${NC}"
php artisan tinker --execute="echo 'Jobs in queue: ' . DB::table('jobs')->count() . '\n';"

echo -e "\n${YELLOW}Processing the queue job now...${NC}"
timeout 10 php artisan queue:work --once 2>&1 || echo "Queue processing completed or timed out"

echo -e "\n${YELLOW}Queue status after processing:${NC}"
php artisan tinker --execute="echo 'Jobs remaining: ' . DB::table('jobs')->count() . '\n';"

echo -e "\n${YELLOW}Checking failed jobs:${NC}"
php artisan queue:failed

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "4️⃣  CHECKING RECENT LARAVEL LOGS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Last 20 lines from Laravel log:${NC}"
tail -20 storage/logs/laravel.log

echo -e "\n${YELLOW}Searching for email-related errors:${NC}"
grep -i "sendmail\|mailgun\|mail\|smtp" storage/logs/laravel.log | tail -10 || echo "No email-related logs found"

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "5️⃣  TESTING EMAIL TEMPLATE RENDERING"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Testing daily-order-summary template:${NC}"
php artisan tinker --execute="
    try {
        \$orders = App\Models\Order::limit(1)->get();
        \$html = view('emails.daily-order-summary', [
            'orders' => \$orders,
            'orderCount' => 1,
            'totalRevenue' => 35
        ])->render();
        echo '✅ Template renders successfully (' . strlen(\$html) . ' bytes)\n';
    } catch (\Exception \$e) {
        echo '❌ Template error: ' . \$e->getMessage() . '\n';
    }
"

echo -e "\n${YELLOW}Testing no-orders-today template:${NC}"
php artisan tinker --execute="
    try {
        \$html = view('emails.no-orders-today')->render();
        echo '✅ Template renders successfully (' . strlen(\$html) . ' bytes)\n';
    } catch (\Exception \$e) {
        echo '❌ Template error: ' . \$e->getMessage() . '\n';
    }
"

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "6️⃣  CHECKING MOM'S ORDER STATUS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

php artisan tinker --execute="
    \$order = App\Models\Order::find(1);
    if (!\$order) {
        echo '❌ Order #1 not found\n';
        exit(1);
    }
    
    echo '✅ Order #1 Status:\n';
    echo '   Email: ' . \$order->email . '\n';
    echo '   Status: ' . \$order->status . '\n';
    echo '   Shipped: ' . (\$order->shipped_at ? \$order->shipped_at : 'No') . '\n';
    echo '   Tracking: ' . (\$order->tracking_number ?: 'None') . '\n';
    echo '   Created: ' . \$order->created_at . '\n';
"

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "7️⃣  ROLLO PRINTER STATUS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Testing printer connectivity:${NC}"
php artisan tinker --execute="
    \$printer = app(App\Services\RolloPrinter::class);
    if (\$printer->isOnline()) {
        echo '✅ Rollo printer is ONLINE\n';
    } else {
        echo '❌ Rollo printer is OFFLINE\n';
    }
"

echo -e "\n${YELLOW}Checking pending orders:${NC}"
php artisan orders:pending

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "8️⃣  OPTIONAL: RESET & TEST AUTO-PRINT"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Do you want to reset Mom's order and test auto-print?${NC}"
read -p "This will reset order #1 to pending and trigger print (y/n): " -n 1 -r
echo ""

if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo -e "\n${YELLOW}Resetting order #1 to pending...${NC}"
    php artisan tinker --execute="
        \$order = App\Models\Order::find(1);
        \$order->update([
            'status' => 'completed',
            'shipped_at' => null,
            'tracking_number' => null
        ]);
        echo '✅ Order #1 reset to pending\n';
        echo '   Status: ' . \$order->fresh()->status . '\n';
    "
    
    echo -e "\n${YELLOW}Running print command...${NC}"
    echo "This should:"
    echo "  1. Dispatch daily summary email"
    echo "  2. Create label in ShipStation"
    echo "  3. Auto-print to Rollo (if Connect is configured)"
    echo ""
    
    php artisan orders:print-pending
    
    echo -e "\n${YELLOW}Did the Rollo print?${NC}"
    read -p "Did you see a label print? (y/n): " -n 1 -r
    echo ""
    
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        echo -e "${GREEN}✅ Auto-print is working!${NC}"
    else
        echo -e "${RED}❌ Auto-print failed. Check ShipStation Connect settings.${NC}"
        echo "   - Verify ShipStation Connect is running"
        echo "   - Check auto-print is enabled in Connect"
        echo "   - Verify Rollo is selected as default printer"
    fi
    
    echo -e "\n${YELLOW}Checking if email was queued...${NC}"
    php artisan tinker --execute="echo 'Jobs in queue: ' . DB::table('jobs')->count() . '\n';"
    
    echo -e "\n${YELLOW}Processing email queue...${NC}"
    timeout 10 php artisan queue:work --once 2>&1
    
    echo -e "\n${GREEN}✅ Now check your email: $(grep ORDER_NOTIFICATION_EMAIL .env | cut -d'=' -f2)${NC}"
    
else
    echo "Skipped reset and test."
fi

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "9️⃣  CHECKING SCHEDULED TASKS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}Scheduled tasks in routes/console.php:${NC}"
cat routes/console.php

echo -e "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🏁 DIAGNOSTIC COMPLETE"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo -e "\n${YELLOW}SUMMARY:${NC}"
echo "1. Check Mailgun dashboard for emails to: $(grep ORDER_NOTIFICATION_EMAIL .env | cut -d'=' -f2)"
echo "2. If no emails sent, check Laravel logs above for errors"
echo "3. If auto-print failed, configure ShipStation Connect"
echo "4. Check for duplicate class errors in section 2"
echo ""
echo "Next steps based on findings above..."
