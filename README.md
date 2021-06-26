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
- PHP 7.4.20
- MariaDB 10.4.19
Put project folder under xammp/htdocs

## User Navigation
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
- 
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
- Create a 1:M table between  administrators and employees and retrieve supervisor email from the employee which submits the application.

## Email Setup
In this implementation Gmail setup is used for sending notifications. In order to achieve this the following configuration is needed:
- In \xampp\php\php.ini file find [mail function] and change

![Alt text](/screenshots/php.JPG?raw=true)
- Open \xampp\sendmail\sendmail.ini. Replace all the existing code in sendmail.ini with following code.

![Alt text](/screenshots/sendemail.JPG?raw=true)
- Go to your Gmail account under Security tab and allow Less secure app access.
