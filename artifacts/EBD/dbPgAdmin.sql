

--TYPES

CREATE TYPE notification_Type AS ENUM ('Comment','Task','Project');
CREATE TYPE status AS ENUM ('To Do','In Progress','Done');

--Tables

CREATE TABLE users (
   id_user SERIAL,
   username varchar(255) NOT NULL UNIQUE,
   first_name varchar(255) NOT NULL,
   last_name varchar(255) NOT NULL,
   email varchar(255) NOT NULL UNIQUE,
   description TEXT,
   CONSTRAINT id_userPK PRIMARY KEY(id_user)
);

CREATE TABLE admin (
    id_admin INTEGER REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE team_Member (
    id_user INTEGER REFERENCES users (id_user) ON UPDATE CASCADE,
    position varchar(255) NOT NULL,
    CONSTRAINT team_memberPK PRIMARY KEY(id_user)
);

CREATE TABLE project (
    id_project SERIAL,
    name varchar(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    project_status status DEFAULT 'To Do',
    company TEXT NOT NULL,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, -- podiamos usar como DEFAULT a data atual
    current_edit_data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT id_projectPK PRIMARY KEY(id_project),
    CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_data)
);

CREATE TABLE team (
    id_team SERIAL,
    name varchar(255) NOT NULL UNIQUE,
    field varchar(255) NOT NULL,
    id_project INTEGER REFERENCES project (id_project) ON UPDATE CASCADE,
    CONSTRAINT id_teamPK PRIMARY KEY(id_team),
    CONSTRAINT id_projectFK FOREIGN KEY(id_project) REFERENCES project ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE task (
    id_task SERIAL,
    title varchar(255) NOT NULL,
    description TEXT NOT NULL,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    current_edit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    task_status status NOT NULL DEFAULT 'To Do',
    deleted BOOLEAN NOT NULL DEFAULT False,
    id_team INTEGER REFERENCES team (id_team) ON UPDATE CASCADE,
    CONSTRAINT id_taskPK PRIMARY KEY(id_task),
    CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_date)
);


CREATE TABLE member_Team (
    id_user INTEGER,
    id_team INTEGER,
    is_coordinator BOOLEAN NOT NULL DEFAULT False,
    CONSTRAINT member_teamPK PRIMARY KEY(id_user, id_team),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES team ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE task_Member (
    id_user INTEGER,
    id_task INTEGER,
    CONSTRAINT task_memberPK PRIMARY KEY(id_user, id_task),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES task ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE comment (
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
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES task ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES team ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT id_commentFK FOREIGN KEY(id_comment) REFERENCES comment ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT current_edit_data_ck CHECK (creation_date < current_edit_date)
);

CREATE TABLE notification (
    id_notification SERIAL,
	id_team INTEGER,
    content TEXT NOT NULL,
    type notification_type NOT NULL,
    id_task INTEGER,
    id_comment INTEGER,
    id_project INTEGER,
    CONSTRAINT id_notificationPK PRIMARY KEY(id_notification),
    CONSTRAINT id_taskFK FOREIGN KEY(id_task) REFERENCES task ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_commentFK FOREIGN KEY(id_comment) REFERENCES comment ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_teamFK FOREIGN KEY(id_team) REFERENCES team ON DELETE CASCADE ON UPDATE CASCADE
    
);


CREATE TABLE member_Project (
    id_project INTEGER,
    id_user INTEGER,
    CONSTRAINT member_projectPK PRIMARY KEY(id_project, id_user),
    CONSTRAINT id_projectFK FOREIGN KEY(id_project) REFERENCES notification ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE member_Notification (
    id_user INTEGER,
    id_notification INTEGER,
    CONSTRAINT member_notificationPK PRIMARY KEY(id_user, id_notification),
    CONSTRAINT id_userFK FOREIGN KEY(id_user) REFERENCES users ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_notificationFK FOREIGN KEY(id_notification) REFERENCES notification ON DELETE CASCADE ON UPDATE CASCADE
);

