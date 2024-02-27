# Installation

This Project uses docker system to run, but you can also run without docker just skip the steps of docker commands.

## Setp 1: Configure .env file

Copy the .env.example to .env and change to your configs 

## Step 1: Build and stat the containers

Build the containers

```
docker-compose build
```
## Step 2: Install dependencies

If

### Domain Driven Design

- Application: Holds the application-specific logic, including command and handler pairs for each use case.
- Domain: Contains the core business logic, entities, repositories, and services. Contains common object.
- Infrastructure: Implementations of repositories that interact with databases or external services. Communication with what is outside your application, like the database
- Presentation: Manages the user interface and interactions with external systems. Views or text resources.

