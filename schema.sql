CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE taskforce;
CREATE TABLE specializations (
    PRIMARY KEY (id),
    id                INT      UNSIGNED  NOT NULL AUTO_INCREMENT,
    name              VARCHAR (50)       NOT NULL,
    lat               VARCHAR (255)      NOT NULL,
    long              VARCHAR (255)      NOT NULL,
    created_at        TIMESTAMP          NOT NULL,
    updated_at        TIMESTAMP          NOT NULL,
                      UNIQUE (name)
);
CREATE TABLE cities (
    PRIMARY KEY (id),
    id                INT    UNSIGNED  NOT NULL  AUTO_INCREMENT,
    name              VARCHAR (50),
    created_at        TIMESTAMP          NOT NULL,
    updated_at        TIMESTAMP          NOT NULL
);
CREATE TABLE users (
    PRIMARY KEY (id),
    id                  INT      UNSIGNED NOT NULL AUTO_INCREMENT,
    name                VARCHAR (255)     NOT NULL,
    age                 INT      UNSIGNED NOT NULL,
    email               VARCHAR (255)     NOT NULL,
    password            VARCHAR (255)     NOT NULL,
    phone               VARCHAR (255),
    skype               VARCHAR (255),
    telegram            VARCHAR (255),
    photo               VARCHAR (255),
    is_notefecation_enabled        TINYINT(1),
    show_contacts       TINYINT(1),
    show_profile        TINYINT(1),
    city_id             INT   UNSIGNED,
    created_at          TIMESTAMP          NOT NULL,
    updated_at          TIMESTAMP          NOT NULL,
                        UNIQUE (email),
                        FOREIGN KEY (city_id)        REFERENCES cities (id)
);
CREATE TABLE photos_of_works (
    PRIMARY KEY (id),
    id               INT          UNSIGNED NOT NULL  AUTO_INCREMENT,
    path_file        VARCHAR (255),
    user_id          INT          UNSIGNED NOT NULL,
    created_at       TIMESTAMP               NOT NULL,
    updated_at       TIMESTAMP               NOT NULL,
                     FOREIGN KEY (user_id)  REFERENCES users (id)
);
CREATE TABLE specialization_user (
    PRIMARY KEY (specialization_id, user_id),
    specialization_id   INT      UNSIGNED NOT NULL,
    user_id             INT      UNSIGNED NOT NULL,
                        FOREIGN KEY (user_id)           REFERENCES users (id),
                        FOREIGN KEY (specialization_id) REFERENCES specializations (id)
);
CREATE TABLE categories (
    PRIMARY KEY (id),
    id                INT       UNSIGNED NOT NULL AUTO_INCREMENT,
    name              VARCHAR (50)       NOT NULL,
    created_at        TIMESTAMP          NOT NULL,
    updated_at        TIMESTAMP          NOT NULL,
                      UNIQUE (name)
);
CREATE TABLE tasks (
    PRIMARY KEY (id),
    id                INT          UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id           INT          UNSIGNED NOT NULL,
    title             TEXT                  NOT NULL,
    description       TEXT                  NOT NULL,
    category_id       INT          UNSIGNED NOT NULL,
    current_executor_id INT        UNSIGNED NOT NULL,
    status            VARCHAR (255)         NOT NULL,
    city_id           INT   UNSIGNED,
    latitude          INT   UNSIGNED,
    longitude         INT   UNSIGNED,
    budget            DECIMAL (12, 2),
    date_finished     DATETIME,
    created_at        TIMESTAMP               NOT NULL,
    updated_at        TIMESTAMP               NOT NULL,
                      FOREIGN KEY (user_id)       REFERENCES users (id),
                      FOREIGN KEY (category_id)   REFERENCES categories (id),
                      FOREIGN KEY (city_id)       REFERENCES cities (id),
                      FOREIGN KEY (current_executor_id) REFERENCES users (id)
);
CREATE TABLE files (
    PRIMARY KEY (id),
    id               INT          UNSIGNED NOT NULL  AUTO_INCREMENT,
    path_file        VARCHAR (255),
    task_id          INT          UNSIGNED NOT NULL,
    created_at       TIMESTAMP               NOT NULL,
    updated_at       TIMESTAMP               NOT NULL,
                     FOREIGN KEY (task_id)  REFERENCES tasks (id)
);
CREATE TABLE comments (
    PRIMARY KEY (id),
    id                 INT      UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id            INT      UNSIGNED NOT NULL,
    task_id            INT      UNSIGNED NOT NULL,
    comment            TEXT              NOT NULL,
    rating             INT   UNSIGNED,
    author_id         INT    UNSIGNED     NOT NULL,
    created_at         TIMESTAMP          NOT NULL,
    updated_at         TIMESTAMP          NOT NULL,
                       FOREIGN KEY (user_id)              REFERENCES users (id),
                       FOREIGN KEY (author_id)            REFERENCES users (id),
                       FOREIGN KEY (task_id)              REFERENCES tasks (id)
);
CREATE TABLE replies (
    PRIMARY KEY (id),
    id                 INT       UNSIGNED NOT NULL  AUTO_INCREMENT,
    user_id            INT       UNSIGNED NOT NULL,
    task_id            INT       UNSIGNED NOT NULL,
    cost               DECIMAL (12, 2),
    comment            TEXT               NOT NULL,
    created_at         TIMESTAMP          NOT NULL,
    updated_at         TIMESTAMP          NOT NULL,
                       FOREIGN KEY (user_id)      REFERENCES users (id),
                       FOREIGN KEY (task_id)      REFERENCES tasks (id)
);
CREATE TABLE actions_history (
    PRIMARY KEY (id),
    id                INT      UNSIGNED  NOT NULL  AUTO_INCREMENT,
    user_id           INT       UNSIGNED NOT NULL,
    action            VARCHAR (255),
    created_at        TIMESTAMP          NOT NULL,
    updated_at        TIMESTAMP          NOT NULL,
                      FOREIGN KEY (user_id)      REFERENCES users (id)
);
CREATE TABLE chats (
    PRIMARY KEY (id),
    id                INT    UNSIGNED     NOT NULL  AUTO_INCREMENT,
    name              VARCHAR(255)        NOT NULL,
    task_id           INT    UNSIGNED     NOT NULL,
    author_id         INT    UNSIGNED     NOT NULL,
    created_at        TIMESTAMP           NOT NULL,
    updated_at        TIMESTAMP           NOT NULL,
                      FOREIGN KEY (task_id)     REFERENCES tasks (id),
                      FOREIGN KEY (author_id)    REFERENCES users (id)
);
CREATE TABLE chat_user (
    PRIMARY KEY (chat_id, user_id),
    chat_id           INT    UNSIGNED     NOT NULL,
    user_id           INT    UNSIGNED     NOT NULL,
                      FOREIGN KEY (chat_id)      REFERENCES chats (id),
                      FOREIGN KEY (user_id)      REFERENCES users (id)
);
CREATE TABLE chat_messages (
    PRIMARY KEY (id),
    id                 INT    UNSIGNED    NOT NULL   AUTO_INCREMENT,
    content            TEXT               NOT NULL,
    user_id            INT    UNSIGNED    NOT NULL,
    chat_id            INT    UNSIGNED    NOT NULL,
    created_at         TIMESTAMP          NOT NULL,
    updated_at         TIMESTAMP          NOT NULL,
                       FOREIGN KEY (chat_id)    REFERENCES chats (id)
);
