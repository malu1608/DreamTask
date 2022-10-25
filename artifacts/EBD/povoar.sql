/*User*/
INSERT INTO User (username, first_name, last_name, email, description) VALUES ('USER1', 'Rui', 'Silva', 'ruisilva@gmail.com', 'sou user1 e admin');
INSERT INTO User (username, first_name, last_name, email, description) VALUES ('USER2', 'Armando', 'Pires', 'armandopires@gmail.com', 'sou user2');
INSERT INTO User (username, first_name, last_name, email, description) VALUES ('USER3', 'Ana', 'Borges', 'anaborges@gmail.com', 'sou user3');
INSERT INTO User (username, first_name, last_name, email, description) VALUES ('USER4', 'Joao', 'Pereira', 'joaopereira@gmail.com', 'sou user4');
INSERT INTO User (username, first_name, last_name, email, description) VALUES ('USER5', 'Joana', 'Silva', 'joanasilva@gmail.com', 'sou user5');
INSERT INTO User (username, first_name, last_name, email, description) VALUES ('USER6', 'Miguel', 'Oliveira', 'migueloliveira@gmail.com', 'sou user6 e admin');
INSERT INTO User (username, first_name, last_name, email, description) VALUES ('USER7', 'Pedro', 'Sousa', 'pedrosousa@gmail.com', 'sou user7');

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
INSERT INTO Notification (content, Notification_type, id_task) VALUES ('notification 1', 'Task', 1);
INSERT INTO Notification (content, Notification_type, id_comment) VALUES ('notification 2', 'Comment', 3);
INSERT INTO Notification (content, Notification_type, id_project) VALUES ('notification 3', 'Project', 3);
INSERT INTO Notification (content, Notification_type, id_task) VALUES ('notification 4', 'Task', 8);
INSERT INTO Notification (content, Notification_type, id_project) VALUES ('notification 5', 'Project', 1);


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