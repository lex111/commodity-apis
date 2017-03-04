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

php vendor/bin/irestful-api-compiler http://127.0.0.1:8080 ./src/iRESTful/Logs/CRUD/recipe.json ./bin;

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
php vendor/bin/phpunit --testsuite=unit .;

```

## Create a new version:
To create a new version, leave Vagrant.  Then, using the Dockerfile of the project, execute this code.  Make sure to modify VERSION by the right version number.

```bash

//go in the crud api generated code directory:
cd bin;

//build a new version:
docker build -t irestful/log-crud-api:VERSION .

//push it to the docker registry:
docker push irestful/log-crud-api:VERSION

```
