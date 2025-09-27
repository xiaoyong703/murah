# RevisionHQ Project Structure

## 📁 Project Organization

### 🏠 Landing Page (`/landing/`)
- `index.html` - Homepage with beautiful gradient design
- `auth.php` - Authentication handler for login/signup

### 📱 Main Application (`/`)
- `dashboard.php` - Main study dashboard
- `dashboard.html` - Dashboard HTML version
- All other app functionality files

### 📂 Supporting Folders
- `inc/` - PHP includes and functions
- `subjects/` - Subject-specific pages
- `media/` - Images and media files
- `uploads/` - User uploaded files

## 🚀 Access URLs

### Landing Page
- **Homepage**: `http://localhost:8000/landing/`
- **Direct**: `http://localhost:8000/landing/index.html`

### Main App
- **Dashboard**: `http://localhost:8000/dashboard.php`
- **Other features**: `http://localhost:8000/[filename]`

## 📋 Quick Start
1. Start server: `php -S localhost:8000`
2. Visit homepage: `http://localhost:8000/landing/`
3. Click "Get Started" to test login flow
4. Access dashboard and other features from root

This structure keeps the landing page separate and organized!