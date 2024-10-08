#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: USER
#------------------------------------------------------------

CREATE TABLE USER(
        id_user        Int  Auto_increment  NOT NULL ,
        firstname_user Varchar (50) NOT NULL ,
        lastname_user  Varchar (50) NOT NULL ,
        email_user     Varchar (255) NOT NULL ,
        password       Varchar (100) NOT NULL ,
        avatar         Varchar (100) ,
        role           Varchar (100) NOT NULL ,
        city           Varchar (255) NOT NULL ,
        country        Varchar (255) NOT NULL ,
        opption        Varchar (10)
	,CONSTRAINT USER_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RUBRIK
#------------------------------------------------------------

CREATE TABLE RUBRIK(
        id_rubrik   Int  Auto_increment  NOT NULL ,
        name_rubrik Varchar (255) NOT NULL
	,CONSTRAINT RUBRIK_PK PRIMARY KEY (id_rubrik)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: POST
#------------------------------------------------------------

CREATE TABLE POST(
        id_post      Int  Auto_increment  NOT NULL ,
        title        Varchar (255) NOT NULL ,
        abstract     Longtext NOT NULL ,
        content_post Longtext NOT NULL ,
        image_post   Varchar (100) NOT NULL ,
        CreatedAt    Datetime NOT NULL ,
        isPublished  Bool NOT NULL ,
        slug         Varchar (128) NOT NULL ,
        id_user      Int ,
        id_rubrik    Int
	,CONSTRAINT POST_PK PRIMARY KEY (id_post)

	,CONSTRAINT POST_USER_FK FOREIGN KEY (id_user) REFERENCES USER(id_user)
	,CONSTRAINT POST_RUBRIK0_FK FOREIGN KEY (id_rubrik) REFERENCES RUBRIK(id_rubrik)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: COMMENT
#------------------------------------------------------------

CREATE TABLE COMMENT(
        id_comment      Int  Auto_increment  NOT NULL ,
        content_comment Longtext NOT NULL ,
        createdAt       Datetime NOT NULL ,
        id_post         Int ,
        id_user         Int
	,CONSTRAINT COMMENT_PK PRIMARY KEY (id_comment)

	,CONSTRAINT COMMENT_POST_FK FOREIGN KEY (id_post) REFERENCES POST(id_post)
	,CONSTRAINT COMMENT_USER0_FK FOREIGN KEY (id_user) REFERENCES USER(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CONTACT
#------------------------------------------------------------

CREATE TABLE CONTACT(
        id_contact        Int  Auto_increment  NOT NULL ,
        lastname_contact  Varchar (255) NOT NULL ,
        firstname_contact Varchar (255) NOT NULL ,
        email_contact     Varchar (100) NOT NULL ,
        message           Longtext NOT NULL ,
        subject           Varchar (255) NOT NULL ,
        response          Longtext ,
        is_responded      Bool NOT NULL ,
        created_at        Datetime NOT NULL
	,CONSTRAINT CONTACT_PK PRIMARY KEY (id_contact)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CATEGORY
#------------------------------------------------------------

CREATE TABLE CATEGORY(
        id_category   Int  Auto_increment  NOT NULL ,
        name_category Varchar (255) NOT NULL
	,CONSTRAINT CATEGORY_PK PRIMARY KEY (id_category)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PRODUCT
#------------------------------------------------------------

CREATE TABLE PRODUCT(
        id_product    Int  Auto_increment  NOT NULL ,
        name_product  Varchar (255) NOT NULL ,
        details       Varchar (255) ,
        description   Longtext ,
        price         Decimal NOT NULL ,
        image_product Varchar (255) ,
        created_at    Datetime NOT NULL ,
        updated_at    Datetime ,
        available     Bool NOT NULL ,
        id_category   Int
	,CONSTRAINT PRODUCT_PK PRIMARY KEY (id_product)

	,CONSTRAINT PRODUCT_CATEGORY_FK FOREIGN KEY (id_category) REFERENCES CATEGORY(id_category)
)ENGINE=InnoDB;

