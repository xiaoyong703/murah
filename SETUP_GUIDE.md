# Revision HQ - Setup Guide

## What's Fixed & Improved

### Critical Missing Components Added:
1. ✅ **Database Configuration** (`inc/config.php`) - Complete MySQL setup
2. ✅ **Complete Database Schema** (`database_complete.sql`) - All tables with proper relationships
3. ✅ **User Session Management** - Proper authentication and timeout handling
4. ✅ **File Upload Security** - Validation, sanitization, and .htaccess protection
5. ✅ **Flashcard System** - Complete CRUD operations
6. ✅ **User Subject Management** - Customizable subject layout per user
7. ✅ **Wallpaper System** - User-specific wallpaper uploads and management

### Security Enhancements:
- ✅ SQL injection protection with prepared statements
- ✅ File upload validation and type restrictions
- ✅ Script execution prevention in upload directories
- ✅ Session security with httponly cookies
- ✅ Input sanitization and validation

### Database Improvements:
- ✅ Added `user_subjects` table for customizable layouts
- ✅ Added `user_preferences` table for user settings
- ✅ Proper foreign key relationships and cascading deletes
- ✅ User data isolation - each user only sees their own content

## Installation Instructions

### 1. cPanel Setup
1. Upload all files to your cPanel public_html directory
2. Create a MySQL database through cPanel
3. Import `database_complete.sql` to create all required tables

### 2. Configuration
1. Edit `inc/config.php`:
   ```php
   $host = 'localhost';
   $dbname = 'your_database_name';
   $username = 'your_db_username';
   $password = 'your_db_password'; 
   ```

2. Set up Google OAuth:
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Create a new project or select existing
   - Enable Google Identity API
   - Create OAuth 2.0 credentials
   - Add your domain to authorized origins
   - Copy Client ID to `inc/config.php`:
   ```php
   define('GOOGLE_CLIENT_ID', 'your_actual_client_id_here');
   ```

### 3. Directory Permissions
Ensure these directories are writable (755 or 775):
- `/uploads/`
- `/media/wallpapers/`

### 4. File Structure
```
/
├── index.php                 # Login page with Google Sign-In
├── dashboard.php            # Main dashboard with user data
├── database_complete.sql    # Complete database schema
├── styles.css              # All CSS styling
├── script.js               # Main JavaScript
├── /inc/                   # PHP backend files
│   ├── config.php          # Database & Google config
│   ├── functions.php       # Helper functions
│   ├── auth.php           # Google authentication
│   ├── flashcards.php     # Flashcard CRUD
│   ├── upload_file.php    # File upload handler
│   ├── upload_wallpaper.php # Wallpaper upload
│   └── ...other endpoints
├── /subjects/             # Subject-specific pages
├── /uploads/             # User file uploads (secured)
├── /media/wallpapers/    # User wallpapers (secured)
└── /assets/             # JavaScript and static assets
```

## Key Features Working

### ✅ User Authentication
- Google Sign-In integration
- Secure session management
- User data isolation
- Automatic user creation

### ✅ Dashboard Features
- Personalized subject tiles
- Task management with database sync
- Quick notes with autosave
- Pomodoro timer
- Theme switching (light/dark)
- Custom wallpaper support

### ✅ Subject Pages
- File upload and management
- Flashcard creation and review
- Notes organization
- Subject-specific tools

### ✅ File Management
- Secure file uploads
- Type validation
- User-specific directories
- Download protection

### ✅ Database Integration
- Complete user data persistence
- Proper data relationships
- Secure queries with prepared statements
- User preference storage

## What Still Needs Implementation

### Frontend Enhancements:
- [ ] Drag-and-drop subject reordering
- [ ] Advanced flashcard review UI
- [ ] File preview functionality
- [ ] Mobile responsive improvements

### Subject-Specific Features:
- [ ] Math formula renderer
- [ ] Chemistry periodic table
- [ ] Code syntax highlighting
- [ ] Timeline views for History

### Advanced Features:
- [ ] Email notifications
- [ ] Calendar integration
- [ ] Study analytics
- [ ] Progress tracking

## Testing Your Installation

1. **Database Connection**: Check `inc/config.php` settings
2. **Google OAuth**: Verify Client ID is correctly set
3. **File Permissions**: Test file uploads work
4. **User Registration**: Try signing in with Google
5. **Data Persistence**: Create tasks, notes, flashcards

## Common Issues & Solutions

### Database Connection Fails
- Verify MySQL credentials in config.php
- Check if database exists
- Ensure MySQL service is running

### Google Sign-In Not Working  
- Verify Google Client ID is correct
- Check authorized domains in Google Console
- Ensure HTTPS is enabled (required for production)

### File Uploads Failing
- Check directory permissions (755/775)
- Verify file size limits
- Check .htaccess files are in place

### Session Issues
- Ensure cookies are enabled
- Check session configuration
- Verify HTTPS for secure cookies

This improved version provides a solid foundation for your Revision HQ application with proper security, database integration, and user management!