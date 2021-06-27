# User Portal
## Introduction
You work for a company that has tripled in size over the past few years and the way
the vacation process works is no longer efficient, as it requires a combination of hand
written applications, approvals, storage and maintenance. You are asked to create a
portal where employees can request their vacation online, the manager receives a
notification to approve or decline that request, and the information (time used,
balances) are stored within the portal.

## Installation
You need to install the followings in order to run this repository:
- XAMMP 7.4.20  
    OR
- Apache
- PHP 7.4.20
- MariaDB 10.4.19


Put project folder under xammp/htdocs

# REST API

The REST API to the example app is described below.

## Login

### Request

`POST /login-registration-api/login.php`

    curl --location --request POST 'http://localhost/userportal/login-registration-api/login.php'
    --header 'Content-Type: application/json' 
    --data-raw '
    {
        "email":"sousourax@yahoo.com",
        "password":"12345678"
    }'

### Response

    {
        "success": 1,
        "message": "You have successfully logged in.",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL3BocF9hdXRoX2FwaVwvIiwiYXVkIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9waHBfYXV0aF9hcGlcLyIsImlhdCI6MTYyNDc4NDE0NywiZXhwIjoxNjI0Nzg3NzQ3LCJkYXRhIjp7InVzZXJfaWQiOiIyMCJ9fQ.X8IY5SKK16QKqNIP1ijouWbkdpBMsF0dGCcM4of1h-Q",
        "type": "Employee",
        "firstname": "Polina",
        "lastname": "Dimiropoulou",
        "id": "20"
    }

## Get list of user applications

### Request

`GET api/application/getapplications.php/userid`

    curl --location --request GET 'http://localhost/userportal/api/application/getapplications.php?userid=20'

### Response

    {
    "applications": [
        {
            "id": "95",
            "submission_date": "2021-06-26 16:02:18",
            "vacation_start": "2021-06-27",
            "vacation_end": "2021-06-28",
            "days": "1",
            "status": "Approved"
        },
        {
            "id": "94",
            "submission_date": "2021-06-26 15:19:59",
            "vacation_start": "2021-08-24",
            "vacation_end": "2021-08-26",
            "days": "2",
            "status": "Approved"
        },
        {
            "id": "92",
            "submission_date": "2021-06-26 14:21:14",
            "vacation_start": "2021-07-05",
            "vacation_end": "2021-07-08",
            "days": "3",
            "status": "Approved"
        },
        {
            "id": "91",
            "submission_date": "2021-06-26 14:18:22",
            "vacation_start": "2021-06-28",
            "vacation_end": "2021-06-30",
            "days": "2",
            "status": "Rejected"
        }
    ]
}

## Create a new application

### Request

`POST /api/application/create.php`

    curl --location --request POST 'http://localhost/userportal/api/application/create.php' 
    --header 'Content-Type: application/json' 
    --data-raw '{
    "vacation_start_date":"2021-06-28",
    "vacation_end_date":"2021-06-29",
    "reason":"Vacation",
    "user_id":20
    }'

### Response

    {"message": "application was created."}

## Update application status

### Request

`POST /api/application/update.php`

     curl --location --request POST 'http://localhost/userportal/api/application/update.php' 
    --header 'Content-Type: application/json' 
    --data-raw '
    {
        "id":11,
        "status":"Rejected"
    }'

### Response

    {"message": "application was updated."}


## Get users

### Request

`GET /api/user/getusers.php`

    curl --location --request GET 'http://localhost/userportal/api/user/getusers.php'

### Response

    {
    "users": [
        {
            "id": "21",
            "firstname": "Maria",
            "lastname": "Papadopoulou",
            "email": "polina.dimiropoulou@gmail.com",
            "type": "Administrator"
        },
        {
            "id": "22",
            "firstname": "Eleni",
            "lastname": "Oikonomou",
            "email": "eleni.oikonomou@mail.com",
            "type": "Employee"
        },
        {
            "id": "23",
            "firstname": "Maria",
            "lastname": "Oikonomou",
            "email": "maria.oik@mail.com",
            "type": "Employee"
        },
        {
            "id": "20",
            "firstname": "Polina",
            "lastname": "Dimiropoulou",
            "email": "sousourax@yahoo.com",
            "type": "Employee"
        }
    ]
}

