# Quick Deployment Checklist for cPanel

## Pre-Deployment (Local)

- [ ] Run `php artisan key:generate` and copy the key
- [ ] Run `npm run build` to build production assets
- [ ] Test the application locally
- [ ] Review `.gitignore` to ensure sensitive files aren't uploaded

## Files to Upload

Upload everything EXCEPT:
- `.env` (create new on server)
- `node_modules/` (don't upload)
- `.git/` (optional)
- `storage/logs/*.log` (keep directory structure)

## On Server (cPanel)

### 1. Upload Files
- [ ] Upload all files via FTP/File Manager
- [ ] Ensure proper directory structure

### 2. Database Setup
- [ ] Create MySQL database in cPanel
- [ ] Create MySQL user
- [ ] Grant user privileges to database
- [ ] Note database credentials

### 3. Environment Configuration
- [ ] Create `.env` file in root directory
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_URL=https://yourdomain.com`
- [ ] Configure database credentials
- [ ] Set `SESSION_DRIVER=database`

### 4. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install --production
npm run build
```

### 5. Generate Key & Run Migrations
```bash
php artisan key:generate
php artisan migrate --force
```

### 6. Set Permissions
```bash
chmod -R 775 storage bootstrap/cache
```

### 7. Cache Configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 8. Test
- [ ] Visit your domain
- [ ] Register a new user
- [ ] Create a task
- [ ] Check for errors

## Quick Commands Reference

```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Build assets
npm install --production
npm run build

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Set permissions
chmod -R 775 storage bootstrap/cache

# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear cache (if needed)
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Common Issues

**500 Error:**
- Check `.env` file exists
- Check file permissions (storage: 775)
- Check error logs: `storage/logs/laravel.log`

**Database Error:**
- Verify database credentials in `.env`
- Check database user has permissions
- Ensure database exists

**Assets Not Loading:**
- Run `npm run build` on server
- Check `public/build` folder exists
- Verify `APP_URL` in `.env`

