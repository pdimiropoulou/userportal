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

`GET /api/application/getapplications.php/userid`

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

## Get user details

### Request

`GET /api/user/getuserbyid.php?id=20`

    curl --location --request GET 'http://localhost/userportal/api/user/getuserbyid.php?id=20'

### Response

    {
    "users": [
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
