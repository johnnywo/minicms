USE minicms;

CREATE TABLE language
(
    idlanguage INT(11) PRIMARY KEY NOT NULL,
    language VARCHAR(45)
);
CREATE TABLE page
(
    idpage INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    pagename VARCHAR(45)
);
CREATE TABLE page_has_language
(
    page_idpage INT(11) NOT NULL,
    language_idlanguage INT(11) NOT NULL,
    pl_title VARCHAR(45),
    pl_meta_description VARCHAR(255),
    pl_url VARCHAR(55),
    pl_h1 VARCHAR(45),
    pl_htmltext TEXT,
    pl_menu_link_title VARCHAR(55),
    pl_menu_link_main_menu TINYINT(1) DEFAULT '0',
    pl_menu_link_footer_menu TINYINT(1) DEFAULT '0',
    CONSTRAINT `PRIMARY` PRIMARY KEY (page_idpage, language_idlanguage),
    CONSTRAINT fk_content_has_language_content FOREIGN KEY (page_idpage) REFERENCES page (idpage),
    CONSTRAINT fk_content_has_language_language1 FOREIGN KEY (language_idlanguage) REFERENCES language (idlanguage)
);
CREATE INDEX fk_content_has_language_content_idx ON page_has_language (page_idpage);
CREATE INDEX fk_content_has_language_language1_idx ON page_has_language (language_idlanguage);
CREATE TABLE users
(
    user_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    user_email VARCHAR(60) NOT NULL,
    language_idlanguage INT(11) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    CONSTRAINT fk_users_language1 FOREIGN KEY (language_idlanguage) REFERENCES language (idlanguage)
);
CREATE UNIQUE INDEX email_UNIQUE ON users (user_email);
CREATE INDEX fk_users_language1_idx ON users (language_idlanguage);
CREATE UNIQUE INDEX user_name_UNIQUE ON users (user_name);