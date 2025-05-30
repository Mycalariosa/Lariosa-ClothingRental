# Lariosa Clothing Rental API

A Laravel-based API for managing a clothing rental system.

## API Documentation

### Postman Collection
You can access the complete API documentation and test the endpoints using our Postman collection:
[Lariosa Clothing Rental API Collection](https://mica-2659646.postman.co/workspace/Mica's-Workspace~c39c8dd5-9de0-47c0-8b87-5f0270815bf5/collection/44836484-6b03e79d-f6a0-441b-b559-0a3e5cea81a7?action=share&creator=44836484&active-environment=44836484-1711fb85-66b6-4add-9dbc-dc84affbe12b)

### Available Endpoints

#### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Login user
- `POST /api/logout` - Logout user (requires authentication)

#### Users
- `GET /api/get-users` - Get all users
- `POST /api/add-user` - Add new user
- `PUT /api/edit-user/{id}` - Edit user
- `DELETE /api/delete-user/{id}` - Delete user

#### Clothes
- `GET /api/clothes` - Get all clothes
- `POST /api/clothes` - Add new clothing item
- `PUT /api/clothes/{id}` - Edit clothing item
- `DELETE /api/clothes/{id}` - Delete clothing item

#### Rentals
- `GET /api/rentals` - Get all rentals
- `POST /api/rentals` - Create new rental
- `PUT /api/rentals/{id}` - Edit rental
- `DELETE /api/rentals/{id}` - Delete rental

#### Rental Statuses
- `GET /api/rental-statuses` - Get all rental statuses
- `POST /api/rental-statuses` - Add new rental status
- `PUT /api/rental-statuses/{id}` - Edit rental status
- `DELETE /api/rental-statuses/{id}` - Delete rental status

#### User Statuses
- `GET /api/user-statuses` - Get all user statuses
- `POST /api/user-statuses` - Add new user status
- `PUT /api/user-statuses/{id}` - Edit user status
- `DELETE /api/user-statuses/{id}` - Delete user status

## Setup Instructions

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy .env.example to .env and configure your database
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```

## Default Admin Account
- Email: admin@gmail.com
- Password: password

## Technologies Used
- Laravel 10
- MySQL
- PHP 8.1+
- Postman for API testing