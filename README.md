# Expense Splitter

## Description

Expense Splitter is a web application designed to help groups of people split expenses equally. Users can create groups, add members, and track shared expenses. The app will automatically calculate how much each person should contribute based on the expenses added. It’s perfect for groups of friends, roommates, or anyone sharing costs.

## Features

- **Create a Group**: Allows users to create a group with a custom name.
- **Add Users**: Easily add members to the group by entering their usernames.
- **Add Expenses**: Record expenses and describe them, such as "Dinner" or "Transport".
- **Split Expenses**: Automatically splits the total expenses equally among all members of the group.
- **Clear Expenses**: Option to clear all added expenses and reset the group.
- **Responsive Design**: Optimized for both desktop and mobile devices.

## Technologies Used

- **Backend**: PHP (Laravel Framework)
- **Frontend**: HTML, CSS, TailwindCSS
- **Session Management**: Used to store group, user, and expense data.
- **Hosting**: Can be hosted on platforms like Heroku, DigitalOcean, or any PHP-supported hosting.

## Installation

### Prerequisites

- PHP 8.x or above
- Composer
- Laravel installed (can be installed via `composer create-project --prefer-dist laravel/laravel projectName`)

### Steps to Run Locally

1. **Clone the repository**:

    ```bash
    git clone https://github.com/akashgupta2233/expense-sharing-app.git
    ```

2. **Navigate into the project folder**:

    ```bash
    cd expense-splitter
    ```

3. **Install dependencies**:

    ```bash
    composer install
    ```

4. **Set up your environment file**:

    Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

5. **Generate the application key**:

    ```bash
    php artisan key:generate
    ```

6. **Run the server**:

    ```bash
    php artisan serve
    ```

    This will start the Laravel development server at `http://localhost:8000`.

7. **Access the app**:

    Open your browser and navigate to [http://localhost:8000](http://localhost:8000) to use the Expense Splitter.

## Usage

### Create a Group
1. Enter a name for your group in the input field and click the "Create Group" button.
2. The group name will appear at the top of the page.

### Add Users
1. Add members to your group by entering their usernames and clicking the "Add" button.
2. The users will appear below the form, and you can remove them if necessary.

### Add Expenses
1. Enter the expense amount and description, then click the "Add Expense" button.
2. Expenses are displayed in a table below the form.

### Split Expenses
1. After adding expenses, click the "Split Expense Equally" button.
2. The app will calculate how much each member needs to pay, which will be displayed below the button.

### Clear Expenses
1. If you want to reset the group, click the "Create New Group" button, which will clear all users, expenses, and reset the group.


