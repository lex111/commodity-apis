# Commodity APIs
The Commodity APIs contains logic to APIs that can be re-used easily by a lot of organizations.

## Development
We use Vagrant to create the virtual environment of our development environment. To load the dev environment using Vagrant, execute this following steps:

Create the VM:
```bash
$ vagrant up
```

Login to the VM using SSH:
```bash
$ vagrant ssh
```

Go at the root of our project:
```bash
$ cd /vagrant
```

## Compile
To compile a recipe into PHP code, simply execute this command:

```bash
$ php vendor/bin/irestful compile http://127.0.0.1:8080 ./src/iRESTful/CommodityAPIs/Accounts/CRUD/recipe.json ./bin;
```

## Running the Docker image:
To run the docker image, we use docker-compose. Execute the docker-compose recipe using this steps.

Go in the generated code directory:
```bash
$ cd /vagrant/bin
```

Install and start the application:
```bash
$ php start.php
```

Stop the application:
```bash
$ php stop.php
```

## Run the unit tests

Go at the root of our project:
```bash
$ cd /vagrant
```

Execute the unit tests:
```bash
$ php vendor/bin/phpunit --testsuite=unit
```

## Watching applications
If you are working on the application and want to auto-compile while you work, simply execute this command.  It will auto-compile every time you save.

```bash
$ php vendor/bin/irestful watch http://127.0.0.1:8080 ./src ./bin
```

## Building images
To build the docker images, simply run this command.

```bash
$ php vendor/bin/irestful build http://127.0.0.1:8080 ./src ./bin
```

## Pushing docker images to the repository
To create a new version, simply execute this command.  It will render all the commands to run to push all the docker images to your docker repository.  You'll also need to login to your docker repository if not done already.

Login to your docker repository.  If you are already logged in, just skip this step:
```bash
$ docker login
```

Run the push command:
```bash
$ php vendor/bin/irestful push ./src
```
