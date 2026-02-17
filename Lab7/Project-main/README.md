# Project 5 (Secure) - Student Management System

Owner: monib elfadil sw

## Features
- Sign up
- Log in / Log out
- CRUD operations for Students
- Protected pages using **Sessions + Cookies**
- Protected against **SQL Injection** using **Prepared Statements**

## Requirements
- XAMPP (Apache + MySQL) or any PHP + MySQL environment
- PHP 7.4+ (PHP 8+ recommended)

## Setup (Local)
1. Start **Apache** and **MySQL** in XAMPP.
2. Create DB + tables:
   - Open phpMyAdmin
   - Run the SQL inside `database.sql`
3. Put the project folder inside:
   - `C:\xampp\htdocs\Project5Secure\`
4. Open in browser:
   - `http://localhost/Project5Secure/login.php`

## Default Accounts
Create your account via `signup.php`.
(Optionally, create an admin user by signing up with username `admin`.)

## Upload to GitHub
```bash
git init
git add .
git commit -m "Project 5 secure student management system"
git branch -M main
git remote add origin https://github.com/<YOUR_USERNAME>/<REPO_NAME>.git
git push -u origin main
```
