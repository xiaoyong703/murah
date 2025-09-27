# 🚀 cPanel Deployment Guide

## Quick Setup for cPanel

### 1. Upload Files
- Download/clone this repository
- Upload all files to your cPanel's `public_html` directory
- Or upload to a subdirectory like `public_html/murah/`

### 2. File Structure After Upload
```
public_html/
├── index.html          # Navigation page
├── dashboard.html      # Main dashboard
├── dashboard.php       # PHP dashboard (requires database)
├── styles.css          # Global styles
├── landing/            # Marketing landing page
│   ├── index.html      # Landing page
│   ├── styles.css      # Landing styles
│   └── auth.php        # Authentication
├── inc/               # PHP includes
├── subjects/          # Subject pages
└── assets/            # Assets and scripts
```

### 3. Access Your Site
- **Landing Page**: `yourdomain.com/landing/index.html`
- **Dashboard**: `yourdomain.com/dashboard.html`
- **Navigation**: `yourdomain.com/index.html`

### 4. Database Setup (Optional)
If using PHP features:
1. Create MySQL database in cPanel
2. Import `database.sql` file
3. Update database credentials in `inc/config.php`

### 5. Domain Configuration
- Set your main domain to point to `landing/index.html` for marketing
- Or use `index.html` as a navigation hub

## Features Included
- ✅ Responsive landing page
- ✅ Clean dashboard interface  
- ✅ Modern CSS styling
- ✅ PHP authentication system
- ✅ File upload functionality
- ✅ Subject management system

## Support
If you have issues, check that:
- All files uploaded correctly
- Database credentials are set (if using PHP)
- File permissions are correct (755 for directories, 644 for files)
