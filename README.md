# Superarse Conectados

This is a simple PHP MVC application that demonstrates the Model-View-Controller architecture. The application is structured to separate concerns, making it easier to manage and scale.

## Project Structure

```
my-php-mvc-app
├── app
│   ├── controllers
│   │   └── LoginController.php
|   |   └── ProgramasController.php
│   ├── helpers
│   │   └── View.php
│   ├── models
│   │   └── Database.php
│   └── views
│       └── informacion.php
│       └── login.php
├── assets
│   ├── logos
│   │   └── eLibro.png
|   |   └── logoSuperarse.png
│   │   └── office365.png
|   |   └── Q10.png
├── css
│   └── style.css
├── public
│   └── index.php
│   └── validarLogin.php
├── config
│   └── config.php
├── composer.json
├── composer.lock
└── .htaccess
└── README.md
```

## Features

- **MVC Architecture**: The application follows the MVC design pattern, separating the application logic into three interconnected components.
- **Database Connection**: The application includes a model for connecting to a MySQL database.
- **Routing**: The entry point of the application routes requests to the appropriate controller.

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd my-php-mvc-app
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```

## Configuration

Update the `config/config.php` file with your database connection parameters.

## Usage

To run the application, ensure you have a local server set up (e.g., Apache or Nginx) and point it to the `public` directory. Access the application through your web browser.

## License

This project is licensed under the MIT License.