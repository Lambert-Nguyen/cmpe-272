# CMPE 272 PHP Web Application

A PHP web application built with custom MVC architecture for deployment on Render, featuring user management with MySQL database integration.

**Created by:** Lam Nguyen  
**Course:** CMPE 272  
**Professor:** Prof. Richard Sinn  
**University:** San Jose State University

## Features

- **Custom MVC Framework**: Clean separation of concerns with Models, Views, and Controllers
- **User Management**: Complete CRUD operations for user management
- **MySQL Integration**: Database operations using PDO with prepared statements
- **Responsive Design**: Bootstrap 5 for modern, mobile-friendly UI
- **Environment Configuration**: Uses environment variables for secure deployment
- **Render Ready**: Optimized for deployment on Render platform

## Project Structure

```
cmpe-272/
├── config/
│   ├── Database.php          # Database connection class
│   └── Router.php            # URL routing system
├── src/
│   ├── Controllers/
│   │   ├── Controller.php    # Base controller class
│   │   ├── HomeController.php
│   │   └── UserController.php
│   ├── Models/
│   │   ├── Model.php         # Base model class
│   │   └── User.php          # User model with CRUD operations
│   └── Views/
│       ├── layouts/
│       │   └── main.php      # Main layout template
│       ├── home/
│       │   ├── index.php     # Homepage view
│       │   └── about.php     # About page view
│       └── users/
│           ├── index.php     # User list view
│           ├── create.php    # Create user form
│           ├── edit.php      # Edit user form
│           └── show.php      # User details view
├── public/
│   ├── css/
│   │   └── style.css         # Custom styles
│   └── index.php             # Application entry point
├── database/
│   └── schema.sql            # Database schema and sample data
├── .env.example              # Environment variables template
├── .gitignore                # Git ignore rules
├── composer.json             # Composer dependencies
└── README.md                 # This file
```

## Technology Stack

### Backend
- PHP 8.0+
- PDO for database operations
- Custom MVC pattern
- Environment-based configuration

### Frontend
- Bootstrap 5
- Responsive design
- Modern UI components
- Custom CSS styling

### Database
- MySQL 8.0+
- Users table with CRUD operations
- Prepared statements for security

## Local Development Setup

### Prerequisites
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Composer (optional, for dependency management)

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd cmpe-272
   ```

2. **Set up the database**
   ```bash
   # Create database
   mysql -u root -p -e "CREATE DATABASE cmpe272_app;"
   
   # Import schema
   mysql -u root -p cmpe272_app < database/schema.sql
   ```

3. **Configure environment variables**
   ```bash
   # Copy the example environment file
   cp .env.example .env
   
   # Edit .env with your database credentials
   # DB_HOST=localhost
   # DB_PORT=3306
   # DB_NAME=cmpe272_app
   # DB_USER=root
   # DB_PASSWORD=your_password
   ```

4. **Start the development server**
   ```bash
   # Using PHP built-in server
   php -S localhost:8000 -t public
   
   # Or using Composer script
   composer start
   ```

5. **Access the application**
   Open your browser and navigate to `http://localhost:8000`

## Deployment on Render

### Step 1: Prepare Your Repository

1. **Push your code to GitHub**
   ```bash
   git add .
   git commit -m "Initial commit"
   git push origin main
   ```

### Step 2: Set Up MySQL Database on Render

