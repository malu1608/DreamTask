--Drop Types
create schema if not EXISTS lbaw2242;

SET search_path TO lbaw2242;

DROP TABLE IF EXISTS Member_Project;
DROP TABLE IF EXISTS Member_Notification;
DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Task_Member;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Member_Team;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS Team_member;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS users;
DROP TYPE IF EXISTS Notification_Type CASCADE;
DROP TYPE IF EXISTS Status CASCADE;

--TYPES

CREATE TYPE Notification_Type AS ENUM ('Comment','Task','Project');
CREATE TYPE Status AS ENUM ('To Do','In Progress','Completed');

--Tables

CREATE TABLE users (
   id_user SERIAL,
   username varchar(255) NOT NULL UNIQUE,
   first_name varchar(255) NOT NULL,
   last_name varchar(255) NOT NULL,
   email varchar(255) NOT NULL UNIQUE,
   description TEXT,
   password varchar(255) NOT NULL,
   is_admin boolean NOT NULL DEFAULT false,
   CONSTRAINT id_userPK PRIMARY KEY(id_user)
);

CREATE TABLE Admin (
    id_admin INTEGER REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_adminPK PRIMARY KEY(id_admin)
);

CREATE TABLE Team_Member (
    id_user INTEGER REFERENCES users (id_user) ON UPDATE CASCADE,
    position varchar(255) NOT NULL,
    CONSTRAINT team_memberPK PRIMARY KEY(id_user)
);

CREATE TABLE Project (
    id_project SERIAL,
    name varchar(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    project_status Status DEFAULT 'To Do',
    company TEXT NOT NULL,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    current_edit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT id_projectPK PRIMARY KEY(id_project),
    CONSTRAINT current_edit_date_ck CHECK (creation_date <= current_edit_date)
);
CREATE TABLE Member_Project (
    id_project INTEGER,
    id_user INTEGER,
    CONSTRAINT member_projectPK PRIMARY KEY(id_project, id_user),
    CONSTRAINT id_projectFK FOREIGN KEY(id_project) REFERENCES Project ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Team (
    id_team SERIAL,
    name varchar(255) NOT NULL UNIQUE,
    field varchar(255) NOT NULL,
    id_project INTEGER REFERENCES Project (id_project) ON UPDATE CASCADE,
    CONSTRAINT id_teamPK PRIMARY KEY(id_team),
    CONSTRAINT id_projectFK FOREIGN KEY(id_project) REFERENCES Project ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Member_Team (
    id_user INTEGER,
    id_team INTEGER,
    is_coordinator BOOLEAN NOT NULL DEFAULT False,
    CONSTRAINT member_teamPK PRIMARY KEY(id_user, id_team),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES Team ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Task (
    id_Task SERIAL,
    title varchar(255) NOT NULL,
    description TEXT NOT NULL,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    current_edit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    task_status Status NOT NULL DEFAULT 'To Do',
    deleted BOOLEAN NOT NULL DEFAULT False,
    id_team INTEGER,
    CONSTRAINT id_taskPK PRIMARY KEY(id_task),
	CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES Team ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT current_edit_date_ck CHECK (creation_date <= current_edit_date)
);


CREATE TABLE Task_Member (
    id_user INTEGER,
    id_task INTEGER,
    CONSTRAINT task_memeberPK PRIMARY KEY(id_user, id_task),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES Task ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Comment (
    id_comment SERIAL,
    content TEXT NOT NULL,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    current_edit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user INTEGER,
    id_task INTEGER,
    id_team INTEGER,
	comment INTEGER,
	CONSTRAINT id_commentPK PRIMARY KEY(id_comment),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES Task ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES Team ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT id_commentFK FOREIGN KEY(id_comment) REFERENCES Comment ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT current_edit_date_ck CHECK (creation_date <= current_edit_date)
);


CREATE TABLE Notification (
    id_notification SERIAL,
    content TEXT NOT NULL,
    type Notification_type NOT NULL,
    id_task INTEGER,
    id_comment INTEGER,
    id_project INTEGER,
    CONSTRAINT id_notificationPK PRIMARY KEY(id_notification),
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES Task ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_commentFK FOREIGN KEY(id_comment) REFERENCES Comment ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_project) REFERENCES Project ON DELETE CASCADE ON UPDATE CASCADE
    
);

CREATE TABLE Member_Notification (
    id_user INTEGER,
    id_notification INTEGER,
	is_favorite BOOLEAN NOT NULL DEFAULT False,
    CONSTRAINT member_notificationPK PRIMARY KEY(id_user, id_notification),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_notificationFK FOREIGN KEY(id_notification) REFERENCES Notification ON DELETE CASCADE ON UPDATE CASCADE
);
--functions 

CREATE OR REPLACE FUNCTION user_comment() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF NOT EXISTS (SELECT * FROM Member_team a INNER JOIN Task_Member b
                        On a.id_user = b.id_user) THEN
            RAISE EXCEPTION 'No permissions to make a comment';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION verify_username() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF EXISTS (SELECT * FROM users WHERE NEW.username = username ) THEN
            RAISE EXCEPTION 'Username Invalid';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION verify_email() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF EXISTS (SELECT * FROM users WHERE NEW.email = email ) THEN
            RAISE EXCEPTION 'Email Invalid';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

/*CREATE FUNCTION exits_coordenator() RETURNS TRIGGER AS
$BODY$
BEGIN
        IF NOT EXISTS (SELECT * FROM Member_Team WHERE  is_coordinator) THEN
            RAISE EXCEPTION 'A coordinator is missing from your team';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;*/

-- Add column to Project to store computed ts_vectors.
ALTER TABLE Project
ADD COLUMN tsvectors TSVECTOR;

-- Create a function to automatically update ts_vectors.
CREATE OR REPLACE FUNCTION project_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.name), 'A') ||
         setweight(to_tsvector('english', NEW.description), 'B') ||
         setweight(to_tsvector('english', NEW.company), 'C')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.description <> OLD.description OR NEW.company <> OLD.company) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.name), 'A') ||
             setweight(to_tsvector('english', NEW.description), 'B') ||
             setweight(to_tsvector('english', NEW.company), 'C')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

