<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## CRUD Application with Authentication

This project is a task management application where users can create and manage projects and tasks. Users can register, login, and see their own projects with tasks.

## Prerequisites

To work with this project locally, you will need to have the following tools installed:

- [PHP](https://www.php.net/downloads.php) (preferably version 8.0 or newer)
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/)
- [Postman](https://www.postman.com/)
  
## Setup Instructions
Clone the repository

1. Clone the repository to your local machine:
```bash
git clone https://github.com/yourusername/project-name.git
cd project-name
```

2. Install dependencies
Run the following commands to install the necessary dependencies:
```bash
composer install
```
3. Set up the environment
Copy the .env.example file to create your .env file:
```bash
cp .env.example .env
```
Configure the database settings in the .env file:
```bash
DB_CONNECTION=sqlite
DB_DATABASE=/path_to_your_database/database.sqlite
```

4. Migrate the database
Run the database migrations:
```bash
php artisan migrate
```

### API Endpoints
Authentication
- POST /api/register: Register a new user.
- POST /api/login: Login and get a JWT token for authentication.
  
Projects
- GET /api/projects: Get a list of all projects for the authenticated user.
- POST /api/projects: Create a new project.
- GET /api/projects/{id}: Get details of a specific project.
- PUT /api/projects/{id}: Update a project.
- DELETE /api/projects/{id}: Delete a project.
  
Tasks
- GET /api/tasks: Get tasks for the authenticated user.
- POST /api/tasks: Create a new task.
- GET /api/tasks/{id}: Get details of a specific task.
- PUT /api/tasks/{id}: Update a task.
- DELETE /api/tasks/{id}: Delete a task.

## Testing the API via Postman
To test the functionality of the API, you can use Postman.


Steps for User Authentication with JWT in Laravel:
1. Install JWT Package
```bash
composer require tymon/jwt-auth
```
2. Publish the Configuration File
```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
3. Generate the Secret Key
```bash
php artisan jwt:secret
```
4. Update .env file
```bash
JWT_SECRET=your-generated-secret-key
```
5. Testing the Registration via Postman:
  - Make a POST request to http://127.0.0.1:8000/api/register with the following JSON body:
```bash
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
6. Register the User:
  - Send a POST request to the /api/register endpoint with the registration details:
```bash
{
    "email": "jane.doe@example.com",
    "password": "password123"
}
```
If successful, you will receive a JWT token

Access Protected Routes:
 - To access any protected route (e.g., /api/projects), add the Authorization header in Postman with the value Bearer your_jwt_token_here.


Adding API Routes in Postman:
1. Open Postman and create a new Request.
2. Choose GET, POST, PUT, or DELETE depending on the method you are testing.
3. Enter the URL of the API. For example:
  - For the GET route for projects: http://127.0.0.1:8000/api/projects
  - For the POST route to add a project: http://127.0.0.1:8000/api/projects
4. If using POST or PUT, add Authorization (if required) and the Body with JSON data. Example:
```bash
{
    "name": "New Project",
    "description": "Description of the project"
}
```
5. If required, add Headers with:
- Content-Type: application/json
- Authorization: Bearer {Your JWT token} (if needed)

Example API Routes:
- GET http://127.0.0.1:8000/api/projects - Get all projects.
- POST http://127.0.0.1:8000/api/projects - Add a new project.
- PUT http://127.0.0.1:8000/api/projects/{id} - Update a project.
- DELETE http://127.0.0.1:8000/api/projects/{id} - Delete a project.
  

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
