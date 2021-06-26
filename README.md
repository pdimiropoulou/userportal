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
- Upon submitting the application, an email is sent to the portal administrator (administrator email cab be changed on https://github.com/pdimiropoulou/userportal/blob/main/sendemailsupervisor.php#L18)
![Alt text](/screenshots/adminemail.JPG?raw=true)
- The administrator clicks on one of the approve or reject links to mark the application accordingly and the employee is notified of the application outcome.
![Alt text](/screenshots/empemail.JPG?raw=true "Optional Title")

## Enhancements
