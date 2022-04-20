DROP DATABASE IF EXISTS shop_master;
CREATE DATABASE IF NOT EXISTS shop_master;

USE shop_master;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users
(
    id_user       int(255) auto_increment not null,
    name_user     varchar(100)            not null,
    lastName_user varchar(100),
    email_user    varchar(100)            not null,
    password_user varchar(100)            not null,
    rol_user      varchar(100),
    image_user    varchar(255),

    PRIMARY KEY (id_user),
    CONSTRAINT uq_email UNIQUE (email_user)
) ENGINE = InnoDb;

DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories
(
    id_category   int(255) AUTO_INCREMENT NOT NULL,
    name_category varchar(100)            NOT NULL,

    PRIMARY KEY (id_category)
) ENGINE = InnoDb;

DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products
(
    id_product          int(255) auto_increment not null,
    id_category_product int(255)                not null,
    name_product        varchar(100),
    description_product text                    not null,
    price_product       float(100, 3)           not null,
    stock_product       int(100)                not null,
    ofer_product        varchar(2)              not null,
    date_product        date                    not null,
    img_product         varchar(255)            not null,

    PRIMARY KEY (id_product),
    CONSTRAINT fk_category_product FOREIGN KEY (id_category_product) REFERENCES categories (id_category)
) ENGINE = InnoDb;

DROP TABLE IF EXISTS orders;
CREATE TABLE IF NOT EXISTS orders
(
    id_order        int(255) auto_increment not null,
    id_user_order   int(255)                not null,
    province_order  varchar(100)            not null,
    location_order  varchar(100)            not null,
    direction_order varchar(255)            not null,
    cost_order      float(200, 3)           not null,
    state_order     varchar(20)             not null,
    date_order      date                    not null,
    time_order      time                    not null,

    PRIMARY KEY (id_order),
    CONSTRAINT fk_user_order FOREIGN KEY (id_user_order) REFERENCES users (id_user)
) ENGINE = InnoDb;

DROP TABLE IF EXISTS line_products;
CREATE TABLE IF NOT EXISTS line_products
(
    id_line_products          int(255) auto_increment not null,
    id_order__line_products   int(255)                not null,
    id_product__line_products int(255)                not null,
    units_line_products       int(100)                not null,

    PRIMARY KEY (id_line_products),
    CONSTRAINT fk_order__line_products FOREIGN KEY (id_order__line_products) REFERENCES orders (id_order),
    CONSTRAINT fk_product__line_products FOREIGN KEY (id_product__line_products) REFERENCES products (id_product)
) ENGINE = InnoDb;

# $2y$04$XOMCcpttObxAaR.ESuON5u0RqyfhkRKflyz86k7kh/V78OAOgKTIe == 12345678

INSERT INTO `users`(`id_user`, `name_user`, `lastName_user`, `email_user`, `password_user`, `rol_user`, `image_user`)
VALUES (null, 'admin', 'admin', 'admin.admin@gmail.com', '$2y$04$XOMCcpttObxAaR.ESuON5u0RqyfhkRKflyz86k7kh/V78OAOgKTIe',
        '1', null);

INSERT INTO `categories`(`id_category`, `name_category`)
VALUES (null, 'camiseta'),
       (null, 'pantalon'),
       (null, 'calzado'),
       (null, 'accesorios')


