Pharmacy Management System
Pharmacy Management System


The Pharmacy Management System is a web-based application designed to streamline the operations of a pharmacy. It includes features like medicine management, sales tracking, invoice generation, and reporting. Built with Laravel (PHP framework) and Tailwind CSS, this system is user-friendly, efficient, and scalable.

Features
1. Medicine Management
Add, update, and delete medicines.

Track stock levels and set reorder alerts.

Manage medicine categories and suppliers.

2. Sales Management
Record sales transactions.

Generate invoices for customers.

Track payment methods (Cash, Card, etc.).

3. User Roles
Admin: Full access to the system.

Cashier: Can manage sales and invoices.

Pharmacist: Can manage medicines and stock.

4. Reporting
Daily, weekly, and monthly sales reports.

Top-selling medicines report.

Low stock alerts and expired medicines report.

Sales by cashier and payment method reports.

5. Invoice Generation
Automatically generate and print invoices.

View purchase history for customers.

6. Security
User authentication and authorization.

Password hashing and secure sessions.

Technologies Used
Backend: Laravel (PHP)

Frontend: Tailwind CSS, Blade Templates

Database: MySQL

JavaScript: Vanilla JS (for interactivity)

Other Tools: Composer, npm

Installation
Follow these steps to set up the project locally:

Prerequisites
PHP >= 8.0

Composer

MySQL

Node.js and npm (for frontend dependencies)

Steps
Clone the Repository

bash
Copy
git clone https://github.com/your-username/pharmacy-management-system.git
cd pharmacy-management-system
Install PHP Dependencies

bash
Copy
composer install
Install JavaScript Dependencies

bash
Copy
npm install
npm run dev
Set Up Environment File

Copy .env.example to .env:

bash
Copy
cp .env.example .env
Update .env with your database credentials:

env
Copy
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
Generate Application Key

bash
Copy
php artisan key:generate
Run Migrations

bash
Copy
php artisan migrate --seed
Start the Development Server

bash
Copy
php artisan serve
Access the Application

Open your browser and go to http://localhost:8000.

Usage
Login

Use the following default credentials:

Admin: admin@example.com / password

Cashier: cashier@example.com / password

Pharmacist: pharmacist@example.com / password

Manage Medicines

Navigate to the "Medicines" section to add, update, or delete medicines.

Record Sales

Go to the "Sales" section to record new sales and generate invoices.

Generate Reports

Access the "Reports" section to view daily, weekly, or monthly sales reports.

Print Invoices

Click the "Print" button on the invoice page to print or save as PDF.

Screenshots
(Add screenshots of your application here. For example:)

Login Page:
Login Page

Dashboard:
Dashboard

Invoice Page:
Invoice Page

Contributing
Contributions are welcome! If you'd like to contribute, please follow these steps:

Fork the repository.

Create a new branch (git checkout -b feature/YourFeatureName).

Commit your changes (git commit -m 'Add some feature').

Push to the branch (git push origin feature/YourFeatureName).

Open a pull request.

License
This project is licensed under the MIT License. See the LICENSE file for details.

Acknowledgments
Laravel for the powerful PHP framework.

Tailwind CSS for the utility-first CSS framework.

npm for managing JavaScript dependencies.

Contact
For any questions or feedback, feel free to reach out:

Adhm Waleed 
Phone : 00967 773612111 - 00966599805306 
Email: adhmalslahy@gmail.com

GitHub: adhamstudy

Thank you for checking out the Pharmacy Management System! 🚀
