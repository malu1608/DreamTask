# DreamTask — Project Management Platform

A **Trello-style** web application for teams to organise work in workspaces, projects and task lists.

![DreamTask demo](docs/dreamtask-demo.gif)

▶️ [Watch the full demo (4 min)](docs/dreamtask-demo.mp4)

| Landing page | Projects | Task board |
|---|---|---|
| ![landing](docs/landing.jpg) | ![projects](docs/projects.jpg) | ![task board](docs/task-board.jpg) |

## Features
- Authentication and four user roles with different permissions
- Workspaces, teams, projects and task cards
- Live search and notifications
- REST API documented in **OpenAPI**
- Indexes and query tuning for task and project searches

## Design
| Sitemap | Wireframe |
|---|---|
| ![sitemap](https://raw.githubusercontent.com/Alberto-Serra/LBAW-images/main/SITEMAP2.drawio.png) | ![wireframe](https://raw.githubusercontent.com/Alberto-Serra/LBAW-images/main/wireframe1.png) |

| Actors | Data model (UML) |
|---|---|
| ![actors](https://raw.githubusercontent.com/Alberto-Serra/LBAW-images/main/actors.png) | ![uml](https://raw.githubusercontent.com/Alberto-Serra/LBAW-images/main/uml.png) |

More wireframes: [2](https://raw.githubusercontent.com/Alberto-Serra/LBAW-images/main/wireframe2.png) · [3](https://raw.githubusercontent.com/Alberto-Serra/LBAW-images/main/wireframe3.png) · [4](https://raw.githubusercontent.com/Alberto-Serra/LBAW-images/main/wireframe4.PNG)

## Stack
Laravel (PHP) · PostgreSQL · Blade templates · Docker

## Run
```bash
docker compose up
```

---
Academic project developed at FEUP (Faculty of Engineering, University of Porto) as part of the Informatics and Computing Engineering programme.
