# Storage Migration Guide - AWS Lightsail Compatibility

## Overview
This update migrates file uploads from `public/uploads` to Laravel's standard `storage/app/public` directory, ensuring compatibility with AWS Lightsail and maintaining backward compatibility with existing files.

## Changes Made

### 1. Upload Logic Updated
- **File**: `app/Utils/Util.php`
  - `uploadFile()` now uses `Storage::disk('public')` instead of default disk
  - New method `getUploadedFileUrl()` handles URL generation with backward compatibility

### 2. Media Model Updated
- **File**: `app/Media.php`
  - `uploadFile()` stores in `storage/app/public/media`
  - `uploadBase64Image()` uses Storage facade
  - `deleteMedia()` checks both new and legacy paths
  - `getDisplayUrlAttribute()` checks storage disk first, falls back to legacy
  - `getDisplayPathAttribute()` updated for both paths

### 3. Business Logo Handling
- **File**: `app/Business.php`
  - New accessor `getLogoUrlAttribute()` provides automatic URL resolution
  - Checks `storage/app/public/business_logos` first
  - Falls back to `public/uploads/business_logos`

### 4. Invoice Logo Updates
- **Files**: 
  - `app/Utils/TransactionUtil.php`
  - `app/Http/Controllers/PurchaseOrderController.php`
  - Now use `getUploadedFileUrl()` helper

### 5. View Updates
- **File**: `resources/views/sale_pos/partials/guest_payment_form.blade.php`
  - Uses `$transaction->business->logo_url` accessor

## Deployment Steps for AWS Lightsail

### Step 1: Create Storage Link
Run this command on your AWS Lightsail server:
```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public`.

### Step 2: Verify Permissions
Ensure proper permissions on storage directory:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Step 3: Test Upload
1. Try uploading a new business logo via the registration form
2. Verify the file appears in `storage/app/public/business_logos/`
3. Verify the image displays correctly in the UI

### Step 4: Optional - Migrate Existing Files
If you want to move existing uploads to the new location:

```bash
# Business logos
cp -r public/uploads/business_logos/* storage/app/public/business_logos/

# Invoice logos
cp -r public/uploads/invoice_logos/* storage/app/public/invoice_logos/

# Documents
cp -r public/uploads/documents/* storage/app/public/documents/

# Media files
cp -r public/uploads/media/* storage/app/public/media/

# Set proper permissions
chmod -R 775 storage/app/public
chown -R www-data:www-data storage/app/public
```

**Note**: The application will continue to serve files from the old location if they exist, so migration is optional.

## Backward Compatibility

✅ **All file access methods check both locations:**
1. First checks `storage/app/public/{dir}/{file}`
2. If not found, checks `public/uploads/{dir}/{file}`
3. Returns appropriate URL based on location

✅ **No database changes required** - file names remain the same

✅ **Existing files continue to work** from `public/uploads`

✅ **New uploads go to** `storage/app/public`

## File Structure

### New Structure (After Migration)
```
storage/
└── app/
    └── public/
        ├── business_logos/
        ├── invoice_logos/
        ├── documents/
        └── media/

public/
└── storage/ → symlink to storage/app/public
```

### Access URLs
- Old: `https://meltapay.com/uploads/business_logos/logo.png`
- New: `https://meltapay.com/storage/business_logos/logo.png`

## Troubleshooting

### Images Not Displaying
1. Verify storage link exists: `ls -la public/storage`
2. If not, run: `php artisan storage:link`
3. Check permissions: `ls -la storage/app/public`

### Upload Failing
1. Check storage directory is writable: `chmod -R 775 storage`
2. Verify disk configuration in `config/filesystems.php`
3. Check error logs: `tail -f storage/logs/laravel.log`

### Mixed Content Errors
Ensure `APP_URL` in `.env` uses HTTPS:
```env
APP_URL=https://meltapay.com
```

## Testing Checklist

- [ ] Storage link created (`php artisan storage:link`)
- [ ] Upload new business logo - file saved to `storage/app/public/business_logos/`
- [ ] Logo displays in forms and invoices
- [ ] Upload invoice logo - file saved to `storage/app/public/invoice_logos/`
- [ ] Upload document attachment
- [ ] Upload media files
- [ ] Existing files still display correctly
- [ ] File deletion works for both old and new locations

## Environment Configuration

Ensure your `.env` has:
```env
APP_URL=https://meltapay.com
FILESYSTEM_DISK=public
```

## Benefits

✅ Standard Laravel storage pattern
✅ Works seamlessly on AWS Lightsail
✅ Better security (files outside public directory)
✅ Easier backup (single storage directory)
✅ CDN-ready for future scaling
✅ Full backward compatibility maintained
