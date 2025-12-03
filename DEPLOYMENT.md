# Deploying Laravel Task Manager to cPanel

This guide will help you deploy your Laravel application to cPanel.

## Prerequisites

- cPanel access
- PHP 8.2 or higher
- MySQL database
- SSH access (recommended) or File Manager access

## Step 1: Prepare Your Application for Production

### 1.1 Update .env file for production

Create/update your `.env` file with production settings:

```env
APP_NAME="Task Manager"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### 1.2 Generate Application Key

Run this locally before uploading:
```bash
php artisan key:generate
```

Or generate it on the server after uploading.

## Step 2: Upload Files to cPanel

### Option A: Using File Manager

1. Log into cPanel
2. Open **File Manager**
3. Navigate to `public_html` (or your domain's root directory)
4. Upload all files EXCEPT:
   - `.env` (you'll create this on the server)
   - `node_modules/` (don't upload this)
   - `.git/` (optional)
   - `storage/logs/*` (but keep the directory structure)

### Option B: Using FTP/SFTP

1. Connect via FTP client (FileZilla, WinSCP, etc.)
2. Upload all files to `public_html` directory
3. Exclude the same files as above

### Option C: Using Git (if available)

```bash
cd public_html
git clone your-repository-url .
```

## Step 3: Set Up Directory Structure

Laravel needs specific directory permissions. In cPanel File Manager or via SSH:

1. Move `public` folder contents to `public_html`
2. Move everything else one level up (to the parent of `public_html`)

**Recommended Structure:**
```
/home/username/
├── public_html/          (this is your web root)
│   ├── index.php
│   ├── .htaccess
│   ├── assets/
│   └── build/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
└── artisan
```

**OR Alternative Structure (if you can't modify public_html parent):**
```
/home/username/public_html/
├── public/               (your Laravel public folder)
│   ├── index.php
│   └── .htaccess
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
└── artisan
```

## Step 4: Configure .htaccess

### If using the recommended structure (Laravel in parent directory):

Create/update `public_html/.htaccess`:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### If using alternative structure (Laravel in public_html):

Update `public_html/public/.htaccess`:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## Step 5: Set Up Database

1. In cPanel, go to **MySQL Databases**
2. Create a new database (note the full name: `username_dbname`)
3. Create a new MySQL user
4. Add the user to the database with ALL PRIVILEGES
5. Note the credentials for your `.env` file

## Step 6: Configure Environment

1. In File Manager, create `.env` file in your Laravel root
2. Copy from `.env.example` and update with:
   - Database credentials
   - `APP_URL` (your domain)
   - `APP_ENV=production`
   - `APP_DEBUG=false`

3. Generate application key (via SSH or Terminal in cPanel):
```bash
php artisan key:generate
```

## Step 7: Set Permissions

Set proper permissions (via SSH or File Manager):
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

Or in File Manager:
- Right-click `storage` folder → Change Permissions → 775
- Right-click `bootstrap/cache` folder → Change Permissions → 775

## Step 8: Install Dependencies

### Via SSH (recommended):
```bash
cd /home/username/public_html  # or your Laravel root
composer install --optimize-autoloader --no-dev
```

### Via cPanel Terminal:
If cPanel has a terminal feature, use the same commands.

## Step 9: Build Assets

```bash
npm install --production
npm run build
```

Or if you built locally, just upload the `public/build` folder.

## Step 10: Run Migrations

```bash
php artisan migrate --force
```

## Step 11: Clear and Cache Configuration

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Step 12: Update index.php Path

If Laravel is in a parent directory, update `public_html/index.php`:

```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

## Step 13: Test Your Application

1. Visit your domain
2. Try registering a new user
3. Create a task
4. Check for any errors

## Troubleshooting

### 500 Internal Server Error
- Check `.env` file exists and is configured correctly
- Check file permissions (storage, bootstrap/cache should be 775)
- Check error logs in `storage/logs/laravel.log`

### Database Connection Error
- Verify database credentials in `.env`
- Check database user has proper permissions
- Ensure database exists

### Assets Not Loading
- Run `npm run build` on the server
- Check `public/build` folder exists
- Verify `APP_URL` in `.env` matches your domain

### Permission Denied
- Set storage and bootstrap/cache to 775
- Ensure web server user owns the files

## Quick Checklist

- [ ] Files uploaded to server
- [ ] `.env` file created with correct settings
- [ ] Database created and configured
- [ ] `composer install` run
- [ ] `npm run build` run
- [ ] Permissions set (storage: 775, bootstrap/cache: 775)
- [ ] `php artisan key:generate` run
- [ ] `php artisan migrate` run
- [ ] `php artisan config:cache` run
- [ ] `.htaccess` configured correctly
- [ ] Application tested

## Security Notes

- Never commit `.env` file to Git
- Set `APP_DEBUG=false` in production
- Use strong database passwords
- Keep Laravel and dependencies updated
- Regularly backup your database

## Need Help?

Check Laravel logs: `storage/logs/laravel.log`
Check cPanel error logs in cPanel → Metrics → Errors

