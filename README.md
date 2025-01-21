# Project Overview

This repository contains two separate projects:

1. **Frontend**
2. **Backend**

---

## Backend

The backend is built using **Laravel 11** with **PHP 8.2**.

### Installation and Setup

1. Navigate to the backend folder:

   ```bash
   cd backend
   ```

2. Update the `.env` file for the MySQL connection:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

3. Install the required dependencies:

   ```bash
   composer install
   ```

4. Run database migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

5. Start the server:

   ```bash
   php artisan serve
   ```

   The backend server will run on [127.0.0.1:8000](http://127.0.0.1:8000).

---

## Frontend

### Installation and Setup

1. Navigate to the frontend folder:

   ```bash
   cd frontend
   ```

2. Update the `.env` file for the API base URL:

   ```env
   VITE_API_BASE_URL=http://127.0.0.1:8000/api
   ```

3. Install the required dependencies:

   ```bash
   npm install
   ```

4. Start the development server:
   ```bash
   npm run dev
   ```

---

## API Documentation

The API documentation is available in the Postman collection file located in the root of the project:

`appleGadgetsAssignment.postman_collection.json`

You can import this file into Postman to explore and test the available APIs.

---

Happy coding!
