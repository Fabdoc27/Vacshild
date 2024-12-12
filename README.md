# Vacshild - Vaccine Registration System

A application designed for efficient vaccine registration, scheduling, and status management. The system focuses on automation, offering features like user scheduling based on vaccine center capacities, real-time notifications, and an intuitive admin panel for easy record management.

## Features

-   **User Registration**: Register users and track their vaccine registration statuses.
-   **Vaccine Center Management**: Assign users to centers and track schedules.
-   **Automated Scheduling**: Automatically schedule users daily, respecting center limits and skipping weekends.
-   **Notifications**: Notify users about their schedules via email.
-   **Admin Panel**: Filter and manage records through a user-friendly interface powered by FilamentPHP.

## Getting Started

Follow these instructions to set up the project.

### Installation

1. **Clone the repository:**

    ```shell
    git clone "git@github.com:ashrafulbinharun/Vacshild.git"
    ```

2. **Navigate to the project directory:**

    ```shell
    cd "Vacshild"
    ```

3. **Install PHP dependencies:**

    ```shell
    composer install
    ```

4. **Install Node.js dependencies:**

    ```shell
    npm install
    ```

5. **Create the environment file:**

    ```shell
    cp .env.example .env
    ```

6. **Generate the application key:**

    ```shell
    php artisan key:generate
    ```

7. **Run database migrations:**

    ```shell
    php artisan migrate
    ```

8. **Seed the database:**

    ```shell
    php artisan db:seed
    ```

9. **Start the local development server:**

    ```shell
    php artisan serve
    ```

10. **Compile front-end assets:**

    ```shell
    npm run dev
    ```

11. **Start the queue worker:**

    ```shell
    php artisan queue:work
    ```

12. **Run the scheduler manually (for local development):**

    ```shell
    php artisan schedule:work
    ```
