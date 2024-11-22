### README for `mygit` Project

---

## **MyGit Project**

The `mygit` project is a simple PHP application that connects to a MySQL database and displays data from a specified table in a beautifully formatted HTML table. This project demonstrates how to interact with a database, retrieve data, and present it in a clean and user-friendly way using PHP.

---

### **Features**
- Connects to a MySQL database using the `mysqli` extension.
- Retrieves data from a specified table.
- Displays the data in a well-structured HTML table.
- Handles empty table scenarios gracefully.
- Uses `htmlspecialchars()` to ensure data safety by preventing XSS attacks.

---

### **Project Setup**

#### **Prerequisites**
1. Docker with Docker Compose installed.
2. PHP environment for local testing (optional).
3. A MySQL database with the required table and data.

#### **Docker Compose Configuration**
Ensure you have the following `docker-compose.yml` file in your project:

```yaml
version: '3.8'

services:
  db:
    image: mysql:latest
    environment:
      - MYSQL_DATABASE=php_docker
      - MYSQL_USER=php_docker
      - MYSQL_PASSWORD=password
      - MYSQL_ROOT_PASSWORD=rootpassword
    ports:
      - 3306:3306

  phpadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - 8001:80
    environment:
      - PMA_HOST=db
      - PMA_PORT=3306
    depends_on:
      - db
```

---

### **Setting Up the PHP Application**

1. Clone the project repository:
   ```bash
   git clone https://github.com/your-username/mygit.git
   cd mygit
   ```

2. Place the following PHP code in your project directory as `index.php`:

   ```php
   <?php

   // Connect to the database
   $connect = mysqli_connect(
       'db', // Service name
       'php_docker', // Username
       'password', // Password
       'php_docker' // Database name
   );

   $table_name = "php_docker_table";

   // Query to fetch all data from the table
   $query = "SELECT * FROM $table_name";
   $response = mysqli_query($connect, $query);

   // Check if the query returned any rows
   if ($response && mysqli_num_rows($response) > 0) {
       echo "<h2>Data from <strong>$table_name</strong></h2>";
       
       // Start the table
       echo "<table border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
       echo "<thead>";
       echo "<tr>";
       echo "<th>Title</th>";
       echo "<th>Body</th>";
       echo "<th>Date Created</th>";
       echo "</tr>";
       echo "</thead>";
       echo "<tbody>";
       
       // Loop through and display each row
       while ($row = mysqli_fetch_assoc($response)) {
           echo "<tr>";
           echo "<td>" . htmlspecialchars($row['title']) . "</td>";
           echo "<td>" . htmlspecialchars($row['body']) . "</td>";
           echo "<td>" . htmlspecialchars($row['date_created']) . "</td>";
           echo "</tr>";
       }
       
       echo "</tbody>";
       echo "</table>";
   } else {
       echo "<p>No data found in <strong>$table_name</strong>.</p>";
   }

   // Close the database connection
   mysqli_close($connect);

   ?>
   ```

3. Start the application using Docker Compose:
   ```bash
   docker-compose up
   ```

4. Access the application in your browser at `http://localhost` (assuming your PHP service is configured to run on the default port).

---

### **Database Setup**

Ensure your MySQL database (`php_docker`) contains the following table structure:

```sql
CREATE TABLE php_docker_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Insert some sample data into the table:
```sql
INSERT INTO php_docker_table (title, body) VALUES
('Sample Title 1', 'Sample Body 1'),
('Sample Title 2', 'Sample Body 2');
```

---

### **Usage**

- Navigate to your browser at `http://localhost`.
- View the data in the `php_docker_table` displayed in a formatted HTML table.

---

### **Contributing**

Contributions are welcome! Feel free to fork this repository, make improvements, and submit a pull request.

---

### **License**

This project is open-source and licensed under the MIT License.

---

Enjoy using `mygit`! 😊
