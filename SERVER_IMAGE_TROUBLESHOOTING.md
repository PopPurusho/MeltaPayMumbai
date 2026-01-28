# Server Image Not Loading - Troubleshooting Guide

## Issue
Logo images work on localhost but not on production server (https://meltapay.com)

## Quick Checklist

### 1. ✅ Verify File Upload
SSH into your server and check if the image file exists:
```bash
ls -la /opt/bitnami/apache/htdocs/public/img/
# or wherever your public directory is
```

**Expected:** You should see `logo-small.jpg` (47,389 bytes)

### 2. ✅ Check File Permissions
```bash
cd /opt/bitnami/apache/htdocs/public/img/
ls -la logo-small.jpg
```

**Expected permissions:** `-rw-r--r--` (644) or `-rwxr-xr-x` (755)

**Fix if needed:**
```bash
chmod 644 /opt/bitnami/apache/htdocs/public/img/*.jpg
chmod 644 /opt/bitnami/apache/htdocs/public/img/*.png
```

### 3. ✅ Case Sensitivity Check
Linux is case-sensitive! Verify exact filename:
```bash
ls -la /opt/bitnami/apache/htdocs/public/img/ | grep -i logo
```

**Must match exactly:** `logo-small.jpg` (all lowercase)

### 4. ✅ Test Direct URL Access
Open in browser:
```
https://meltapay.com/img/logo-small.jpg
```

**Expected:** Image should display directly
**If 404:** File missing or path wrong
**If 403:** Permission issue

### 5. ✅ Clear Application Cache
```bash
cd /opt/bitnami/apache/htdocs
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### 6. ✅ Check .htaccess (Apache) or Nginx Config

**For Apache (.htaccess in public/):**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Don't rewrite files or directories
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [L]
</IfModule>
```

**For Nginx:**
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

# Explicitly handle static files
location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
    expires 1y;
    access_log off;
}
```

### 7. ✅ Verify APP_URL in Production .env
```bash
grep APP_URL /opt/bitnami/apache/htdocs/.env
```

**Expected:** `APP_URL=https://meltapay.com`

**Fix if needed:**
```bash
nano /opt/bitnami/apache/htdocs/.env
# Set: APP_URL=https://meltapay.com
# Save and exit

# Then clear config
php artisan config:clear
```

### 8. ✅ Check Symbolic Links (if using storage)
```bash
ls -la /opt/bitnami/apache/htdocs/public/ | grep storage
```

If you see a broken link, recreate it:
```bash
cd /opt/bitnami/apache/htdocs
php artisan storage:link
```

### 9. ✅ Check Web Server Error Logs

**Apache:**
```bash
tail -f /opt/bitnami/apache/logs/error_log
```

**Nginx:**
```bash
tail -f /var/log/nginx/error.log
```

Look for 404 or permission errors when trying to load the image.

### 10. ✅ Browser Developer Tools
Open browser DevTools (F12) → Network tab → Reload page

Look for:
- Status code for `logo-small.jpg` (should be 200, not 404 or 403)
- Actual URL being requested
- Any CORS or mixed content errors (HTTP vs HTTPS)

## Most Common Solutions

### Solution 1: File Not Uploaded
Upload the entire `public/img/` directory to your server:
```bash
scp -r public/img/* user@server:/opt/bitnami/apache/htdocs/public/img/
```

### Solution 2: Wrong Permissions
```bash
cd /opt/bitnami/apache/htdocs
chmod -R 755 public/img
chown -R daemon:daemon public/img
# or
chown -R www-data:www-data public/img
```

### Solution 3: Case Mismatch
If file is named `Logo-Small.jpg` but code uses `logo-small.jpg`:
```bash
cd /opt/bitnami/apache/htdocs/public/img/
mv Logo-Small.jpg logo-small.jpg
```

### Solution 4: .htaccess Not Working
```bash
# Check if mod_rewrite is enabled
apache2ctl -M | grep rewrite
# or
apachectl -M | grep rewrite

# Enable if needed
a2enmod rewrite
systemctl restart apache2
```

### Solution 5: SELinux Blocking (CentOS/RHEL)
```bash
# Check if SELinux is the issue
getenforce

# Fix if needed
chcon -R -t httpd_sys_content_t /opt/bitnami/apache/htdocs/public/img/
# or temporarily disable
setenforce 0
```

## Quick Test Script

Create this file on your server: `/opt/bitnami/apache/htdocs/public/test-image.php`

```php
<?php
$imagePath = __DIR__ . '/img/logo-small.jpg';
echo "Checking: " . $imagePath . "\n";
echo "Exists: " . (file_exists($imagePath) ? 'YES' : 'NO') . "\n";
echo "Readable: " . (is_readable($imagePath) ? 'YES' : 'NO') . "\n";
echo "Size: " . (file_exists($imagePath) ? filesize($imagePath) : 0) . " bytes\n";
echo "Permissions: " . (file_exists($imagePath) ? substr(sprintf('%o', fileperms($imagePath)), -4) : 'N/A') . "\n";
?>
```

Access: `https://meltapay.com/test-image.php`

**Expected output:**
```
Checking: /opt/bitnami/apache/htdocs/public/img/logo-small.jpg
Exists: YES
Readable: YES
Size: 47389 bytes
Permissions: 0644
```

## If Still Not Working

1. Check if images are served from a CDN
2. Check if CloudFlare/proxy is caching old version
3. Verify no browser cache issues (Ctrl+Shift+R)
4. Check if using Docker (paths might be different)
5. Verify correct document root in Apache/Nginx config

## Document Root Check

Find your Apache/Nginx document root:

**Apache:**
```bash
grep -r "DocumentRoot" /opt/bitnami/apache/conf/
```

**Nginx:**
```bash
grep -r "root" /etc/nginx/sites-enabled/
```

Should point to: `/opt/bitnami/apache/htdocs/public` (or similar)

## Contact Info for Support

If none of these work, provide:
1. Output of test-image.php
2. Direct URL test result (https://meltapay.com/img/logo-small.jpg)
3. Server type (Apache/Nginx)
4. Error log entries
5. Browser network tab screenshot
