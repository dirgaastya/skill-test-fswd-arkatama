CREATE DATABASE skill-test;
use skill-test;
CREATE TABLE data_pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    usia INT NOT NULL,
    kota VARCHAR(255) NOT NULL
);
