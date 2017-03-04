<?php
$compiler = 'php vendor/bin/irestful-api-compiler';
$compilerServer = 'http://127.0.0.1:8080';
$scriptBasePath = './src/iRESTful/CommodityAPIs';
$compileTo = './bin';
$recipeFileName = 'recipe.json';

$hashDirectory = function($directory) use(&$hashDirectory) {

    if (!is_dir($directory)) {
        return null;
    }

    $files = [];
    $dir = dir($directory);
    while (false !== ($file = $dir->read())) {

        if (($file == '.') || ($file == '..')) {
            continue;
        }

        $path = $directory.'/'.$file;
        if (is_dir($path)) {
            $files[] = $hashDirectory($path);
            continue;
        }

        $files[] = md5_file($path);
    }

    $dir->close();
    return md5(implode('', $files));
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

$paths = [
    'Accounts/CRUD'
];

$hashes = [];
while(true) {

    foreach($paths as $onePath) {

        $filePath = $scriptBasePath.'/'.$onePath;
        if (!isset($hashes[$onePath])) {
            $hashes[$onePath] = $hashDirectory($filePath);
            continue;
        }

        $previousHash = $hashes[$onePath];
        $newHash =  $hashDirectory($filePath);

        //if the hashes are not the same, recompile:
        if ($previousHash != $newHash) {
            $compileOne($onePath);
            $hashes[$onePath] = $newHash;
            continue;
        }
    }

    //sleep for 1 second:
    sleep(1);

}