--Triggers 

DROP TRIGGER IF EXISTS user_comment ON Comment;
DROP TRIGGER IF EXISTS verify_username ON users;
DROP TRIGGER IF EXISTS verify_email ON users;
DROP TRIGGER IF EXISTS exits_coordenator ON Team;
DROP TRIGGER IF EXISTS project_search_update ON Project;

CREATE TRIGGER user_comment
        BEFORE Insert ON Comment
        FOR EACH ROW
        EXECUTE PROCEDURE user_comment();

CREATE TRIGGER verify_username
        BEFORE INSERT OR UPDATE ON users
        FOR EACH ROW
        EXECUTE PROCEDURE verify_username();

CREATE TRIGGER verify_email
        BEFORE INSERT OR UPDATE ON users
        FOR EACH ROW
        EXECUTE PROCEDURE verify_email();

/*CREATE TRIGGER exits_coordenator
        BEFORE INSERT OR UPDATE ON Team
        FOR EACH ROW
        EXECUTE PROCEDURE exits_coordenator();*/

CREATE TRIGGER project_search_update
        BEFORE INSERT OR UPDATE ON Project
        FOR EACH ROW
        EXECUTE PROCEDURE project_search_update();

--Indexs

DROP INDEX IF EXISTS id_project_team;
DROP INDEX IF EXISTS creation_date_task;
DROP INDEX IF EXISTS task_status_task;
DROP INDEX IF EXISTS id_user_comment;
DROP INDEX IF EXISTS search_idxproj;


CREATE INDEX id_project_team ON Team USING btree (id_project);

CREATE INDEX creation_date_task ON Task USING hash (creation_date);

CREATE INDEX task_status_task ON Task USING hash (task_status);

CREATE INDEX id_user_comment ON Comment USING hash (id_user);

CREATE INDEX search_idxproj ON Project USING GIN (tsvectors);


