# Dashboard - CRUD Operations with Spatie Role Permission Model

A comprehensive Laravel-based dashboard application implementing full CRUD (Create, Read, Update, Delete) operations with advanced role-based access control using the Spatie Laravel Permission package.

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [API Documentation](#api-documentation)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## 🎯 Overview

Dashboard is a modern web application that provides a robust foundation for managing user roles, permissions, and CRUD operations. Built with Laravel, it leverages the Spatie Laravel Permission package to implement enterprise-grade role-based access control (RBAC).

The application features an intuitive interface with a responsive design, allowing administrators to manage resources efficiently while maintaining strict security through granular permission controls.

## ✨ Features

- **Role-Based Access Control (RBAC)**: Manage user roles and permissions with fine-grained control
- **Complete CRUD Operations**: Create, read, update, and delete operations for all resources
- **User Management**: Comprehensive user administration panel
- **Permission Management**: Dynamic permission assignment and role creation
- **Responsive Dashboard**: Mobile-friendly interface with modern UI/UX
- **Authentication**: Secure user authentication and session management
- **Audit Trail**: Track user actions and changes (where applicable)
- **Database Migrations**: Version-controlled database schema
- **Blade Templating**: Server-side template rendering with Blade
- **JavaScript Interactivity**: Client-side validation and enhanced UX

## 🛠️ Tech Stack

| Component | Technology | Version |
|-----------|-----------|---------|
| **Backend** | Laravel | 8.x / 9.x |
| **Frontend** | Blade, JavaScript | Latest |
| **Styling** | SCSS, CSS | - |
| **Database** | MySQL / PostgreSQL | 5.7+ / 10+ |
| **Permission** | Spatie/Laravel-Permission | 5.x+ |
| **Package Manager** | Composer | Latest |

### Language Composition
- SCSS: 32.7%
- CSS: 32.3%
- JavaScript: 18%
- Blade: 9.5%
- PHP: 7.5%

## 📦 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP**: 7.4 or higher
- **Composer**: Latest version
- **Node.js**: 14.x or higher (for npm/yarn)
- **MySQL**: 5.7+ or PostgreSQL 10+
- **Git**: For version control
- **Laravel CLI**: (Optional but recommended)

### System Requirements
```
- RAM: Minimum 2GB
- Disk Space: Minimum 500MB
- CPU: Modern multi-core processor
```

## 🚀 Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/umairmujtaba987/Dashboard-.git
cd Dashboard-
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install Node Dependencies

```bash
npm install
# or
yarn install
```

### Step 4: Create Environment File

```bash
cp .env.example .env
```

### Step 5: Generate Application Key

```bash
php artisan key:generate
```

This command generates a unique application key for encryption.

### Step 6: Build Frontend Assets

```bash
npm run dev
# or for production
npm run build
```

## ⚙️ Configuration

### Database Configuration

Edit the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dashboard_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

**For PostgreSQL:**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dashboard_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Application Configuration

Update essential environment variables:

```env
APP_NAME="Dashboard"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@dashboard.local
```

## 📊 Database Setup

### Step 1: Create Database

```bash
# MySQL
mysql -u root -p
CREATE DATABASE dashboard_db;
EXIT;
```

### Step 2: Run Migrations

```bash
php artisan migrate
```

This command creates all necessary tables for the application.

### Step 3: Seed Database (Optional)

```bash
# Seed with default data
php artisan db:seed

# Or specific seeders
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=UsersTableSeeder
```

### Step 4: Verify Installation

```bash
php artisan tinker
# In Tinker shell:
>>> App\Models\User::count()
>>> Spatie\Permission\Models\Role::all()
```

## 💻 Usage

### Starting the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### Default Credentials

After running seeders, use these credentials:

```
Email: admin@dashboard.local
Password: password
```

**⚠️ Important**: Change these credentials in production!

### Creating Roles and Permissions

**Via Artisan Command:**
```bash
php artisan permission:create-role admin
php artisan permission:create-permission create_users
php artisan permission:assign-permission create_users admin
```

**Programmatically:**
```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

$role = Role::create(['name' => 'editor']);
$permission = Permission::create(['name' => 'edit_posts']);
$role->givePermissionTo($permission);
```

### Assigning Roles to Users

**Via Web Interface:**
1. Navigate to Admin Panel → Users
2. Select a user
3. Assign roles from the dropdown

**Programmatically:**
```php
$user = User::find(1);
$user->assignRole('admin');
```

### Protecting Routes

```php
// In routes/web.php or routes/api.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

// Or with specific permissions
Route::middleware(['auth', 'permission:edit_users'])->group(function () {
    Route::put('/users/{user}', [UserController::class, 'update']);
});
```

## 📁 Project Structure

```
Dashboard-/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Application controllers
│   │   └── Middleware/      # Custom middleware
│   ├── Models/              # Eloquent models
│   └── Services/            # Business logic services
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/             # Database seeders
│   └── factories/           # Model factories
├── public/
│   ├── css/                 # Compiled CSS files
│   ├── js/                  # Compiled JavaScript files
│   └── images/              # Static images
├── resources/
│   ├── views/               # Blade templates
│   │   ├── auth/            # Authentication views
│   │   ├── dashboard/       # Dashboard views
│   │   └── layouts/         # Layout templates
│   ├── sass/                # SCSS source files
│   ├── css/                 # CSS source files
│   └── js/                  # JavaScript source files
├── routes/
│   ├── web.php              # Web routes
│   └── api.php              # API routes
├── config/
│   ├── app.php              # Application config
│   └── permission.php       # Permission config
├── .env.example             # Environment template
├── composer.json            # PHP dependencies
├── package.json             # Node dependencies
└── webpack.mix.js           # Asset compilation
```

## 📡 API Documentation

### Authentication Endpoints

```
POST   /api/login              - User login
POST   /api/logout             - User logout
POST   /api/register           - User registration
POST   /api/password/forgot    - Request password reset
```

### User Management

```
GET    /api/users              - List all users (admin only)
GET    /api/users/{id}         - Get user details
POST   /api/users              - Create new user (admin only)
PUT    /api/users/{id}         - Update user (admin only)
DELETE /api/users/{id}         - Delete user (admin only)
```

### Role Management

```
GET    /api/roles              - List all roles
POST   /api/roles              - Create new role (admin only)
PUT    /api/roles/{id}         - Update role (admin only)
DELETE /api/roles/{id}         - Delete role (admin only)
```

### Permission Management

```
GET    /api/permissions        - List all permissions
POST   /api/permissions        - Create new permission (admin only)
```

## 🔧 Troubleshooting

### Common Issues and Solutions

#### 1. **"No Application Encryption Key" Error**

```bash
php artisan key:generate
```

#### 2. **Database Connection Error**

- Verify `.env` database credentials
- Ensure database server is running
- Check database exists: `mysql -u root -p -e "SHOW DATABASES;"`

#### 3. **Permission Denied Errors**

```bash
# Set proper permissions
chmod -R 775 storage bootstrap/cache
# Or on Windows, use file properties to grant permissions
```

#### 4. **Asset Files Not Loading**

```bash
npm run dev
php artisan storage:link
```

#### 5. **Migrations Fail**

```bash
# Reset and remigrate (caution: deletes data)
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

#### 6. **Class Not Found Error**

```bash
composer dump-autoload
php artisan config:clear
```

#### 7. **Permission Cache Issues**

```bash
php artisan permission:cache-reset
```

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/UserControllerTest.php

# With coverage report
php artisan test --coverage
```

## 📝 Environment Variables Reference

| Variable | Description | Example |
|----------|-------------|---------|
| `APP_NAME` | Application name | Dashboard |
| `APP_ENV` | Environment type | local, production |
| `APP_DEBUG` | Debug mode | true, false |
| `APP_URL` | Application URL | http://localhost:8000 |
| `DB_CONNECTION` | Database driver | mysql, pgsql |
| `CACHE_DRIVER` | Cache driver | file, redis |

## 🔒 Security Considerations

- **Never commit `.env` file** to version control
- **Use strong database passwords** in production
- **Enable HTTPS** in production environments
- **Regularly update** dependencies: `composer update`
- **Implement rate limiting** for API endpoints
- **Use environment-specific configs** for sensitive data
- **Validate all user inputs** on server-side
- **Keep Laravel and packages updated**

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction)
- [Laravel Blade Templating](https://laravel.com/docs/blade)
- [Laravel Migrations](https://laravel.com/docs/migrations)

## 🐛 Bug Reports

Found a bug? Please create an issue with:
- Clear description of the issue
- Steps to reproduce
- Expected vs. actual behavior
- Screenshots or error logs
- Environment details (PHP version, OS, etc.)

## 💡 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

### Code Standards
- Follow PSR-12 PHP coding standards
- Use meaningful variable and function names
- Add comments for complex logic
- Write tests for new features

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 👨‍💼 Author

**Umair Mujtaba**
- GitHub: [@umairmujtaba987](https://github.com/umairmujtaba987)
- Email: [your-email@example.com]

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com)
- [Spatie Laravel Permission](https://spatie.be)
- [Bootstrap](https://getbootstrap.com)
- Community contributors

---

## 📞 Support

For support, email [support@dashboard.local] or open an issue on [GitHub Issues](https://github.com/umairmujtaba987/Dashboard-/issues).

### Last Updated
- Date: 2026-05-13
- Version: 1.0.0

---

**Made with ❤️ by Umair Mujtaba**
