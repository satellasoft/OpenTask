# Open Task

**Open Task** is an Open Source tool developed by **Gunnar Correa**, with it, it is possible to manage tasks, teams, upload files and images, create discussion forums within each task, among other operations.

Written in **PHP 7.2** and with **MariaDB** database.

The software was created with the intention of replacing some paid alternatives found in the market and also, bringing something modern and updated to the community. There are several similar tools, but with installation problems, legacy and unresponsive interface, little documentation, among other problems.

The installation requires a single initial configuration, and after that process, no further configuration or adjustment is necessary.

The only files that need to be changed are the .htaccess root and **App/Config/config.php**. It is also necessary to install the **MySQL/MariaDB** database and execute the insert to create a user with an administrator level.

# Database

I created a database for your application, here we will use the name **opentask**, as an example.

After creating the **opentask** database, copy the contents of the **Docs/Database/SQL.txt** file and run in your SGBD, but remember to select the **opentask** database.


**Important**

> Note that in the **SQL.txt** file, there are instructions pointing to the opentask database, if that is not the name of your database, then replace all occurrences of opentask for your database, ex: **opentask** => **mysite_opentask**.


With the database and tables installed, a username and password is required to access the system with an administrator level, so run the sql below.

```sql
INSERT INTO `user` (`id`, `us_name`, `us_email`, `us_login`, `us_password`, `us_permission`, `us_status`, `us_register`, `us_last_login`) VALUES
(4, 'Admin sys', 'admin@admin.com', 'admin.sys', '$2y$10$M.w36VNczE3Zbv29CE21TOmRKRCgCUtNnk86rVmdZTOM8eTdJcLM6', 1, 1, '2020-02-12 21:57:27', '0000-00-00 00:00:00');
```

**User:** admin.sys

**Password:** admin123

If everything has gone well so far, then your database settings and installations are complete.

# Configuring the application

The configuration on the server is very simple, let's start with .htaccess.

**.htaccess**

This file has some settings, among them and the main one, is to send the user to the public folder.

In **line 6**, we have the following code:

```
RewriteRule ^((?!public/).*)$ opentask/public/$1 [L,NC] 
```

Notice that we have the name opentask, which refers to the folder in which the project is located, so if your project is in root, just leave **public/**. If your project is in another directory, point the path to the public folder, such as: **myserver/opentask/public/**.

We just need to make this change, nothing else is needed in this file.
