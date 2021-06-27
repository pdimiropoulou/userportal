# User Portal

## Introduction
A portal where employees can request their vacation online, the manager receives a notification to approve or decline that request, and the information (time used, balances) are stored within the portal.

## Installation
Install the followings in order to run this project:
- XAMMP 7.4.20 or Apache
- PHP 7.4.20
- MariaDB 10.4.19

Copy the repo folder under `xammp/htdocs`.

You can find a database dumb file with sample data [here](demo.sql).

## Email Setup
In this implementation Gmail setup is used for sending notifications. In order to achieve this the following configuration is needed:
- In `\xampp\php\php.ini` file find `[mail function]` and change

![Alt text](/screenshots/php.JPG?raw=true)
- Open `\xampp\sendmail\sendmail.ini`. Replace all the existing code in `sendmail.ini` with the following code.

![Alt text](/screenshots/sendemail.JPG?raw=true)
- Go to your Gmail account under Security tab and allow Less secure app access.

## Documentation
- [API Documentation](/docs/api.md)
- [User Manual](/docs/user_manual.md)
- [Database Schema](/docs/databaseschema.pdf)

## Enhancements
Additions for future work:
- Date validation on application form --> End date cannot be previous to start date.
- Email validation on create user form --> Check that email doesn't exist.
- Email validation on create user form --> Check that email format is valid.
- Password validation on create user form --> Check that password format is valid.
- Password validation on create user form --> Check that password and retype password are the same.
- Use token returned from login api.
- Create a 1:M table between  administrators and employees and retrieve supervisor email from the employee which submits the application.
- Send email notifications asyncronous.
- Send a reminder email to the supervisor after two days, if application was not accepted/rejected from supervisor.


