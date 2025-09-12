# NotiFyEd

**NotiFyEd** is a web-based notification management system designed to handle and display both general and personal notices for students and administrators. 
It allows role-based access, filtering notices based on class, email, and other criteria, and provides a responsive interface.

## 📂 Project Structure

NotiFyEd/
index.php # Main entry point for the application
README.md # Documentation file
.git/ # Git version control directory
hooks/ # Git hooks for commits, pushes, merges, etc.
info/ # Git info files
logs/ # Commit and reference logs
objects/ # Git object storage


## 🚀 Features

- Role-based access control (student/admin).
- General notices available to all users.
- Personal notices filtered by class and email for students.
- Responsive and user-friendly UI.
- PHP backend with MySQL database integration.
- Git version control for project management.

## 🛠️ Technologies Used

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP
- **Database:** MySQL
- **Version Control:** Git

## ⚙️ Installation & Setup

# 1. Clone the Repository
```bash
git clone https://github.com/Parth18022006/NotiFyEd.git
cd NotiFyEd

# 2. Set Up the Database
To set up the database for this project, follow the steps below:

Ensure that both Apache and MySQL services are running via XAMPP or WAMP.

Navigate to the includes/DB/ directory within your project folder and open the DB.sql file using any text editor.

Copy the entire SQL content from the DB.sql file.

Open your web browser and go to http://localhost/phpmyadmin.

In the left sidebar, click on "New", then click on the "SQL" tab.

Paste the copied SQL content into the SQL editor and click the "Go" button.

After the SQL script executes successfully, your database will be fully set up and ready for use by the application.

# 3. Configure Web Server
Place the project in your web server directory (e.g., htdocs for XAMPP or www for WAMP).

Start Apache and MySQL services.

# 4. Run the Application
Open your browser and navigate to:
http://localhost/NotiFyEd/index.php


📜 Usage
🎓 For Students:
Log in with your class and email credentials

View general and personal notices

🛠️ For Admins:
Add, edit, and manage notices

Access general announcements for all students.

📁 Included Files & Directories
index.php → Main homepage and routing logic

README.md → Project documentation

includes/DB/DB.sql → Database schema file

.git/ → Contains Git metadata and history


📄 License
This project is licensed under the MIT License — you are free to use, modify, and distribute it.

👤 Author
Made by Parth Chavda
Gmail: parth18chavda@gmail.com
For any feedback or queries, please feel free to reach out via GitHub or Gmail.





