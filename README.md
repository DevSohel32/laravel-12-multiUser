# Laravel 12 Multi-User Application

A comprehensive multi-user application built with Laravel 12, featuring separate Admin and User authentication systems, role-based access control, and modern database architecture.

## Features

- **Multi-User Support**: Separate user and admin authentication systems
- **Role-Based Access Control**: Admin roles include super_admin, admin, moderator, and support
- **Admin Dashboard**: Comprehensive admin panel with user management capabilities
- **Secure Authentication**: Password hashing with Laravel's built-in security
- **Database Migrations**: Well-structured database schema with comprehensive fields
- **User Permissions**: Granular permission system for fine-grained access control
- **Activity Tracking**: Track admin login attempts and last login timestamps
- **Soft Deletes**: Non-destructive deletion of records
- **Modern UI**: Bootstrap-based responsive design

## Project Structure

```
├── app/
│   ├── Models/
│   │   ├── Admin.php           # Admin model with permissions
│   │   └── User.php            # User model
│   └── Http/
│       └── Controllers/
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   └── 2026_01_18_000000_create_admins_table.php
│   └── seeders/
│       ├── AdminSeeder.php     # Seed admin users
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
├── routes/
│   └── web.php                # Application routes
└── config/
    └── auth.php               # Authentication configuration
```

## Installation

1. **Clone the repository**
```bash
git clone https://github.com/DevSohel32/laravel-12-multiUser.git
cd laravel-12-multiUser
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=multiuser
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations and seeders**
```bash
php artisan migrate
php artisan db:seed
```

## Database Schema

### Users Table
- id, name, email, password
- phone, address, city, state, country, zip
- photo, token, status
- timestamps

### Admins Table
- id, name, email, password
- phone, photo, role, status
- permissions (JSON), email_verified_at
- last_login_at, login_attempts
- notes, token
- timestamps with soft deletes

## Default Admin Credentials

After running the seeder, use these credentials to login:

- **Email**: `admin@gmail.com`
- **Password**: `12345`
- **Role**: Super Admin

## API Routes

### Admin Routes
- `GET /admin/login` - Show login form
- `POST /admin/login` - Process login
- `GET /admin/dashboard` - Admin dashboard (protected)
- `POST /admin/logout` - Logout

## Models

### Admin Model
```php
// Check if admin has specific role
$admin->hasRole('super_admin');

// Check if admin has specific permission
$admin->hasPermission('manage_users');

// Get active admins
Admin::active()->get();

// Get admins by role
Admin::byRole('moderator')->get();
```

### User Model
Fillable fields include all user table columns for mass assignment.

## Configuration

### Authentication Guards
The application uses custom authentication guards for separate admin and user authentication configured in `config/auth.php`.

### Permissions
Permissions are stored as JSON arrays in the admins table:
```php
'permissions' => ['read', 'write', 'delete', 'manage_users', 'manage_admins']
```

## Development

### Available Commands
```bash
# Run migrations
php artisan migrate

# Refresh migrations with seeders
php artisan migrate:refresh --seed

# Create admin seeder
php artisan make:seeder AdminSeeder

# Run tests
php artisan test
```

### Build Assets
```bash
npm run dev      # Development
npm run build    # Production
```

## Technologies Used

- **Framework**: Laravel 12
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Templates
- **Authentication**: Laravel Built-in Authentication
- **ORM**: Eloquent

## Future Enhancements

- [ ] User registration and email verification
- [ ] Two-factor authentication
- [ ] API token-based authentication
- [ ] Advanced admin dashboard with analytics
- [ ] User role-based system
- [ ] Activity logging system
- [ ] Email notifications

## Security

- All passwords are hashed using bcrypt
- CSRF protection enabled on all forms
- SQL injection protection via Eloquent ORM
- XSS protection through Blade templating
- Mass assignment protection with $fillable

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Author

**Dev Sohel**
- GitHub: [@DevSohel32](https://github.com/DevSohel32)

## Support

For support, email contact@example.com or open an issue on GitHub.

## Changelog

### Version 1.0.0 (January 18, 2026)
- Initial release
- Admin and User models
- Multi-user authentication system
- Role-based access control
- Database migrations and seeders


In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
