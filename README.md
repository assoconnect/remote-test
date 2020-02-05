# AssoConnect - Remote technical test

* **DO NOT FORK THIS REPO**
* **DO NOT OPEN A PULL REQUEST**

## Context

This project contains a basic Docker configuration to run:
* A minimal installation of **Symfony5** running under **PHP7.4**, to serve as a **RESTful API** for a blogging CMS;
* A **CreateReactApp** starter instantiated with Typescript;
* A **Mysql8** server with and **Adminer** web interface.


## Instructions tips

* The instructions will be sent to you by **email** at the beginning of your **2 hour** time slot.
* These instructions will not be very precise on purpose.
* We suggest you to follow the instructions in the given **order**, but you will be able to do what you feel is the most important.
* You will be able to use any relevant vendor or library (
  [Messenger](https://symfony.com/doc/current/components/messenger.html), 
  [Cache](https://symfony.com/doc/current/components/cache.html), 
  [Serializer](https://symfony.com/doc/current/components/serializer.html), 
  [MakerBundle](https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html), 
  [Validator](https://symfony.com/doc/current/components/validator.html), 
  [EventDispatcher](https://symfony.com/doc/current/components/event_dispatcher.html), 
  [Form](https://symfony.com/doc/current/components/form.html), 
  [DependencyInjection](https://symfony.com/doc/current/components/dependency_injection.html), 
  [PHPUnit Bridge](https://symfony.com/doc/current/components/phpunit_bridge.html),
  [API Platform](https://api-platform.com/)
).
* We will not run the app, do not waste time on configuration issues.
* We will focus on the code you have produced, the general logic, the choices and the quality.
* Quality will be more important than quantity.
* You will probably not have enough time to finish all the test, but we expect a minimum amount of code to review.

## TODO before the test

It is very important that you do these tasks before the beginning of the test. We don't want you to spend some time struggling with your development environment. You will need all the time you can have to go as far as possible in the instructions.

1. Install [Docker engine](https://docs.docker.com/install/) and [Docker Compose](https://docs.docker.com/compose/install/) to their latest versions for your OS
1. Clone the project in your local environment.
1. Build the Docker containers by running `docker-compose build` in the root folder of the project
1. Launch the containers by running `docker-compose up` in the root folder of the project
1. Make sure the project is running correctly :
   * `GET localhost:8000/blog` should **return this JSON** :
   ```json
   {
      "message":"Welcome to your new controller!",
      "path":"src/Controller/BlogController.php"
   }
   ```
   *  Running `docker-compose exec php /usr/src/backend/vendor/bin/phpunit` should show **1 successful test**
1. Give us your **Github username** so we can add you as a collaborator.

###  Tuning Docker configuration
By default, the apps are available at:
* http://localhost:8000 for the Symfony App;
* http://localhost:3000 for the React App;
* http://localhost:8080 for the Adminer interface.

And the MySQL installation comes with the user `root`, and password `root`.

If you know what you're doing, and want to modify the ports defined, you can update the values in the `.env` file at the root of the repo.

## TODO after the test

1. Submit your code in a **new branch**
1. We'll get your code and delete your branch to keep your work private
1. **DO NOT FORK THIS REPO**.
1. **DO NOT OPEN A PULL REQUEST**
1. Let us know when you are done
1. Send us a message explaining :
* what you have done and why you have done it this way
* what you haven't done, why you haven't done it, and how you would have done it
