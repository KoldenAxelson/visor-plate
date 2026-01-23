#!/bin/bash
# Test Real Label Printing (COSTS MONEY!)
# This will charge real USPS postage (~$3.50)

echo "🚨 WARNING: This will create a REAL label and charge real postage!"
echo "Cost: Approximately $3.50 for USPS First Class"
echo ""
read -p "Continue? (yes/no): " confirm

if [ "$confirm" != "yes" ]; then
    echo "Aborted."
    exit 0
fi

cd /home/forge/visorplate-us.com/current

echo ""
echo "1️⃣ Fixing RolloPrinter.php to use real labels..."
sed -i 's/"testLabel" => config("app.env") !== "production",/"testLabel" => false,/' app/Services/RolloPrinter.php

echo "✅ Fixed! Checking the change..."
grep -A 1 -B 1 "testLabel" app/Services/RolloPrinter.php

echo ""
echo "2️⃣ Resetting Order #1 to pending..."
php artisan tinker --execute="
\$order = App\Models\Order::find(1);
if (\$order) {
    \$order->update([
        'status' => 'completed',
        'shipped_at' => null,
        'tracking_number' => null
    ]);
    echo '✅ Order #1 reset to pending\n';
    echo 'Email: ' . \$order->email . '\n';
} else {
    echo '❌ Order not found!\n';
    exit(1);
}
"

echo ""
echo "3️⃣ Running print command..."
echo "📋 This will:"
echo "   - Send you the daily summary email"
echo "   - Create a REAL label in ShipStation (charges postage)"
echo "   - Attempt to auto-print to Rollo"
echo ""
echo "⏰ Watch your Rollo printer for 2-3 minutes after this runs"
echo ""

php artisan orders:print-pending

echo ""
echo "4️⃣ Checking results..."
php artisan tinker --execute="
\$order = App\Models\Order::find(1);
echo 'Order Status: ' . \$order->status . '\n';
echo 'Tracking: ' . (\$order->tracking_number ?: 'None') . '\n';
echo 'Shipped at: ' . (\$order->shipped_at ?: 'Not shipped') . '\n';
"

echo ""
echo "5️⃣ Processing the email queue..."
php artisan queue:work --once

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✅ DONE!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "📧 Check your email: KonradWright@Protonmail.com"
echo "🖨️  Did the Rollo print? (watch for 2-3 min)"
echo "📦 Check ShipStation for the new label"
echo ""
echo "If the Rollo DIDN'T print:"
echo "  - The label was created (you paid for it)"
echo "  - But ShipStation Connect didn't auto-print it"
echo "  - You can manually print it from ShipStation website"
echo ""
