# DreamTask
## EBD: Database Specification Component

The purpose of this project is to develop a web application called DreamTask, which is a project management system that will be developed by a small software company, mainly to  define and organize all possible tasks or goals to be achieved individually or as a team.

## A7: Web Resources Documentation
This artifact documents the  architecture of the web application to be developed, indicating the catalog of resources, the properties of each resource, and the format of JSON responses. This specification adheres to the OpenAPI standard using YAML.

This artifact presents the documentation for DreamTask, including the CRUD (create, read, update, delete) operations for each resource.

### 1. Overview

In this section is presented an overview of the web application to implement, where the modules are identified and described. The web resources associated with each module are detailed in the individual documentation of each module inside the OpenAPI specification defined in section 3. of this artifact.

<table>
    <tr>
        <td>M01: Authentication and Individual Profile</td>
        <td>Web resources associated with the user authentication and individual profile management. Includes the following system features: login/logout, registration, credential recovery, view and edit personal profile information.</td>
    </tr>
    <tr>
        <td>M02: Projects and Teams</td>
        <td>Web resource associated with the projects and teams. Includes the following system features: search and listing of the projects and teams.</td>
    </tr>
    <tr>
        <td>M03: Tasks</td>
        <td>Web resources associated with tasks. Includes the following system features: view tasks, add tasks, edit tasks and search tasks.</td>
    </tr>
    <tr>
        <td>M04: User Administration and Static pages</td>
        <td>Web resources associated with user management, specifically: view and search users, delete or block user accounts, view and change user information, and view system access details for each user, and add, edit and remove FAQs. Web resources with static content are associated with this module: about, contact and faq.</td>
    </tr>
</table>

### 2. Permissions

In this section the permissions used in the modules to establish the conditions of access to resources are defined.

<table>
    <tr>
        <td>PUB</td>
        <td>Public</td>
        <td>Group of users without privileges.</td>
    </tr>
    <tr>
        <td>USR</td>
        <td>User</td>
        <td>Authenticated user.</td>
    </tr>
    <tr>
        <td>OWN</td>
        <td>Owner</td>
        <td>Group of users that can update their profiles and have their projects and teams.</td>
    </tr>
    <tr>
        <td>CRD</td>
        <td>Coordinator</td>
        <td>Group of users that can update their projects and teams.</td>
    </tr>
    <tr>
        <td>ADM</td>
        <td>Administrator</td>
        <td>Group of system administrators.</td>
    </tr>
</table>

### 3. OpenAPI Specification

This section includes the complete API specification in OpenAPI (YAML).

