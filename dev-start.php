<?php
$compiler = 'php vendor/bin/irestful-api-compiler';
$compilerServer = 'http://127.0.0.1:8080';
$scriptBasePath = './src/iRESTful/CommodityAPIs';
$compileTo = './bin';
$recipeFileName = 'recipe.json';

$cleanBin = function($dir) use(&$cleanBin) {

    if (!is_dir($dir)) {
        return;
    }

    $objects = scandir($dir);
    foreach ($objects as $oneObject) {

        if ($oneObject == "." || $oneObject == "..") {
            continue;
        }

        $path = $dir.'/'.$oneObject;
        if (is_dir($path)) {
            $cleanBin($path);
            continue;
        }

        unlink($path);
    }

    rmdir($dir);
};

$replaceUppercase = function($name, $prefix) {
    $matches = [];
    preg_match_all('/[A-Z]+/s', $name, $matches);
    foreach($matches[0] as $oneLetter) {
        $name = str_replace($oneLetter, $prefix.strtolower($oneLetter), $name);
    }

    if (strpos($name, $prefix) === 0) {
        $name = substr($name, 1);
    }

    return $name;
};

$execute = function($action, $command) {

    echo \PHP_EOL."+++++++++++++++++++++++++++++++++++++++++++++++++++++".\PHP_EOL;
    echo "-> ".$action." +++ Executing: ".$command.\PHP_EOL;
    echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++".PHP_EOL;
    system($command);
    echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++".PHP_EOL;

};

$compileOne = function($path) use(&$compiler, &$compilerServer, &$scriptBasePath, &$compileTo, &$recipeFileName, &$execute) {
    $command = $compiler.' '.$compilerServer.' '.$scriptBasePath.'/'.$path.'/'.$recipeFileName.' '.$compileTo.'/'.$path.';';
    $execute('Compiling', $command);
};

$compileMultiple = function(array $paths) use(&$compileOne) {
    foreach($paths as $onePath) {
        $compileOne($onePath);
    }
};

$paths = [
    'Accounts/CRUD'
];

//delete the bin directory:
$cleanBin($compileTo);

//run the unit tests:
$execute('Unit Tests', 'vendor/bin/phpunit --testsuite=unit;');

//compile:
$compileMultiple($paths);

//start/stop the images to make sure the test works, then compile the docker image:
foreach($paths as $onePath) {

    //create path:
    $binPath = $compileTo.'/'.$onePath;
    $srcPath = $scriptBasePath.'/'.$onePath;

    //start:
    $command = 'cd '.$binPath.'; php ./start.php';
    $execute('Starting @ Dev', $command);

    //stop:
    $command = 'cd '.$binPath.'; php ./stop.php';
    $execute('Stopping @ Dev', $command);

    //delete the code and re-compile:
    $cleanBin($binPath);
    $compileOne($onePath);

    //build the docker image:
    $recipeData = json_decode(file_get_contents($srcPath.'/'.$recipeFileName), true);
    $exploded = explode('/', $recipeData['name']);
    $imageName = $replaceUppercase($exploded[1], '-');
    $organizationName = strtolower($exploded[0]);

    $command = 'cd '.$binPath.'; docker build -t '.$organizationName.'/'.$imageName.':'.$recipeData['version'].' .';
    $execute('Build Docker Image', $command);

    //delete the code and re-compile:
    $cleanBin($binPath);
    $compileOne($onePath);

    //start:
    $command = 'cd '.$binPath.'; php ./start.php';
    $execute('Starting @ Dev', $command);
}
