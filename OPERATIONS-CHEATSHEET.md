# 📋 VisorPlate Operations Cheat Sheet

> Quick reference for daily business operations via terminal commands

**Status**: Living document - update as commands are added  
**Audience**: Business owner, future staff, emergency backup  
**Philosophy**: Terminal > Dashboard for low-volume operations

---

## 🚀 Quick Start (Most Used)

```bash
# Morning routine (if Rollo cron didn't auto-run)
php artisan orders:pending

# Customer asks "where's my order?"
php artisan order:lookup customer@email.com

# Check if everything is healthy
php artisan backup:monitor && php artisan queue:monitor
```

---

## 📦 Order Management

### View Orders

```bash
# Pending orders (paid, not shipped)
php artisan orders:pending

# Today's orders
php artisan orders:today

# All orders (with filters)
php artisan order:list
php artisan order:list --status=completed
php artisan order:list --date=2026-01-14

# Specific order details
php artisan order:show 123
# Shows: Customer name, email, address, amount, status, Stripe IDs

# Search by email
php artisan order:lookup customer@email.com
# Returns: All orders for that customer
```

### Manual Shipping (Override Automation)

```bash
# Print single label (if 8am cron missed it)
php artisan order:print 123

# Mark as shipped (if you printed label elsewhere)
php artisan order:ship 123 USPS1234567890
# Automatically queues tracking email

# Bulk print (all pending)
php artisan orders:print-pending
# This is what the 8am cron runs
```

### Order Status Changes

```bash
# Mark as returned
php artisan order:return 123 "Customer didn't like the color"

# Mark as refunded (updates Stripe too)
php artisan order:refund 123 --reason="Defective product"

# Cancel order (before shipping)
php artisan order:cancel 123
```

---

## 🔍 Customer Service

### Quick Lookup

```bash
# Find customer's order
php artisan order:lookup customer@email.com

# Output example:
# Order #000123 | Status: shipped | Tracking: USPS1234567890
# Shipped: Jan 14, 2026 | Amount: $35.00
```

### Tracking Information

```bash
# Get tracking URL
php artisan order:tracking 123
# Returns: https://tools.usps.com/go/TrackConfirmAction?tLabels=...

# Resend tracking email
php artisan order:resend-tracking 123
```

### Returns Management

```bash
# View all returns this month
php artisan orders:returns --month=current

# View returns needing attention (>7 days old)
php artisan orders:returns --attention

# Mark return as processed
php artisan order:return-processed 123
```

---

## 💼 Wholesale & Leads

### Export Leads

```bash
# Export wholesale inquiries to CSV
php artisan export:wholesale-leads
# Saves to: storage/app/exports/wholesale-YYYY-MM-DD.csv

# Export with date range
php artisan export:wholesale-leads --from=2026-01-01 --to=2026-01-31

# View wholesale inquiries in terminal
php artisan wholesale:list
```

### Newsletter Signups

```bash
# Export newsletter signups by source
php artisan export:newsletter --source=social-interest-instagram
php artisan export:newsletter --source=footer

# View counts
php artisan newsletter:stats
# Output: Instagram: 247, Facebook: 156, X: 89, Footer: 34
```

---

## 🔧 System Health & Troubleshooting

### Queue System

```bash
# Check queue status
php artisan queue:monitor
# Shows: Jobs waiting, processing, failed

# View failed jobs
php artisan queue:failed

# Retry specific failed job
php artisan queue:retry {job-id}

# Retry all failed jobs
php artisan queue:retry all

# Clear all jobs (emergency reset)
php artisan queue:flush
```

### Backups

```bash
# Check backup health
php artisan backup:monitor
# Verifies: Local + S3 backups exist, recent, correct size

# Manual backup (before risky changes)
php artisan backup:run
php artisan backup:run --only-db  # Database only

# List backups
php artisan backup:list

# Test restore (to verify backups work)
php artisan backup:restore --test
```

### Error Monitoring

