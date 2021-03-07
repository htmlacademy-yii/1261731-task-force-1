CREATE TABLE specializations (
    PRIMARY KEY (id),
    id                INT   UNSIGNED  NOT NULL AUTO_INCREMENT,
    name              CHAR (50)       NOT NULL,
                      UNIQUE (name)
);
CREATE TABLE locations (
    PRIMARY KEY (id),
    id                INT    UNSIGNED  NOT NULL  AUTO_INCREMENT,
    name              CHAR (50),
                      UNIQUE (name)
);
CREATE TABLE users (
    PRIMARY KEY (id),
    id                  INT   UNSIGNED NOT NULL AUTO_INCREMENT,
    name                CHAR (255)     NOT NULL,
    email               CHAR (255)     NOT NULL,
    password            CHAR (255)     NOT NULL,
    phone               CHAR (255),
    skype               CHAR (255),
    telegram            CHAR (255),
    notefecation        BIT,
    show_contacts       BIT,
    show_profile        BIT,
    specialization_id   INT   UNSIGNED NOT NULL,
    executor            BIT,
    location_id         INT   UNSIGNED,
                        UNIQUE (email),
                        FOREIGN KEY (specialization_id)  REFERENCES specializations (id),
                        FOREIGN KEY (location_id)        REFERENCES locations (id)
);
CREATE TABLE categories (
    PRIMARY KEY (id),
    id                INT    UNSIGNED NOT NULL AUTO_INCREMENT,
    name              CHAR (50)       NOT NULL,
                      UNIQUE (name)
);
CREATE TABLE statuses (
    PRIMARY KEY (id),
    id                 INT  UNSIGNED NOT NULL AUTO_INCREMENT,
    name               CHAR (255)    NOT NULL,
    symbol_code        CHAR (50)     NOT NULL,
                       UNIQUE (symbol_code),
                       UNIQUE (name)
);
CREATE TABLE tasks (
    PRIMARY KEY (id),
    id                INT   UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id           INT   UNSIGNED NOT NULL,
    title             TEXT           NOT NULL,
    description       TEXT           NOT NULL,
    category_id       INT   UNSIGNED NOT NULL,
    path_file         CHAR (255),
    location_id       INT   UNSIGNED,
    repayment         DECIMAL (12, 2),
    date_finished     DATETIME,
    status_id         INT  UNSIGNED  NOT NULL,
                      FOREIGN KEY (user_id)       REFERENCES users (id),
                      FOREIGN KEY (category_id)   REFERENCES categories (id),
                      FOREIGN KEY (location_id)   REFERENCES locations (id),
                      FOREIGN KEY (status_id)     REFERENCES statuses (id)
);
CREATE TABLE comments (
    PRIMARY KEY (id),
    id                 INT   UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id            INT   UNSIGNED NOT NULL,
    task_id            INT   UNSIGNED NOT NULL,
    comment            TEXT           NOT NULL,
    rating             INT   UNSIGNED,
                       FOREIGN KEY (user_id)              REFERENCES users (id),
                       FOREIGN KEY (task_id)              REFERENCES tasks (id)
);
CREATE TABLE responses (
    PRIMARY KEY (id),
    id                 INT   UNSIGNED NOT NULL  AUTO_INCREMENT,
    user_id            INT   UNSIGNED NOT NULL,
    task_id            INT   UNSIGNED NOT NULL,
    cost               DECIMAL (12, 2),
    comment            TEXT           NOT NULL,
                       FOREIGN KEY (user_id)      REFERENCES users (id),
                       FOREIGN KEY (task_id)      REFERENCES tasks (id)
);
CREATE TABLE chat (
    PRIMARY KEY (id),
    id                INT   UNSIGNED  NOT NULL   AUTO_INCREMENT,
    task_id           INT   UNSIGNED  NOT NULL,
    user_id           INT   UNSIGNED  NOT NULL,
                      FOREIGN KEY (task_id)     REFERENCES tasks (id),
                      FOREIGN KEY (user_id)     REFERENCES users (id)
);
CREATE TABLE chat_messages (
    PRIMARY KEY (id),
    id                 INT   UNSIGNED  NOT NULL   AUTO_INCREMENT,
    content            TEXT            NOT NULL,
    user_id            INT   UNSIGNED  NOT NULL,
    chat_id            INT   UNSIGNED  NOT NULL
);
