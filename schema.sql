CREATE TABLE fleet (
  id INT AUTO_INCREMENT PRIMARY KEY,
  make VARCHAR(255) NOT NULL,
  model VARCHAR(255) NOT NULL,
  year INT NOT NULL,
  vin VARCHAR(255) NOT NULL
);

CREATE TABLE purchases (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehicle_id INT NOT NULL,
  date DATE NOT NULL,
  odometer INT NOT NULL,
  cost FLOAT NOT NULL,
  attributes VARCHAR(255) NOT NULL,
  product VARCHAR(255) NOT NULL,
  FOREIGN KEY (vehicle_id) REFERENCES fleet(id)
);

CREATE TABLE maintenance (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehicle_id INT NOT NULL,
  date DATE NOT NULL,
  odometer INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  cost FLOAT NOT NULL,
  type VARCHAR(255) NOT NULL,
  FOREIGN KEY (vehicle_id) REFERENCES fleet(id)
);

CREATE TABLE maintenance_intervals (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  vehicle_id INTEGER NOT NULL,
  maintenance_type VARCHAR(255) NOT NULL,
  start INTEGER NOT NULL,
  interval INTEGER NOT NULL
);

CREATE TABLE vehicle_documents (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  vehicle_id INTEGER NOT NULL,
  document_type VARCHAR(255) NOT NULL,
  file_name VARCHAR(255) NOT NULL
);

CREATE TABLE accidents (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  vehicle_id INTEGER NOT NULL,
  date DATE NOT NULL,
  location VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  cost DECIMAL(10, 2) NOT NULL
);