1. **Create a new MySQL database**
   - Go to [Render Dashboard](https://dashboard.render.com)
   - Click "New +" → "PostgreSQL" (Note: Render doesn't offer managed MySQL, use PostgreSQL or external MySQL)
   - For MySQL, consider using [PlanetScale](https://planetscale.com/) or [AWS RDS](https://aws.amazon.com/rds/)

2. **Alternative: Use PostgreSQL on Render**
   - Modify `config/Database.php` to use PostgreSQL instead of MySQL
   - Update the DSN to use `pgsql:` instead of `mysql:`
   - Update `database/schema.sql` for PostgreSQL syntax

3. **External MySQL Setup (Recommended)**
   - Use [PlanetScale](https://planetscale.com/) (Free tier available)
   - Or use [Railway](https://railway.app/) MySQL
   - Or use [DigitalOcean Managed Databases](https://www.digitalocean.com/products/managed-databases/)

### Step 3: Deploy Web Service on Render

1. **Create a new Web Service**
   - Go to Render Dashboard
   - Click "New +" → "Web Service"
   - Connect your GitHub repository

2. **Configure the service**
   ```
   Name: cmpe272-php-app
   Environment: Docker
   Region: Choose closest to your users
   Branch: main
   Root Directory: (leave empty)
   Build Command: (leave empty)
   Start Command: (leave empty - will use default PHP server)
   ```

3. **Create Dockerfile**
   Create a `Dockerfile` in your project root:
   ```dockerfile
   FROM php:8.1-apache
   
   # Enable necessary PHP extensions
   RUN docker-php-ext-install pdo pdo_mysql
   
   # Copy application files
   COPY . /var/www/html/
   
   # Set document root to public directory
   RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
   
   # Enable mod_rewrite
   RUN a2enmod rewrite
   
   # Set proper permissions
   RUN chown -R www-data:www-data /var/www/html
   RUN chmod -R 755 /var/www/html
   
   EXPOSE 80
   ```

### Step 4: Configure Environment Variables

In your Render web service settings, add these environment variables:

```
DB_HOST=your_database_host
DB_PORT=3306
DB_NAME=your_database_name  
DB_USER=your_database_user
DB_PASSWORD=your_database_password
APP_ENV=production
```

### Step 5: Database Setup

1. **Import schema to your production database**
   ```bash
   # For PlanetScale or external MySQL
   mysql -h your_host -P 3306 -u your_user -p your_database < database/schema.sql
   ```

2. **For PostgreSQL (if using Render's PostgreSQL)**
   - Convert the MySQL schema to PostgreSQL syntax
   - Update the schema file for PostgreSQL compatibility

### Step 6: Deploy

1. **Deploy the service**
   - Render will automatically detect changes and deploy
   - Monitor the deploy logs for any issues

2. **Test the deployment**
   - Once deployed, test all functionality:
     - Homepage loads correctly
     - User list displays
     - CRUD operations work
     - Database connectivity is working

## Environment Variables

| Variable | Description | Required |
|----------|-------------|----------|
| `DB_HOST` | Database hostname | Yes |
| `DB_PORT` | Database port (usually 3306) | Yes |
| `DB_NAME` | Database name | Yes |
| `DB_USER` | Database username | Yes |
| `DB_PASSWORD` | Database password | Yes |
| `APP_ENV` | Application environment (development/production) | No |

## Available Routes

| Method | Route | Description |
|--------|-------|-------------|
| GET | `/` | Homepage with welcome message |
| GET | `/about` | About page |
| GET | `/users` | List all users |
| GET | `/users/create` | Show create user form |
| POST | `/users/create` | Create new user |
| GET | `/users/show?id={id}` | Show user details |
| GET | `/users/edit?id={id}` | Show edit user form |
| POST | `/users/edit?id={id}` | Update user |
| POST | `/users/delete` | Delete user |

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Security Features

- **Prepared Statements**: All database queries use prepared statements to prevent SQL injection
- **Input Validation**: Server-side validation for all user inputs
- **XSS Protection**: All user data is properly escaped in views
- **Environment Variables**: Sensitive configuration data stored in environment variables
- **Error Handling**: Graceful error handling with user-friendly messages

## Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check environment variables are set correctly
   - Verify database server is accessible
   - Check credentials and permissions

2. **404 Errors**
   - Ensure Apache mod_rewrite is enabled
   - Check .htaccess configuration if using Apache
   - Verify routes are properly defined

3. **Permission Errors**
   - Check file permissions are set correctly
   - Ensure web server can read/write necessary directories

4. **PHP Errors**
   - Check PHP version compatibility (requires PHP 8.0+)
   - Verify required PHP extensions are installed (PDO, PDO_MySQL)

### Debug Mode

For local development, set `APP_ENV=development` to enable:
- Detailed error messages
- Error stack traces
- Debug information

For production, set `APP_ENV=production` to:
- Hide detailed error messages
- Log errors to files
- Optimize for performance

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is created for educational purposes as part of CMPE 272 coursework at San Jose State University.

## Contact

**Lam Nguyen**  
San Jose State University  
CMPE 272 - Enterprise Software Platforms  
Instructor: Prof. Richard Sinn
