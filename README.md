# Pizza Delivery Project

This project is part of the Secure Programming course and aims to develop a secure web application for a pizza delivery service.

## Features

- User Registration and Login: Users can create an account and securely log in to the application.

- Menu: Users can view the available pizza menu.

- Order Placement: Users can select pizzas, specify delivery details, and place orders.

## Security Implementation

- Secure Authentication: User passwords are securely hashed and stored in the database.

- SQL Injection Prevention: Database queries are prepared using parameterized statements to prevent SQL injection attacks.

- Client-State Manipulation Prevention: User order is signed by the server and re-validated before accepted.
  
- Cross-Site Scripting (XSS) Prevention: User input is properly sanitized and validated to prevent XSS vulnerabilities.

- Cross-Site Request Forgery (CSRF) Protection: CSRF tokens are implemented to protect against CSRF attacks.

- Password Strength Validation: Passwords must meet specific complexity requirements to ensure strong security.

## Technologies Used

- PHP: The server-side scripting language used for the backend development.

- MySQL: The relational database management system used for storing user information and order details.

- HTML/CSS: Used for creating the user interface and styling the application.

- Xampp: Provide webserver and MySQL database
