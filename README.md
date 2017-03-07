# commodity-apis
The Commodity APIs contains logic to APIs that can be re-used easily by a lot of organizations.


## Development
We use Vagrant to create the virtual environment of our development environment.  To load the dev environment using Vagrant, execute this code:

```bash

//create the VM:
vagrant up;

//ssh in the VM:
vagrant ssh;

//go at the root of our project:
cd /vagrant;

```

## Compile
To compile a recipe into PHP code, simply execute this command:

```bash

php vendor/bin/irestful compile http://127.0.0.1:8080 ./src/iRESTful/CommodityAPIs/Accounts/CRUD/recipe.json ./bin;

```

## Running the Docker image:
To run the docker image, we use docker-compose.  Execute the docker-compose recipe using this command:

```bash

//go in the generated code directory:
cd /vagrant/bin;

//install and start the application:
php start.php;

//stop the application:
php stop.php;

```

## Run the unit tests:
To run the unit tests, execute this command:

```bash

//go at the root of our project:
cd /vagrant;

//execute the unit tests:
php vendor/bin/phpunit --testsuite=unit;

```

## Watching applications
If you are working on the application and want to auto-compile while you work, simply execute this command.  It will auto-compile every time you save.

```bash

php vendor/bin/irestful watch http://127.0.0.1:8080 ./src ./bin;

```

## Building images
To build the docker images, simply run this command.

```bash

php vendor/bin/irestful build http://127.0.0.1:8080 ./src ./bin;

```

## Pushing docker images to the repository
To create a new version, simply execute this command.  It will render all the commands to run to push all the docker images to your docker repository.  You'll also need to login to your docker repository if not done already.

```bash

//login to your docker repository.  If you are already logged in, just skip this step:
docker login;

//run the push command:
php vendor/bin/irestful push ./src;

```