```bash
# Recent errors (from logs)
tail -f storage/logs/laravel.log

# Check Flare.io for production errors
# Visit: https://flareapp.io/projects/visorplate

# Clear error log (after fixing issues)
> storage/logs/laravel.log
```

### Cache & Configuration

```bash
# Clear everything (when something feels "stuck")
php artisan optimize:clear

# Individual clears
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches (production)
php artisan optimize
```

---

## 📊 Analytics & Reports

### Sales Reports

```bash
# Daily sales summary
php artisan report:daily

# Monthly revenue
php artisan report:monthly --month=2026-01

# Top customers (by order count)
php artisan report:top-customers --limit=10
```

### Inventory Check

```bash
# How many units sold this month?
php artisan report:units-sold --month=current

# Projected inventory needs
php artisan report:inventory-forecast
```

---

## 🚨 Emergency Procedures

### Customer Says "I Never Got My Order"

```bash
# 1. Look up order
php artisan order:lookup customer@email.com

# 2. Check tracking
php artisan order:tracking 123

# 3. If tracking shows delivered → Customer issue
# 4. If tracking stuck → Contact USPS
# 5. If no tracking → Investigate why label didn't print

# 6. Manual intervention (if needed)
php artisan order:reship 123  # Creates new label, doesn't charge
```

### Printer Was Down, Orders Not Shipped

```bash
# 1. Check how many pending
php artisan orders:pending

# 2. Print all at once
php artisan orders:print-pending

# 3. Verify all printed
php artisan orders:pending  # Should be empty now
```

### Stripe Webhook Failed

```bash
# 1. Check Flare.io for webhook error details
# Visit: https://flareapp.io

# 2. Find the failed order in Stripe dashboard
# Get: Session ID (cs_...)

# 3. Manually create order from session
php artisan order:create-from-session cs_test_abc123...

# 4. Verify order created
php artisan order:show 123

# 5. Email customer confirmation (if not auto-sent)
php artisan order:resend-confirmation 123
```

### Email Not Sending

```bash
# 1. Check queue is running
php artisan queue:work &

# 2. Check failed jobs
php artisan queue:failed

# 3. If job failed, check error
php artisan queue:failed  # Note the ID

# 4. Retry
php artisan queue:retry {job-id}

# 5. If still failing, check .env email credentials
```

### Database Restore Needed

```bash
# 1. Stop queue workers
sudo supervisorctl stop visorplate-queue:*

# 2. Put site in maintenance mode
php artisan down

# 3. List available backups
php artisan backup:list

# 4. Download backup from S3
aws s3 cp s3://visorplate-backups/backup-YYYY-MM-DD.zip ./

# 5. Extract
unzip backup-YYYY-MM-DD.zip

# 6. Restore database
mysql -u user -p visorplate < db-dump.sql

# 7. Verify data
php artisan tinker
>>> Order::count()  # Should match expected

# 8. Bring site back up
php artisan up
sudo supervisorctl start visorplate-queue:*
```

---

## 🛠️ Maintenance Tasks

### Weekly (Automated, verify ran)

```bash
# Check return photo cleanup ran
ls -la storage/app/public/returns/
# Should only see folders from last 90 days

# Check backups are running
php artisan backup:monitor
# Should show recent backups on both local + S3
```

### Monthly

```bash
# Export wholesale leads for outreach
php artisan export:wholesale-leads --month=last

# Review failed jobs (anything stuck?)
php artisan queue:failed

# Check for orphaned files
php artisan storage:cleanup --dry-run
```

### Before Big Changes

```bash
# 1. Manual backup
php artisan backup:run

# 2. Verify backup succeeded
php artisan backup:monitor

# 3. Make changes
# ...

# 4. Test critical paths
php artisan test

# 5. If disaster → Restore from backup
```

---

## 📝 Common Workflows

### Processing a Wholesale Inquiry

1. **Check inquiry details:**
   ```bash
   php artisan wholesale:show 45
   ```