```yaml
openapi: 3.0.0

info:
  version: '1.0'
  title: 'LBAW DreamTask API'
  description: 'Web Resources Specification (A7) for DreamTask'

servers:
- url: http://lbaw.fe.up.pt
  description: Production server

tags:
  - name: 'M01: Authentication and Individual Profile'
  - name: 'M02: Projects and Teams'
  - name: 'M03: Tasks'
  - name: 'M04: User Administration and Static pages'

paths:
  /login:
    get:
      operationId: R101
      summary: 'R101: Login Form'
      description: 'Provide login form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok. Show Log-in UI'
    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Processes the login form submission. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:          # <!--- form field name
                  type: string
                password:    # <!--- form field name
                  type: string
              required:
                    - email
                    - password
      responses:
        '302':
          description: 'Redirect after processing the login credentials.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to user profile.'
                  value: '/User/{id_user}'
                302Error:
                  description: 'Failed authentication. Redirect to login form.'
                  value: '/login'

  /logout:
    post:
      operationId: R103
      summary: 'R103: Logout Action'
      description: 'Logout the current authenticated user. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to login form.'
                  value: '/login'

  /register:
    get:
      operationId: R104
      summary: 'R104: Register Form'
      description: 'Provide new user registration form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok. Show Sign-Up UI'

    post:
      operationId: R105
      summary: 'R105: Register Action'
      description: 'Processes the new user registration form submission. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                email:
                  type: string
                picture:
                  type: string
                  format: binary
              required:
                  - email
                  - password
      responses:
        '302':
          description: 'Redirect after processing the new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to user profile.'
                  value: '/User/{id_user}'
                302Failure:
                  description: 'Failed authentication. Redirect to login form.'
                  value: '/login'

  /User/{id_user}:
    get:
      operationId: R106
      summary: 'R106: View user profile'
      description: 'Show the individual user profile. Access: USR'
      tags:
        - 'M01: Authentication and Individual Profile'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show User Profile UI'

  /User/{id_user}/edit:
    get:
     operationId: R107
     summary: 'R107: Edit Profile Form'
     description: 'Provide Edit Profile Form. Access: OWN'
     tags:
       - 'M01: Authentication and Individual Profile'
     responses:
       '200':
         description: 'Ok. Show Edit Profile UI'

    post:
     operationId: R108
     summary: 'R108: Edit Profile Action'
     description: 'Processes the Edit Profile Form submission. Access: OWN'
     tags:
       - 'M01: Authentication and Individual Profile'

     requestBody:
       required: true
       content:
         application/x-www-form-urlencoded:
           schema:
             type: object
             properties:
               username:
                 type: string
               first_name:
                 type: string
               last_name:
                 type: string
               email:
                 type: string
               description:
                 type: string
               password:
                 type: string
             required:
                  - username
                  - first_name
                  - last_name
                  - email
                  - description
                  - password

     responses:
       '302':
         description: 'Redirect after processing the Edit Profile credentials.'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Successful edited profile. Redirect to user profile.'
                 value: '/User/{id_user}'
               302Error:
                 description: 'Failed edited profile. Redirect to user profile.'
                 value: '/User/{id_user}'

  /api/Project:
   get:
     operationId: R201
     summary: 'R201: Search Project API'
     description: 'Searches for projects and returns the results as JSON. Access: USR.'

     tags:
       - 'M02: Projects and Teams'

     parameters:
       - in: query
         name: query
         description: String to use for full-text search
         schema:
           type: string
         required: false
       - in: query
         name: item
         description: Company of the projects
         schema:
           type: string
         required: false

     responses:
       '200':
         description: Success
         content:
           application/json:
             schema:
               type: array
               items:
                 type: object
                 properties:
                   id:
                     type: string
                   name:
                     type: string
                   description:
                     type: string
                   company:
                     type: string
                   creation_date:
                     type: string
                   current_edit_data:
                     type: string
               example:
                 - id: 1
                   name: Project 1
                   description: Description of Project 1
                   company: Company 1
                   creation_date: 2022-11-20
                   current_edit_data: 2022-11-21

  /Task/{id_task}:
    get:
      operationId: R301
      summary: 'R301: View Task'
      description: 'Show the task. Access: OWN'
      tags:
        - 'M03: Tasks'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show Task UI'

  /api/Task:
   get:
     operationId: R304
     summary: 'R304: Search Task API'
     description: 'Searches for tasks and returns the results as JSON. Access: OWN.'

     tags:
       - 'M03: Tasks'

     parameters:
       - in: query
         name: query
         description: String to use for full-text search
         schema:
           type: string
         required: false
       - in: query
         name: item
         description: Title of the tasks
         schema:
           type: string
         required: false

     responses:
       '200':
         description: Success
         content:
           application/json:
             schema:
               type: array
               items:
                 type: object
                 properties:
                   id:
                     type: string
                   title:
                     type: string
                   description:
                     type: string
                   creation_date:
                     type: string
                   current_edit_data:
                     type: string
               example:
                 - id: 1
                   name: Task 1
                   description: Description of Task 1
                   creation_date: 2022-11-20
                   current_edit_data: 2022-11-21

  /about:
   get:
     operationId: R401
     summary: 'R401: About'
     description: 'Provide information about the app. Access: PUB'
     tags:
       - 'M04: User Administration and Static pages'
     responses:
       '200':
         description: 'Ok. Show about page'

  /services:
   get:
     operationId: R402
     summary: 'R402: Services'
     description: 'Provide information about the services of the app. Access: PUB'
     tags:
       - 'M04: User Administration and Static pages'
     responses:
       '200':
         description: 'Ok. Show services page'

  /faq:
   get:
     operationId: R403
     summary: 'R403: FAQ'
     description: 'Provide information about the most frequent questions of the users. Access: PUB'
     tags:
       - 'M04: User Administration and Static pages'
     responses:
       '200':
         description: 'Ok. Show FAQ page'

```

## A8: Vertical Prototype

This artifact includes the implementation of the features marked as necessary (with an asterisk) in the common and the project management requirements document.
The prototype includes the implementation of pages of visualization, insertion, edition and removal of information, the control of permissions in the access to the implemented pages, and the presentation of error and success messages.

### 1. Implemented Features

#### 1.1 Implemented User Stories