/*User*/
INSERT INTO users (username, first_name, last_name, email, description,password,is_admin) VALUES ('USER1', 'Rui', 'Silva', 'ruisilva@gmail.com', 'sou user1 e admin','$2y$10$q763wmuN1R5E8YpuYrC3bOTgqTmYIGUIO9RC77IvHAMPDOMeNC99a',true);
INSERT INTO users (username, first_name, last_name, email, description,password,is_admin) VALUES ('USER2', 'Armando', 'Pires', 'armandopires@gmail.com', 'sou user2','$2y$10$q763wmuN1R5E8YpuYrC3bOTgqTmYIGUIO9RC77IvHAMPDOMeNC99a',false);
INSERT INTO users (username, first_name, last_name, email, description,password,is_admin) VALUES ('USER3', 'Ana', 'Borges', 'anaborges@gmail.com', 'sou user3','$2y$10$q763wmuN1R5E8YpuYrC3bOTgqTmYIGUIO9RC77IvHAMPDOMeNC99a',false);
INSERT INTO users (username, first_name, last_name, email, description,password,is_admin) VALUES ('USER4', 'Joao', 'Pereira', 'joaopereira@gmail.com', 'sou user4','$2y$10$q763wmuN1R5E8YpuYrC3bOTgqTmYIGUIO9RC77IvHAMPDOMeNC99a',false);
INSERT INTO users (username, first_name, last_name, email, description,password,is_admin) VALUES ('USER5', 'Joana', 'Silva', 'joanasilva@gmail.com', 'sou user5','$2y$10$q763wmuN1R5E8YpuYrC3bOTgqTmYIGUIO9RC77IvHAMPDOMeNC99a',false);
INSERT INTO users (username, first_name, last_name, email, description,password,is_admin) VALUES ('USER6', 'Miguel', 'Oliveira', 'migueloliveira@gmail.com', 'sou user6 e admin','$2y$10$q763wmuN1R5E8YpuYrC3bOTgqTmYIGUIO9RC77IvHAMPDOMeNC99a',true);
INSERT INTO users (username, first_name, last_name, email, description,password,is_admin) VALUES ('USER7', 'Pedro', 'Sousa', 'pedrosousa@gmail.com', 'sou user7','$2y$10$q763wmuN1R5E8YpuYrC3bOTgqTmYIGUIO9RC77IvHAMPDOMeNC99a',false);


/*Admin*/
INSERT INTO Admin (id_admin) VALUES (1);
INSERT INTO Admin (id_admin) VALUES (6);

/*Team_Member*/
INSERT INTO Team_Member (id_user, position) VALUES (2, 'Software developer');
INSERT INTO Team_Member (id_user, position) VALUES (3, 'Team lead');
INSERT INTO Team_Member (id_user, position) VALUES (4, 'Tester');
INSERT INTO Team_Member (id_user, position) VALUES (5, 'Software architect');
INSERT INTO Team_Member (id_user, position) VALUES (7, 'Product Manager');

/*Project*/
INSERT INTO Project (name, description, company) VALUES ('PFL', 'Um jogo de xadrez', 'company X');
INSERT INTO Project (name, description, company) VALUES ('LBAW', 'Um site para comprar produtos online', 'company X');
INSERT INTO Project (name, description, company) VALUES ('SO', 'Codigo para trabalho de grupo', 'company Y');
INSERT INTO Project (name, description, company) VALUES ('IPC', 'Codigo para comunicar entre computadores', 'company Z');
INSERT INTO Project (name, description, company) VALUES ('LDTS', 'Um jogo da Snake', 'company Y');

/*Member_Project*/
INSERT INTO Member_Project (id_project, id_user) VALUES (1,4);
INSERT INTO Member_Project (id_project, id_user) VALUES (1,2);
INSERT INTO Member_Project (id_project, id_user) VALUES (1,3);
INSERT INTO Member_Project (id_project, id_user) VALUES (2,7);
INSERT INTO Member_Project (id_project, id_user) VALUES (3,4);
INSERT INTO Member_Project (id_project, id_user) VALUES (3,5);
INSERT INTO Member_Project (id_project, id_user) VALUES (3,3);
INSERT INTO Member_Project (id_project, id_user) VALUES (3,2);
INSERT INTO Member_Project (id_project, id_user) VALUES (4,5);
INSERT INTO Member_Project (id_project, id_user) VALUES (4,2);

/*Team*/
INSERT INTO Team (name, field, id_project) VALUES ('MTeam', 'Equipa principal do projeto PFL', 1);
INSERT INTO Team (name, field, id_project) VALUES ('STeam', 'Equipa secundaria do projeto PFL', 1);
INSERT INTO Team (name, field, id_project) VALUES ('UTeam', 'Unica equipa do projeto LBAW', 2);
INSERT INTO Team (name, field, id_project) VALUES ('EX1', 'Equipa que trata do exercicio 1 do projeto SO', 3);
INSERT INTO Team (name, field, id_project) VALUES ('EX2', 'Equipa que trata do exercicio 2 do projeto SO', 3);
INSERT INTO Team (name, field, id_project) VALUES ('Comms', 'Equipa do projeto de IPC', 4);