2. **Export contact info:**
   ```bash
   php artisan export:wholesale-leads --id=45
   ```

3. **Send custom quote via email manually**

4. **If they order, create manual order:**
   ```bash
   php artisan order:create-wholesale \
     --email=dealer@example.com \
     --quantity=200 \
     --price=2500
   ```

### Handling a Return

1. **Customer submits return form (automatic)**

2. **Review return request:**
   ```bash
   php artisan returns:pending
   ```

3. **Approve return:**
   ```bash
   php artisan return:approve 123
   # Sends return label to customer
   ```

4. **Customer ships back, you receive it**

5. **Process refund:**
   ```bash
   php artisan order:refund 123 --reason="Return processed"
   # Automatically refunds in Stripe
   ```

6. **Mark return complete:**
   ```bash
   php artisan return:complete 123
   ```

---

## 🔐 Security Operations

### Rate Limit Management

```bash
# Check if customer is rate limited
php artisan tinker
>>> RateLimiter::tooManyAttempts('contact-form:192.168.1.1', 5)

# Clear rate limit (for legitimate customer)
>>> RateLimiter::clear('contact-form:192.168.1.1')
```

### Review Suspicious Activity

```bash
# Check social interest logs (spam detection)
php artisan social:review --flagged

# View newsletter signups by IP (duplicate detection)
php artisan newsletter:duplicates
```

---

## 💡 Pro Tips

### Create Aliases (Optional)

Add to `~/.zshrc` or `~/.bashrc`:

```bash
alias vp="cd ~/visor-plate && php artisan"
alias vp-orders="vp orders:pending"
alias vp-lookup="vp order:lookup"
alias vp-health="vp backup:monitor && vp queue:monitor"
```

Then use:
```bash
vp-orders  # Instead of php artisan orders:pending
```

### SSH Into Production

```bash
ssh forge@visorplate.com
cd ~/visor-plate
php artisan orders:pending
```

### Monitor in Real-Time

```bash
# Watch orders come in (production)
watch -n 30 'php artisan orders:today | tail -20'

# Monitor queue
watch -n 5 'php artisan queue:monitor'
```

---

## 📚 Where Commands Come From

**Existing (Laravel):**
- `queue:*` - Built into Laravel
- `backup:*` - spatie/laravel-backup package
- `tinker` - Built into Laravel

**To Be Created (Rollo Task):**
- `orders:*` - Custom for order management
- `order:*` - Single order operations
- `returns:*` - Return management
- `wholesale:*` - Wholesale inquiry handling

**To Be Created (Future):**
- `report:*` - Analytics and reporting
- `export:*` - Data exports

---

## 🆘 When To Use What

| Situation | Command | Alternative |
|-----------|---------|-------------|
| "Where's my order?" | `order:lookup email@...` | Check Stripe |
| Printer was down | `orders:print-pending` | Print manually |
| Need to refund | `order:refund 123` | Use Stripe dashboard |
| Check system health | `backup:monitor` | Check S3/Flare |
| Customer service | `order:show 123` | Use Stripe |
| Bulk operations | `orders:print-pending` | Terminal only option |
| Emergency recovery | `backup:restore` | Terminal only option |

---

## 📱 Mobile Access (Emergency)

If you need to handle an order from your phone:

1. **Use Stripe app** - See payments, issue refunds
2. **Use Termius app** - SSH into server, run commands
3. **Use Flare mobile** - Check for errors

---

**Last Updated**: January 14, 2026  
**Status**: Living document - update as new commands are added  
**Location**: Keep in project root for easy reference

---

## 🎯 Next Steps

1. Create these commands as needed (see task-rollo-auto-print.md)
2. Test each command in development before production
3. Update this cheat sheet as commands are added
4. Print/bookmark this file for quick reference

**Priority Commands to Build (with Rollo task):**
- `orders:pending` - Most used
- `orders:print-pending` - For 8am cron
- `order:lookup` - Customer service
- `order:show` - Order details
- `order:ship` - Manual override
