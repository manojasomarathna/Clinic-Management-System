🛠️ Step 1: Create Database
sql
Copy
Edit
CREATE DATABASE clinic_system_db;
USE clinic_system_db;
🧾 Step 2: Create Tables
🔹 patient Table
sql
Copy
Edit
CREATE TABLE patient (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(10) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    nic VARCHAR(15) NOT NULL UNIQUE,
    contact_number VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL
);
🔹 doctor Table
sql
Copy
Edit
CREATE TABLE doctor (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
🔹 appointment Table
sql
Copy
Edit
CREATE TABLE appointment (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status ENUM('Pending', 'Completed') NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patient(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES doctor(doctor_id)
);
📥 Step 3: Insert Sample Data
🔹 Sample patient Data
sql
Copy
Edit
INSERT INTO patient (title, first_name, last_name, nic, contact_number, address)
VALUES 
('Mr', 'Kamal', 'Perera', '991234567V', '0771234567', 'Colombo'),
('Mrs', 'Nimali', 'Silva', '982345678V', '0712345678', 'Kandy'),
('Miss', 'Sachini', 'Fernando', '200012345678', '0753456789', 'Galle');
🔹 Sample doctor Data
sql
Copy
Edit
INSERT INTO doctor (name)
VALUES 
('Dr. Anura Wijesinghe'),
('Dr. Malathi Gunasekara'),
('Dr. Roshan Senanayake');
🔹 Sample appointment Data
sql
Copy
Edit
INSERT INTO appointment (patient_id, doctor_id, appointment_date, appointment_time, status)
VALUES 
(1, 1, '2025-08-08', '09:00:00', 'Pending'),
(2, 2, '2025-08-08', '10:30:00', 'Completed'),
(3, 3, '2025-08-09', '11:15:00', 'Pending'),
(1, 2, '2025-08-10', '14:00:00', 'Completed');
✅ Now Your Database clinic_system_db Includes:
✔️ patient with 3 records

✔️ doctor with 3 records

✔️ appointment with 4 records linked via foreign keys