## Create a new user

### Request

`POST /login-registration-api/register.php`

    curl --location --request POST 'http://localhost/userportal/login-registration-api/register.php' 
    --header 'Content-Type: application/json' 
    --data-raw '
    {
        "firstname":"Maria",
        "lastname":"Papadopoulou",
        "email":"polina.dimiropoulou@gmail.com",
        "password":"12345678",
        "type":"Administrator"
    }'

### Response

    {
        "success": 1,
        "status": 201,
        "message": "You have successfully registered."
    }

## Update user (under construction)

### Request

`POST /api/user/updateuser.php`

    curl --location --request POST 'http://localhost/userportal/api/user/updateuser.php'
    --header 'Content-Type: application/json' 
    --data-raw '{
        "firstname":"Μαρία",
        "lastname":"Παπαδοπούλου",
        "email":"polina.dim@yahoo.com",
        "id":"9",
        "type":"Administrator"
    }'

### Response

    {
        "success": 1,
        "status": 201,
        "message": "You have successfully registered."
    }


# User Navigation
- Visit  https://localhost/userportal/login.php in order to login in the portal by providing email and password.

![Alt text](/screenshots/login.JPG?raw=true )
- The user navigates to the welcome page based on the user type (Employee or Administrator)
- The employee welcome page has a list of past submitted applications, a submit request button and a sign out button.

![Alt text](/screenshots/emp_welcome.JPG?raw=true)
- By pressing submit request button the folllowing form appears for a new application.

![Alt text](/screenshots/applicationform.JPG?raw=true)
-  After the employee fills-in the fields and clicks on “submit”, he/she is taken
back to the list of applications.
-  After the employee fills-in the fields and clicks on “submit”, he/she is taken
back to the list of applications.
- Upon submitting the application, an email is sent to the portal administrator (administrator email cab be changed on https://github.com/pdimiropoulou/userportal/blob/main/sendemailsupervisor.php#L18).

![Alt text](/screenshots/adminemail.JPG?raw=true)
- The administrator clicks on one of the approve or reject links to mark the application accordingly and the employee is notified of the application outcome.

![Alt text](/screenshots/empemail.JPG?raw=true)

- The administrator welcome page has an editable list of users, a create button and a sign out button.

![Alt text](/screenshots/adm_welcome.JPG?raw=true)
- By pressing create user button the folllowing form appears for a new user.

![Alt text](/screenshots/createuser.JPG?raw=true)

- Clicking on the edit link on users lists, admin is being navigated to the
user properties page, which includes the same form as the “creation” page,
only this time all fields are pre-populated. The administrator can change the user’s properties by clicking on the update button. Please note that this functionality is not implemented due to an error on update api (https://github.com/pdimiropoulou/userportal/blob/main/api/user/updateuser.php). After clickin update button administrator navigates to users list.

![Alt text](/screenshots/udpateuser.JPG?raw=true)

## Enhancements
Additions for future work:
- Date validation on application form --> End date cannot be start date.
- Email validation on create user form --> Check that email format is valid.
- Password validation on create user form --> Check that password and retype password are the same.
- Create a 1:M table between  administrators and employees and retrieve supervisor email from the employee which submits the application.

## Email Setup
In this implementation Gmail setup is used for sending notifications. In order to achieve this the following configuration is needed:
- In \xampp\php\php.ini file find [mail function] and change

![Alt text](/screenshots/php.JPG?raw=true)
- Open \xampp\sendmail\sendmail.ini. Replace all the existing code in sendmail.ini with following code.

![Alt text](/screenshots/sendemail.JPG?raw=true)
- Go to your Gmail account under Security tab and allow Less secure app access.

## Database
In this reposiotry you can find the database schema and diagram at https://github.com/pdimiropoulou/userportal/blob/main/databaseschema.pdf 
and a dumb file of the database at https://github.com/pdimiropoulou/userportal/blob/main/demo.sql
