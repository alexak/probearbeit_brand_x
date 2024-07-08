
# Symfony demo project

## Installation

This project uses Docksal. Docksal is a docker tool which provides different docker containers. 
Formally it creates 3 different containers: 
* cli - php executable (we are using version 8.3.6) 
* db - database container (we are using mysql 8.0)
* web - webserver (we are using apache 2.4)

Originally docksal is used for local Drupal developpment but it can also be used for other projects. 
Further information can be found on their webpage https://docs.docksal.io/ .Docksal comes with a bash tool fin 
allowing container management from bash. 

In order to get the project run different steps must be run:

###1. Initialise the project stack:
Switch to the project folder and run `fin init`
This will create the needed docker containers with their configurations. Be carefull if you need to rerun this command
hence you will lose all database entries. 

###2. Run composer
The project has 3 different branches: main (simple symfony installation), manuel (a manually created api controller)
and apiplatform (symfony with api platform). On first step, we will need the manuel one. So we will checkout the manual branch
`git checkout manuel`
Execute `fin composer install` within your project folder. This will download all needed Symfony bundles.

###3. Synchronise Database
Execute `fin exec php bin/console doctrine:migrations:migrate` in your project folder. This will synchronize
Symfony Doctrine with the database and create the Employee table. Fin provides a CLI tool to access to your database:
`fin db cli`

###4. Start Docker containers
Execute `fin up` to start the docker containers. You will need to execute this step each time when you want to 
access to the project. This command starts php Container, Webserver and database.

## Tests
The demo project exposes an employee API. This one has different endpoints:
* POST /api/employee
* GET /api/employee
* GET /api/employee/{id}
* DELETE /api/employee/{id}

### POST /api/employee
This endpoint accepts a csv file such as [import.csv](https://t36654621.p.clickup-attachments.com/t36654621/cc240282-787a-4c10-9ee5-93e9f65f4128/import.csv)
You can test the endpoint with `curl -X POST -F 'file=@/<your path>/import.csv' http://probearbeit-brand-x.docksal/api/employee`
Where "your path" is the path where the csv file is locaded.

### GET /api/employee
This endpoint returns all stored employees. You can test this endpoint by using: `curl -X GET  http://probearbeit-brand-x.docksal/api/employee`

### GET /api/employee/{id}
This endpoint returns an employee for a given id. This endpoint can be tested by using: 
`curl -X GET  http://probearbeit-brand-x.docksal/api/employee/<id>`
Where <id> is the Id of the database row you want to access to. 

### DELETE /api/employee/{id}
This endpoint deletes an employee with a given Id. This endpoint can be tested with:
`curl -X DELETE  http://probearbeit-brand-x.docksal/api/employee/<id>`
Where <id> is the Id of the database row you want to delete.

## Thoughts
This project is a demo project only and should not be used in production. It can be improved by multiple ways:
* __Security__: For simplicity purposes, security is completely omitted. In real live, we would need an authentication
  method, such as a bearer token or username/password. Furthermore, the project runs using http, in real world 
  application, we should use https encryption, of curse.


* __The file handling should be outsourced in a separate service__, for example "EmployeeCsvHandlerService". This has would 
  have two non negligibles advantages. The first one would be that the controller is responsable handling http requests, 
  only - not for the data handling itself. The second advantage would be that the file handling code could be uses 
  otherwise such as in a CLI command.


* __Usage of API Platform__ [Apiplatform](api-platform.com). API Platform is a set of different bundles in order to create 
  easily API endpoints using Symfony. This works by adding specific comments within the different entities. 
  Unfortunately, the header of the provided csv file does not match with the attributes of the employees entity. 
  Therefore, we need a specific file parser intercepting the request and matching the different attributes. 
  A symfony installation with api platform can be found on the apiplatform branch (`git checkout apiplatform`).
  Unfortunally, the file handler isn't implemented here yet. 


* __Tests__: In order to maintain code quality and avoid regressing errors, it could be benefit to implement automatic 
 tests, similar to the manuel ones described above - for example by using php unit tests. The tests should cover file 
 handling and implementation tests. These could be run just before commiting new code on git.


# Applicant questionary

## General questions
* Focus of development work?(Backend / Frontend / Full Stack)
* Average Team Size?
* Operation System?
* How many years of work experience with symfony or similar framework?
* When are you available to work for us?

## Rated questions
Ratings possible:
* 0: Never heard of
* &#10003; I know the basics, no active usage in my projects
* &#10003; &#10003; Good knowledge, rare use in my daily work
* &#10003; &#10003; &#10003;: Advanced knowledge, often used on a professional level


* PHP 8+ experience &#10003; &#10003;
* PHP OOP experience &#10003; &#10003; &#10003;
* PHP strict typing + type hinting? &#10003; &#10003; &#10003;

###Symfony related questions
* Symfony experience ✔✔✔
* Symfony forms experience ✔✔
* PSR16 cache experience ✔
* Events + Subscribers experience ✔
* Symfony messages + handlers experience ✔
* REST API experience ✔✔✔
* Dependency injection experience ✔✔
* Composition over inheritance ✔
* Skinny controllers ✔✔
* ORM experience ✔✔✔
* PHPStorm experience ✔✔✔
* MySQL experience ✔✔✔
* Composer experience ✔✔✔
* Webpack / yarn / nodejs experience ✔
* CLI experience ✔✔✔
* Vue / React experience ✔✔
* SCSS experience ✔✔✔
* Native Javascript experience ✔✔✔
* Ajax request handling experience? ✔✔✔
* Docker / Compose experience? ✔✔
* ITSM tools experience? (Gira, Trello, etc.) ✔✔✔