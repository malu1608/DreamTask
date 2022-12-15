

--Drop Types
create schema if not EXISTS lbaw2242;

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
DROP TABLE IF EXISTS "User";
DROP TYPE IF EXISTS Notification_Type CASCADE;
DROP TYPE IF EXISTS Status CASCADE;

--TYPES

CREATE TYPE Notification_Type AS ENUM ('Comment','Task','Project');
CREATE TYPE Status AS ENUM ('To Do','In Progress','Done');

--Tables

CREATE TABLE "User" (
   id_user SERIAL,
   username varchar(255) NOT NULL UNIQUE,
   first_name varchar(255) NOT NULL,
   last_name varchar(255) NOT NULL,
   email varchar(255) NOT NULL UNIQUE,
   description TEXT,
   password varchar(255) NOT NULL,
   CONSTRAINT id_userPK PRIMARY KEY(id_user)
);

CREATE TABLE Admin (
    id_admin INTEGER REFERENCES "User" (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_adminPK PRIMARY KEY(id_admin)
);

CREATE TABLE Team_Member (
    id_user INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE,
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
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE
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
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE,
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
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE,
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
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE,
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
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_notificationFK FOREIGN KEY(id_notification) REFERENCES Notification ON DELETE CASCADE ON UPDATE CASCADE
);


/*User*/
INSERT INTO "User" (username, first_name, last_name, email, description,password) VALUES ('USER1', 'Rui', 'Silva', 'ruisilva@gmail.com', 'sou user1 e admin','olalinda');
INSERT INTO "User" (username, first_name, last_name, email, description,password) VALUES ('USER2', 'Armando', 'Pires', 'armandopires@gmail.com', 'sou user2','1234');
INSERT INTO "User" (username, first_name, last_name, email, description,password) VALUES ('USER3', 'Ana', 'Borges', 'anaborges@gmail.com', 'sou user3','12345');
INSERT INTO "User" (username, first_name, last_name, email, description,password) VALUES ('USER4', 'Joao', 'Pereira', 'joaopereira@gmail.com', 'sou user4','123456');
INSERT INTO "User" (username, first_name, last_name, email, description,password) VALUES ('USER5', 'Joana', 'Silva', 'joanasilva@gmail.com', 'sou user5','1234567');
INSERT INTO "User" (username, first_name, last_name, email, description,password) VALUES ('USER6', 'Miguel', 'Oliveira', 'migueloliveira@gmail.com', 'sou user6 e admin','12345678');
INSERT INTO "User" (username, first_name, last_name, email, description,password) VALUES ('USER7', 'Pedro', 'Sousa', 'pedrosousa@gmail.com', 'sou user7','123456789');

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
INSERT INTO Project (name, description, company) VALUES ('Proj1', 'este é o project 1', 'company X');
INSERT INTO Project (name, description, company) VALUES ('Proj2', 'este é o project 2', 'company X');
INSERT INTO Project (name, description, company) VALUES ('Proj3', 'este é o project 3', 'company Y');
INSERT INTO Project (name, description, company) VALUES ('Proj4', 'este é o project 4', 'company Z');
INSERT INTO Project (name, description, company) VALUES ('Proj5', 'este é o project 5', 'company Y');

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
INSERT INTO Team (name, field, id_project) VALUES ('team1', 'field da team 1', 1);
INSERT INTO Team (name, field, id_project) VALUES ('team2', 'field da team 2', 1);
INSERT INTO Team (name, field, id_project) VALUES ('team3', 'field da team 3', 2);
INSERT INTO Team (name, field, id_project) VALUES ('team4', 'field da team 4', 3);
INSERT INTO Team (name, field, id_project) VALUES ('team5', 'field da team 5', 3);
INSERT INTO Team (name, field, id_project) VALUES ('team6', 'field da team 6', 4);

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
INSERT INTO Task (title, description, id_team) VALUES ('task1', 'esta é a task 1', 1);
INSERT INTO Task (title, description, id_team) VALUES ('task2', 'esta é a task 2', 1);
INSERT INTO Task (title, description, id_team) VALUES ('task3', 'esta é a task 3', 2);
INSERT INTO Task (title, description, id_team) VALUES ('task4', 'esta é a task 4', 3);
INSERT INTO Task (title, description, id_team) VALUES ('task5', 'esta é a task 5', 4);
INSERT INTO Task (title, description, id_team) VALUES ('task6', 'esta é a task 6', 4);
INSERT INTO Task (title, description, id_team) VALUES ('task7', 'esta é a task 7', 4);
INSERT INTO Task (title, description, id_team) VALUES ('task8', 'esta é a task 8', 5);
INSERT INTO Task (title, description, id_team) VALUES ('task9', 'esta é a task 9', 5);
INSERT INTO Task (title, description, id_team) VALUES ('task10', 'esta é a task 10', 6);

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
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('comentario 1', 2, 1, 1);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('comentario 2', 2, 1, 1);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('comentario 3', 4, 3, 2);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('comentario 4', 3, 3, 2);
INSERT INTO Comment (content, id_user, id_task, id_team) VALUES ('comentario 5', 3, 8, 5);

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
