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
