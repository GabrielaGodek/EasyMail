# EasyMail
This documentation outlines the functionality and implementation details of a PHP program designed to send emails with MySQL integration. The program involves three tables in the database: users, categories, and users_categories.

## Installation
1. Clone this repo: `https://github.com/GabrielaGodek/EasyMail.git`.
2. Open XAMPP and run `Apache Web Server` and `MySQL Database`. 
3. Open an type in the browser `localhost/phpmyadmin`.
4. Upload `easymail.sql` from src/db folder.
5. Open `http://localhost/php/projects/EasyMail/form.php` at your browser.

## Usage
1. Select category from dropdown menu.
2. Input the message.
3. Click "Send" to dispatch the message to users associated with the selected category.

### Additional information
1. For `cat_1` there are two suitable users.
2. For `cat_2` and `cat_3` there is only one.

## Preview
![Preview](/EasyMail/public/app_preview.png)
