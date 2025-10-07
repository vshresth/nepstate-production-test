#!/bin/bash

# Setup Cron Job for Automatic Sitemap Updates
# This script sets up automatic sitemap generation and Google Search Console resubmission

echo "🚀 Setting up automatic sitemap updates for NepState..."

# Get current directory
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PHP_SCRIPT="$SCRIPT_DIR/auto_sitemap_updater.php"

echo "📁 Script location: $PHP_SCRIPT"

# Check if PHP script exists
if [ ! -f "$PHP_SCRIPT" ]; then
    echo "❌ Error: auto_sitemap_updater.php not found!"
    echo "   Please make sure the file exists in: $SCRIPT_DIR"
    exit 1
fi

# Make PHP script executable
chmod +x "$PHP_SCRIPT"
echo "✅ Made PHP script executable"

# Create log directory
LOG_DIR="$SCRIPT_DIR/logs"
mkdir -p "$LOG_DIR"
echo "📁 Created log directory: $LOG_DIR"

# Backup directory for sitemap backups
BACKUP_DIR="$SCRIPT_DIR/sitemap_backups"
mkdir -p "$BACKUP_DIR"
echo "📁 Created backup directory: $BACKUP_DIR"

# Test the script first
echo "🧪 Testing the sitemap updater script..."
php "$PHP_SCRIPT"

if [ $? -eq 0 ]; then
    echo "✅ Script test successful!"
else
    echo "❌ Script test failed! Please check database credentials and try again."
    exit 1
fi

# Create cron job entries
echo ""
echo "📅 Choose your cron job frequency:"
echo "1. Daily (recommended for active sites)"
echo "2. Weekly (good for moderate activity)"
echo "3. Custom (you specify the schedule)"
echo ""
read -p "Enter your choice (1-3): " choice

case $choice in
    1)
        CRON_SCHEDULE="0 2 * * *"  # Daily at 2 AM
        SCHEDULE_DESC="daily at 2:00 AM"
        ;;
    2)
        CRON_SCHEDULE="0 2 * * 0"  # Weekly on Sunday at 2 AM
        SCHEDULE_DESC="weekly on Sunday at 2:00 AM"
        ;;
    3)
        echo ""
        echo "📅 Custom cron schedule examples:"
        echo "   Every hour: 0 * * * *"
        echo "   Every 6 hours: 0 */6 * * *"
        echo "   Every day at 3 AM: 0 3 * * *"
        echo "   Every Monday at 1 AM: 0 1 * * 1"
        echo ""
        read -p "Enter your cron schedule (format: minute hour day month weekday): " CRON_SCHEDULE
        SCHEDULE_DESC="custom schedule: $CRON_SCHEDULE"
        ;;
    *)
        echo "❌ Invalid choice. Exiting."
        exit 1
        ;;
esac

# Create the cron job command
CRON_COMMAND="$CRON_SCHEDULE cd $SCRIPT_DIR && php $PHP_SCRIPT >> $LOG_DIR/cron.log 2>&1"

echo ""
echo "🔧 Setting up cron job..."
echo "   Schedule: $SCHEDULE_DESC"
echo "   Command: $CRON_COMMAND"

# Add to crontab
(crontab -l 2>/dev/null; echo "$CRON_COMMAND") | crontab -

if [ $? -eq 0 ]; then
    echo "✅ Cron job added successfully!"
    echo ""
    echo "📋 Summary:"
    echo "   • Sitemap will update $SCHEDULE_DESC"
    echo "   • Logs will be saved to: $LOG_DIR/cron.log"
    echo "   • Backups will be saved to: $BACKUP_DIR"
    echo "   • Script location: $PHP_SCRIPT"
    echo ""
    echo "🔍 To verify your cron job:"
    echo "   Run: crontab -l"
    echo ""
    echo "📊 To check logs:"
    echo "   Run: tail -f $LOG_DIR/cron.log"
    echo ""
    echo "🛑 To remove the cron job later:"
    echo "   Run: crontab -e (then delete the line)"
else
    echo "❌ Failed to add cron job. Please try manually:"
    echo "   1. Run: crontab -e"
    echo "   2. Add this line: $CRON_COMMAND"
    echo "   3. Save and exit"
fi

echo ""
echo "🎯 Next steps:"
echo "   1. The sitemap will update automatically $SCHEDULE_DESC"
echo "   2. Monitor logs at: $LOG_DIR/cron.log"
echo "   3. Manually resubmit to Google Search Console after first run"
echo "   4. Check sitemap_backups/ for historical versions"
echo ""
echo "✅ Setup complete!"
