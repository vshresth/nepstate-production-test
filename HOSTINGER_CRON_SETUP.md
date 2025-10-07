# 🎯 Hostinger Cron Job Setup Guide

## **Method 1: Hostinger Control Panel (Easiest)**

### **Step 1: Access Cron Jobs in Hostinger**
1. **Login to Hostinger Control Panel**
2. **Go to "Advanced" → "Cron Jobs"**
3. **Click "Create New Cron Job"**

### **Step 2: Configure the Cron Job**
```
Name: NepState Sitemap Updater
Command: /usr/bin/php /home/u415500770/domains/nepstate.com/public_html/auto_sitemap_updater.php
Schedule: Choose one:
  - Daily: 0 2 * * * (Every day at 2 AM)
  - Weekly: 0 2 * * 0 (Every Sunday at 2 AM)
Email: your-email@domain.com (for notifications)
```

### **Step 3: Test the Script First**
Before setting up cron job, test the script:
1. **Upload `auto_sitemap_updater.php`** to your public_html folder
2. **Update database credentials** in the script
3. **Run manually** via browser: `https://nepstate.com/auto_sitemap_updater.php`
4. **Check if sitemap.xml** is updated

---

## **Method 2: Manual Setup (If Control Panel Not Available)**

### **Step 1: Access Your Server**
- **SSH Access** (if available on your Hostinger plan)
- **File Manager** in Hostinger control panel

### **Step 2: Upload Files**
Upload these files to your `public_html` folder:
- `auto_sitemap_updater.php`
- `sitemap.xml` (current version)

### **Step 3: Create Cron Job**
If you have SSH access:
```bash
crontab -e
```
Add this line:
```
0 2 * * * cd /home/u415500770/domains/nepstate.com/public_html && php auto_sitemap_updater.php >> logs/cron.log 2>&1
```

---

## **🔧 Hostinger-Specific Configuration**

### **Database Credentials for Hostinger:**
```php
'database' => [
    'host' => 'localhost',
    'username' => 'u415500770_nepstate',
    'password' => 'P145DeDevelopers', 
    'database' => 'u415500770_nepstate'
],
```

### **File Paths for Hostinger:**
```php
'sitemap_file' => '/home/u415500770/domains/nepstate.com/public_html/sitemap.xml',
'backup_dir' => '/home/u415500770/domains/nepstate.com/public_html/sitemap_backups/',
'log_file' => '/home/u415500770/domains/nepstate.com/public_html/logs/sitemap_update.log'
```

---

## **📋 Step-by-Step Setup:**

### **Step 1: Prepare Files**
1. **Download** `auto_sitemap_updater.php`
2. **Edit** database credentials (lines 8-13)
3. **Upload** to your `public_html` folder

### **Step 2: Create Directories**
Create these folders in your `public_html`:
- `sitemap_backups/`
- `logs/`

### **Step 3: Test the Script**
Visit: `https://nepstate.com/auto_sitemap_updater.php`
You should see:
```
🚀 Starting automatic sitemap update
✅ Connected to database
📊 Found: X businesses, Y blogs, Z forums
💾 Generated new sitemap: sitemap.xml
✅ Sitemap update completed successfully!
```

### **Step 4: Set Up Cron Job**
**In Hostinger Control Panel:**
1. **Advanced → Cron Jobs**
2. **Create New Cron Job**
3. **Fill in the details:**

```
Name: NepState Sitemap Auto-Update
Command: /usr/bin/php /home/u415500770/domains/nepstate.com/public_html/auto_sitemap_updater.php
Schedule: 0 2 * * * (Daily at 2 AM)
Email: your-email@domain.com
```

### **Step 5: Verify It's Working**
**After 24 hours:**
1. **Check logs:** `https://nepstate.com/logs/sitemap_update.log`
2. **Check sitemap:** `https://nepstate.com/sitemap.xml`
3. **Verify timestamps** are updated

---

## **🎯 Hostinger-Specific Tips:**

### **File Permissions:**
Make sure these permissions are set:
- `auto_sitemap_updater.php`: 644
- `sitemap_backups/`: 755
- `logs/`: 755

### **PHP Version:**
Ensure your script uses the correct PHP version:
```bash
# Check PHP version
php -v
```

### **Email Notifications:**
Hostinger cron jobs can send email notifications:
- ✅ **Success notifications**
- ✅ **Error notifications**
- ✅ **Log summaries**

---

## **🔍 Troubleshooting:**

### **Common Hostinger Issues:**

#### **1. "Permission denied"**
**Solution:** Check file permissions
```
chmod 644 auto_sitemap_updater.php
chmod 755 sitemap_backups/
chmod 755 logs/
```

#### **2. "Command not found"**
**Solution:** Use full path to PHP
```
/usr/bin/php /home/u415500770/domains/nepstate.com/public_html/auto_sitemap_updater.php
```

#### **3. "Database connection failed"**
**Solution:** Verify credentials in script
```php
'username' => 'u415500770_nepstate',
'password' => 'P145DeDevelopers',
```

#### **4. "Cron job not running"**
**Solution:** Check Hostinger cron job status
- Go to **Advanced → Cron Jobs**
- Check if job is **"Active"**
- Look for error messages

---

## **📊 Expected Results:**

### **After Setup:**
- ✅ **Sitemap updates automatically** daily/weekly
- ✅ **New businesses** appear in sitemap automatically
- ✅ **Email notifications** when updates run
- ✅ **Logs** show all activity
- ✅ **Backups** of old sitemaps

### **SEO Benefits:**
- 🎯 **Faster indexing** of new business listings
- 🎯 **Better Google rankings** for business names
- 🎯 **Improved local SEO** visibility
- 🎯 **Increased organic traffic**

---

## **💡 Hostinger Pro Tips:**

1. **Start with weekly** updates, then move to daily
2. **Monitor email notifications** for the first week
3. **Check logs regularly** for any errors
4. **Test manually first** before setting up cron job
5. **Keep backup** of current sitemap.xml

**Result: Your sitemap will automatically update with all new business listings on Hostinger!** 🎯
