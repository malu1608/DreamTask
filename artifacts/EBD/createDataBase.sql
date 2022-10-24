
--Drop tables
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Task_Member;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Member_Team;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Member_Notification;
DROP TABLE IF EXISTS Member_Project;
DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS Team_member;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS "User";

--Drop Types

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
   CONSTRAINT id_userPK PRIMARY KEY(id_user)
);

CREATE TABLE Admin (
    id_admin INTEGER REFERENCES "User" (id_user) ON DELETE CASCADE ON UPDATE CASCADE
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
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, -- podiamos usar como DEFAULT a data atual
    current_edit_data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT id_projectPK PRIMARY KEY(id_project),
    CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_data)
);

CREATE TABLE Notification (
    id_notification SERIAL,
    content TEXT NOT NULL,
    type Notification_type NOT NULL,
    id_task INTEGER,
    id_comment INTEGER,
    id_project INTEGER,
    CONSTRAINT id_notifcationPK PRIMARY KEY(id_notification)
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES Task ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_commentFK FOREIGN KEY(id_comment) REFERENCES Comment ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES Team ON DELETE CASCADE ON UPDATE CASCADE
    
);

CREATE TABLE Member_Project (
    id_project INTEGER,
    id_user INTEGER,
    CONSTRAINT member_projectPK PRIMARY KEY(id_project, id_user),
    CONSTRAINT id_projectFK FOREIGN KEY(id_project) REFERENCES Notification ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Member_Notification (
    id_user INTEGER,
    id_notification INTEGER,
    CONSTRAINT member_notificationPK PRIMARY KEY(id_user, id_notification),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_notificationFK FOREIGN KEY(id_notification) REFERENCES Notification ON DELETE CASCADE ON UPDATE CASCADE
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
    current_edit_data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    task_status Status NOT NULL DEFAULT 'To Do',
    deleted BOOLEAN NOT NULL DEFAULT False,
    id_team INTEGER REFERENCES Team (id_team) ON UPDATE CASCADE,
    CONSTRAINT id_taskPK PRIMARY KEY(id_task),
    CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_data)
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
    current_edit_data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user INTEGER,
    id_task INTEGER,
    id_team INTEGER,
	comment INTEGER,
	CONSTRAINT id_commentPK PRIMARY KEY(id_comment),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES "User" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES Task ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES Team ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT id_commentFK FOREIGN KEY(id_comment) REFERENCES Comment ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_data)
);