In this section the user stories that were implemented in the prototype are described.

| User Story    | Name                                                | Priority | Description                                                                                                                          |
|------------|-----------------------------------------------------|----------|--------------------------------------------------------------------------------------------------------------------------------------|
| US01       | Homepage                                            | high     | As a User, I want to access the home page, so that I can see the website display and main layout.                                       |
| US02       | About page                                | high     | As a User, I want to access the about page, to read a complete description of the website, learn about the history of the creators and find curiosities about the platform.                                 |
| US03       | FAQ page                                | high     | As a User, I want to access the FAQ page so I can find solutions to my doubts in the form of objective questions to other users.                                                 |
| US04       | Contacts page                          | high     | As a User, I want to be able to contact the platform creators for any kind of pertinent question or seek help.
| US05       | Sign-In                    | high     | As an Unauthenticated User, I want to authenticate into the system, so that I can access my information.                                    |
| US06       | Sign-Up                    | high     | As an Unauthenticated User, I want to register into the system, so that I can authenticate myself into the system.                           |
| US09       | View profile                              | high     | As an Authenticated User, I want to see my profile information, so that I can keep track of my info.                                                       |
| US10       | Edit profile                       | high     | As an Authenticated User, I want to edit my profile, so that I can update my data.                                                               |
| US12      | Create Project                         | high     | As an Authenticated User, I want to Create a Project, so that I can start my own project. |
| US15      | Delete user              | high     | As an Admin, I want to be able to delete a user so that I can keep control of who is using the platform.                                |
| US18       | Edit accounts       | high    | As an Admin, I want to edit accounts so that I can change things about certain user profiles.         |
| US24       | View Projects         | high     | As a Team Member, I want to access the home page, so that I can see my projects.                                 |
| US25       | View Task       | high     | As an Authenticated User, I want to see my task, so that I can see more information about it like the description or the assignees.         |
| US27       | Add Task        | high     | As a Team Member, I want to add a task, so that I can have the new task registered.                                 |
| US28       | Remove Task       | high     | As a Team Member, I want to remove a task so that whenever I can’t find its purpose on the project, it doesn’t affect the workflow.                                 |
| US29       | Search Task        | high     | As a Team Member, I want to search for a task, so that I can find the task faster.                                 |                          | 
| US34       | Mark as Completed       | high    | As a Team Member, I want to mark the tasks as completed, so that I can keep track of the work done.  
| US38       | Add Team Members          | high     | As a Team Coordinator, I want to add Team Members, so that I can have a bigger team.                           |
| US39       | Search User                 | high     | As an Authenticated User, I want to be able to search for a user to see their information.
| US40       | Search Project               | high     | As an Authenticated User, I want to be able to search for a project to see what are the projects available to join in.



#### 1.2 Implemented Web Resources 

In this section the web resources that were implemented in the prototype are described.

##### M01: Authentication and Individual Profile

| Web Resource Reference    | URL                                               
|------------|-----------------------------------------------------|
|  R101: Login Form     | GET /login                                            |
|  R102: Login Action     | POST /login                                            | 
|  R103: Logout Form     | POST /logout                                           |  
|  R104: Register Form     | GET /register                                            | 
|  R105: Register Action     | POST /register                                            | 
|  R106: View Profile     | GET /User/{id_user}                                            |
|  R107: Edit Profile Form     | GET /User/{id_user}/edit                                                         |
|  R108: Edit Profile Action     | POST /User/{id_user}/edit                                        |

##### M02: Projects and Teams

| Web Resource Reference    | URL                                               
|------------|-----------------------------------------------------|
|  R201: Search Project API    | GET /api/Project                                           |

##### M03: Tasks

| Web Resource Reference    | URL                                               
|------------|-----------------------------------------------------|
|  R301: View Task    | GET /Task/{id_task}                                            |
|  R302: Add Task     | POST /Task/{id_task}                                           | 
|  R303: Remove Task     | DELETE /Task/{id_task}                                           |  
|  R304: Search Task     | GET /api/Task                                          | 
|  R305: Mark as Completed     | POST /Task/{id_task}/completed                                            |  
                               
##### M04: User Administration and Static pages

| Web Resource Reference    | URL                                               
|------------|-----------------------------------------------------|
|  R401: About     | GET /about                                            | 
|  R402: Services     | GET /services                                            | 
|  R403: FAQ     | GET /faq              |
|  R404: 404     | GET /404                                                         |