/*Member_Team*/
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (2, 1, True);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (3, 2, True);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (4, 2, False);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (7, 3, True);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (2, 4, True);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (4, 4, False);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (5, 5, False);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (3, 5, True);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (5, 6, False);
INSERT INTO Member_Team (id_user, id_team, is_coordinator) VALUES (2, 6, True);

/*Task*/
INSERT INTO Task (title, description, id_team) VALUES ('FazerTabuleiro', 'Fazer tabuleiro de jogo', 1);
INSERT INTO Task (title, description, id_team) VALUES ('FazerPecas', 'Fazer pecas do jogo', 1);
INSERT INTO Task (title, description, id_team) VALUES ('Movimento', 'Fazer pecas mexer', 2);
INSERT INTO Task (title, description, id_team) VALUES ('Produtos', 'Adicionar produtos que se pode comprar', 3);
INSERT INTO Task (title, description, id_team) VALUES ('Ideia', 'Formalizar a ideia do exercicio', 4);
INSERT INTO Task (title, description, id_team) VALUES ('Desenvolver', 'Desenvolver o trabalho', 4);
INSERT INTO Task (title, description, id_team) VALUES ('Organizar', 'Colocar codigo organizado', 4);
INSERT INTO Task (title, description, id_team) VALUES ('FazerT', 'Desenvolver o codigo do trabalho', 5);
INSERT INTO Task (title, description, id_team) VALUES ('Legivel', 'Colocar codigo legivel', 5);
INSERT INTO Task (title, description, id_team) VALUES ('Comunicacao', 'Unica tarefa deste trabalho', 6);

/*Task_Member*/
INSERT INTO Task_Member (id_user, id_task) VALUES (2, 1);
INSERT INTO Task_Member (id_user, id_task) VALUES (2, 2);
INSERT INTO Task_Member (id_user, id_task) VALUES (3, 3);
INSERT INTO Task_Member (id_user, id_task) VALUES (4, 3);
INSERT INTO Task_Member (id_user, id_task) VALUES (7, 4);
INSERT INTO Task_Member (id_user, id_task) VALUES (2, 5);
INSERT INTO Task_Member (id_user, id_task) VALUES (4, 5);
INSERT INTO Task_Member (id_user, id_task) VALUES (2, 6);
INSERT INTO Task_Member (id_user, id_task) VALUES (4, 6);
INSERT INTO Task_Member (id_user, id_task) VALUES (4, 7);
INSERT INTO Task_Member (id_user, id_task) VALUES (5, 8);
INSERT INTO Task_Member (id_user, id_task) VALUES (3, 8);
INSERT INTO Task_Member (id_user, id_task) VALUES (3, 9);
INSERT INTO Task_Member (id_user, id_task) VALUES (5, 10);
INSERT INTO Task_Member (id_user, id_task) VALUES (2, 10);

/*Comment*/
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('Gostei da ideia', 2, 1, 1);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('Pensaram bem', 2, 1, 1);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('Precisamos de ajuda nesta fase', 4, 3, 2);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('Copiei de outro codigo', 3, 3, 2);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('Nao gostei de como foi feito', 3, 8, 5);

/*Notification*/
INSERT INTO Notification (content, type, id_task) VALUES ('notification 1', 'Task', 1);
INSERT INTO Notification (content, type, id_comment) VALUES ('notification 2', 'Comment', 3);
INSERT INTO Notification (content, type, id_project) VALUES ('notification 3', 'Project', 3);
INSERT INTO Notification (content, type, id_task) VALUES ('notification 4', 'Task', 8);
INSERT INTO Notification (content, type, id_project) VALUES ('notification 5', 'Project', 1);


/*Member_Notification*/
INSERT INTO Member_Notification (id_user, id_notification) VALUES (2, 1);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (4, 2);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (3, 2);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (4, 3);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (5, 3);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (3, 3);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (2, 3);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (5, 4);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (3, 4);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (4, 5);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (2, 5);
INSERT INTO Member_Notification (id_user, id_notification) VALUES (3, 5);

