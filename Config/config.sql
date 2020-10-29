CREATE OR REPLACE DATABASE PHP_CMC_WebApp CHARACTER SET utf8;
# SELECT PASSWORD('chung');
# CREATE USER 'CMC_WebApp_Admin'@'localhost' IDENTIFIED BY PASSWORD '*BC03F64DF81A600D52C12412D1D10C6A501CC6D2';
# GRANT USAGE ON . TO 'CMC_WebApp_Admin'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON php_cmc_webapp.* TO 'CMC_WebApp_Admin'@'localhost';

USE PHP_CMC_WebApp;
# CREATE TABLE users (
#     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
#     username VARCHAR(50) NOT NULL UNIQUE,
#     password VARCHAR(255) NOT NULL,
#     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
#     available_funds DECIMAL UNSIGNED DEFAULT 0
# ) ENGINE = InnoDB;
CREATE OR REPLACE TABLE users (
                                  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                  username varchar(50) NOT NULL UNIQUE,
                                  password varchar(255) NOT NULL ,
                                  email varchar(255) NOT NULL ,
                                  full_name varchar(255),
                                  image_path varchar(255),
                                  available_funds DECIMAL DEFAULT 0 CHECK ( available_funds >= 0 ),
                                  vip_status DATETIME,
                                  is_admin BOOLEAN default 0,
                                  timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARACTER SET = UTF8;
CREATE TABLE transactions (
                              id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                              source varchar(50) NOT NULL ,
                              destination varchar(50) NOT NULL ,
                              amount DECIMAL UNSIGNED NOT NULL CHECK ( amount > 0 ),
#     method varchar(20),
#     card_num varchar(20),
                              timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARACTER SET = UTF8;
CREATE TABLE orders (
                        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        user_id INT NOT NULL,
                        total DECIMAL NOT NULL DEFAULT 0,
                        description TEXT,
                        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY fk_orders_users (user_id) REFERENCES users(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = UTF8;
CREATE TABLE items (
                       id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                       name varchar(255) NOT NULL ,
                       description TEXT NOT NULL ,
                       available_quantity INT NOT NULL DEFAULT 0 CHECK ( available_quantity >= 0 ),
                       price DECIMAL UNSIGNED DEFAULT 0 CHECK ( price >= 0 ),
                       image_path varchar(500) DEFAULT ''
) ENGINE = InnoDB DEFAULT CHARACTER SET = UTF8;
CREATE TABLE orders_items (
                              id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                              order_id INT NOT NULL ,
                              item_id INT NOT NULL ,
                              quantity INT NOT NULL ,
                              applied_price DECIMAL NOT NULL ,
                              base_price DECIMAL NOT NULL ,
                              CONSTRAINT fk_orders_items_orders
                                  FOREIGN KEY (order_id) REFERENCES orders (id)
                                      ON UPDATE RESTRICT ,
                              CONSTRAINT fk_orders_items_items
                                  FOREIGN KEY (item_id) REFERENCES items (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = UTF8;
CREATE OR REPLACE TABLE cart_items (
                                       id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                       user_id INT,
                                       item_id INT,
                                       quantity INT CHECK ( quantity > 0 ),
                                       CONSTRAINT fk_cart_items_users
                                           FOREIGN KEY (user_id) REFERENCES users(id),
                                       CONSTRAINT fk_cart_items_items
                                           FOREIGN KEY (item_id) REFERENCES items(id)
)  ENGINE = InnoDB DEFAULT CHARACTER SET = UTF8;
INSERT INTO php_cmc_webapp.users (id, username, password, email, full_name, image_path, available_funds, vip_status, is_admin, timestamp) VALUES (1, 'admin', '$2y$10$v9gHFd9Jg9y5mwcQS2A3BuVM.BGbY/OmtYnrykyjaj3QCngI826Ay', '', '', '', 0, '2020-10-20 23:56:00', 0, '2020-10-20 16:30:31');
INSERT INTO items(name, description, available_quantity, price) VALUES ('Xe AirBlade', 'Xe này cho người nhỏ nhẹ', 50, 40000),
                                                                       ('Xe SH', 'Xe này khó to và rất thích hợp để đèo gái', 50, 80000),
                                                                       ('Mô tô R15', 'Xe này phóng rất mát tóc', 20, 98000);
# INSERT INTO transactions (from, to, amount) VALUES ('chung', 'bank', 500000);
INSERT INTO cart_items (user_id, item_id, quantity) VALUES (1, 1, 2),
                                                           (1, 2, 3);


# INSERT INTO transactions (from, to, amount) VALUES ('chung', 'bank', 200000);