
--Drop tables
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Task_Member;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Member_Team;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Member_Notification;
DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS Member_Project;
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
   id_user SERIAL PRIMARY KEY,
   username varchar(255) NOT NULL UNIQUE,
   first_name varchar(255) NOT NULL,
   last_name varchar(255) NOT NULL,
   email varchar(255) NOT NULL UNIQUE,
   description TEXT
);

CREATE TABLE Admin (
    id_admin INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE
);

CREATE TABLE Team_Member (
    id_user INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE,
    position varchar(255) NOT NULL -- podiamos usar um valor Default
);

CREATE TABLE Project (
    id_project SERIAL PRIMARY KEY,
    name varchar(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    project_status Status DEFAULT 'To Do',
    company TEXT NOT NULL,
    creation_date DATE NOT NULL, -- podiamos usar como DEFAULT a data atual
    current_edit_data DATE NOT NULL CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_data)
);

CREATE TABLE Member_Project (
    id_project INTEGER REFERENCES Project (id_project) ON UPDATE CASCADE,
    id_user INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE
);

CREATE TABLE Notification (
    id_notification SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    type Notification_type NOT NULL
);

CREATE TABLE Member_Notification (
    id_user INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE,
    id_notification INTEGER REFERENCES Notification (id_notification) ON UPDATE CASCADE
);

CREATE TABLE Team (
    id_team SERIAL PRIMARY KEY,
    name varchar(255) NOT NULL UNIQUE,
    field varchar(255) NOT NULL,
    id_project INTEGER REFERENCES Project (id_project) ON UPDATE CASCADE
);

CREATE TABLE Member_Team (
    id_user INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE,
    id_team INTEGER REFERENCES Team (id_team) ON UPDATE CASCADE,
    is_coordinator BOOLEAN NOT NULL DEFAULT False
);

CREATE TABLE Task (
    id_Task SERIAL PRIMARY KEY,
    title varchar(255) NOT NULL,
    description TEXT NOT NULL,
    creation_date DATE NOT NULL,
    current_edit_data DATE NOT NULL CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_data),
    task_status Status NOT NULL Default 'To Do',
    deleted BOOLEAN NOT NULL DEFAULT False,
    id_team INTEGER REFERENCES Team (id_team) ON UPDATE CASCADE
);

CREATE TABLE Task_Member (
    id_user INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE,
    id_task INTEGER REFERENCES Task (id_task) ON UPDATE CASCADE
);

CREATE TABLE Comment (
    id_comment SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    creation_date DATE NOT NULL,
    current_edit_data DATE NOT NULL CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_data),
    id_user INTEGER REFERENCES "User" (id_user) ON UPDATE CASCADE,
    id_task INTEGER REFERENCES Task (id_task) ON UPDATE CASCADE,
    id_team INTEGER REFERENCES Team (id_team) ON UPDATE CASCADE
);