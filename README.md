# AssoConnect - Remote technical test

* **DO NOT FORK THIS REPO**
* **DO NOT OPEN A PULL REQUEST**

## Context

This project contains a basic Docker configuration to run:
* A minimal installation of **Symfony5** running under **PHP8.0**, to serve as a **RESTful API** for a blogging CMS;
* A **CreateReactApp** starter instantiated with Typescript;
* A **Mysql8** server with and **Adminer** web interface.

## TODO before the test

It is very important that you do these tasks before the beginning of the test. We don't want you to spend some time struggling with your development environment. You will need all the time you can have to go as far as possible in the instructions.


1. Install [Docker engine](https://docs.docker.com/install/) and [Docker Compose](https://docs.docker.com/compose/install/) to their latest versions for your OS. (see [Install Docker](#install-docker))
1. Clone the project in your local environment.
1. Copy, if needed the `docker-compose.override.dist.yml` to `docker-compose.override.yml` to override the default docker configuration :
For Mac and Windows users, there is some commented changes to optimize the loading of the stack. You will have to install the vendor and the node_modules locally so your editor can have type hinting.
1. Build the Docker containers by running `docker compose build` (or `docker-compose.exe build` for Windows from the `Docker Quickstart terminal`) in the root folder of the project
1. Launch the containers by running `docker compose up` (or `docker-compose.exe up` from the `Docker Quickstart terminal` for Windows) in the root folder of the project
1. Make sure the project is running correctly :
   * `GET localhost:8001/blog` should **return this JSON** :
   ```json
   {
      "message":"Welcome to your new controller!",
      "path":"src/Controller/BlogController.php"
   }
   ```
   *  Running `docker compose exec php /usr/src/backend/vendor/bin/phpunit` should show **1 successful test**
1. Give us your **Github username** so we can add you as a collaborator.

> If you are running Docker under Windows, the address your site will be accessible is not localhost, but an IP you can find in the first lines of the `Docker Quickstart Terminal` when you open it.

###  Tuning Docker configuration
By default, the apps are available at:
* http://localhost:8001 for the Symfony App;
* http://localhost:3001 for the React App;
* http://localhost:8081 for the Adminer interface.

And the MySQL installation comes with the user `root`, password `root`, and `mysql` as a server host.

If you know what you're doing, and want to modify the ports defined, you can update the values in the `.env` file at the root of the repo.

## TODO after the test

1. Push your code to a private repositoy you own whitout forking this repo
2. Invite `@sylfabre` to this private repository

---
## Troubleshooting
### 1. How to run a PHP command
To run a command (like a Symfony or Composer command), you will need to execute it via `docker compose`, prefixing it with `docker compose exec php`.

For example, to create a database with the MySQL connection, you will have to run `docker compose exec php php bin/console doctrine:database:create`.
To add a package to Composer, you will have to run `docker compose exec php composer require <your-package>`

### 2. How to connect to the MySQL container
The connection to your database URL is managed throught the `DATABASE_URL` set in the `apps/backend/.env` file. Because we are in a Docker environment, with our services running in distinct containers, you have to reference the MySQL container for the connection :

`DATABASE_URL=mysql://root:root@mysql:3306/db_name`

Note the **mysql@3306** referencing the port 3306 from the `mysql` container.

### 3. Error in YAML file when running a `docker compose` command
If you have an error looking like:
```bash
ERROR: The Compose file './../docker-compose.override.yml' is invalid because:
...
...
```
Check that you are running your command from the **root** folder of the Docker installation and not a subfolder.

### 4. Problem connecting to the Docker Daemon socket
If you're facing "Couln'd connect to Docker Daemon at http+docker://localunixsocket — is it running?" error, refer to
  [this help](https://medium.com/developer-space/if-you-faced-an-issue-like-couldnt-connect-to-docker-daemon-at-http-docker-localunixsocket-is-27b35f17d09d))

## Install Docker <a href="install-docker"></a>
### Windows
If you have a recent enough Windows, you can download and install [Docker Desktop for Windows](https://docs.docker.com/docker-for-windows/install/).

If you don't meet the system requirements written on this page, you will have to download the older version [Docker toolbox](https://github.com/docker/toolbox/releases). Download and execute the most recent `.exe` from this list.

If you have an error while launching `Docker Quickstart Terminal` afterwards, it might be because of an outdated VirtualBox version. Try downloading the latest version from the [VirtualBox website](https://www.virtualbox.org/wiki/Downloads).



### Ubuntu
You can follow this good tutorial for installing [Docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04) and [Docker Composer](https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-ubuntu-18-04).

Follow [this link](https://medium.com/developer-space/if-you-faced-an-issue-like-couldnt-connect-to-docker-daemon-at-http-docker-localunixsocket-is-27b35f17d09d) to avoid using sudo in the docker context if it's not already the case.
