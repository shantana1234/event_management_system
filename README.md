Event Management System
This is a web-based Event Management System designed for managing events, attendees, and registrations. Users can create, view, and manage events while attendees can register for events.
Features
Event Creation: Admins and authenticated users can create, update, and delete events.
Event List: Displays a list of events along with details such as event name, date, description, and total attendees. All those tables are sortable, filtered and paginated.
Attendee Registration: Attendees can register for events. Defaults user role is “user”.
Event Status: Each event can be marked as "Draft" or "Publish".
Admin Dashboard: Admins have a dashboard to manage events, view event details, and see attendee information. Admins can download reports on- 
Events : all the events 
Specific Events details with attendee information
Search and Pagination: Users can search events by name or description and paginate the results.

Table of Contents
Installation
Configuration
Usage
API Endpoints

Installation
To install and set up the Event Management System locally, follow these steps:
1. Clone the Repository or Download from git 
git clone https://github.com/yourusername/event-management-system.git

2. Set Up Database
Create a MySQL database named event_management.
Run the SQL scripts in the database/ directory to create tables (events, event_attendees, users, etc.). The database is shared in- “database\”
3. Configure Database Connection
Update the database connection settings in the includes/config.php file:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

4. Install Dependencies
Ensure you have PHP and MySQL running.
No additional dependencies required for the core functionality.


Usage
1. Login and Dashboard:
Admins can log in with the credentials created in the users table.
Upon logging in, the admin can view, edit, or delete events, and manage attendees.

2. Event Registration:
Attendees can register for events through a simple registration form.
Registered attendees will be stored in the event_attendees table.
3. Attendee List:
Admins and the owner of the event can view and download a list of attendees for each event.

API Endpoints
1. Role : Admin 
     GET /all events
Fetch a list of all events 
http://eventsm.atwebpages.com/API/get_events.php 

    GET /events details with attendee list 
Fetch a list of all events details
http://eventsm.atwebpages.com/API/get_event_details.php?event_id=1  

Role : User 
     GET /all events of specific user
Fetch a list of all events 
http://eventsm.atwebpages.com/API/user/get_events.php?user_id=1 [ everyone will get diff API endpoint from there dashboard. ]

    GET /events details with attendee list 
Fetch a list of all events details
http://eventsm.atwebpages.com/API/user/get_events.php?user_id=1 

Login Credentials : 
Url : http://eventsm.atwebpages.com/
Admin : 
Email :  admin@gmail.com
Password :  Admin@100

User: 
Email : shantanamirdha2016@gmail.com
Password :  Password@100
