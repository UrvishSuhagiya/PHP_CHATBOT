# Chatbot README

## Overview

This chatbot is developed using PHP and MySQL, designed to interact with users and provide automated responses based on predefined queries. It can be integrated into various web applications and is scalable for future enhancements.

## Features

- User-friendly chat interface
- Responsive design
- Stores user queries and responses in a MySQL database
- Easy to extend with additional functionalities
- Basic natural language processing capabilities

## UI

<div style="display: flex; justify-content: space-around;">

  <img src="https://github.com/user-attachments/assets/cc26c109-01f7-418f-887f-36ebfafc32f6" alt="UI Screenshot 1" width="300"/>
  <img src="https://github.com/user-attachments/assets/cf804d97-4abe-4fd2-a709-a48d2e198c22" alt="UI Screenshot 2" width="300"/>
  <img src="https://github.com/user-attachments/assets/6e70c7e8-ac82-4695-ba1e-62aa2e492999" alt="UI Screenshot 3" width="300"/>

</div>

## Requirements

- PHP 7.0 or higher
- MySQL 5.7 or higher
- Web server (Apache or Nginx)
- Composer (for dependency management)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/chatbot.git
   cd chatbot

2. **Set Up XAMPP:**

    Download and install XAMPP if you haven't already.
    Start the Apache and MySQL modules from the XAMPP Control Panel.

3. **Move the Project to XAMPP Directory:**
  
    Copy the cloned chatbot folder to the htdocs directory of your XAMPP installation. This is usually located at C:\xampp\htdocs\.

4. **Create a Database:**

    Open your web browser and go to http://localhost/phpmyadmin.
    Click on "Databases" and create a new database (e.g., chatbot_db).
    Import the SQL file (if provided) to set up the necessary tables. You can do this by selecting the database, clicking on the "Import" tab, and uploading the SQL file.

5. **Run the Chatbot:**
  
    Open your web browser and navigate to http://localhost/chatbot (or the name of your project folder).
    You should see the chatbot interface, and you can start interacting with it.
