<?php 

$directory = '/Users/svenschrodt/projects/parser_stuff/bantam/src/com/stuffwithstuff/bantam';
$array = [];
$prfx = '/Users/svenschrodt/projects/parser_stuff/bantam/src/com/stuffwithstuff/bantam/';
$fileSPLObjects =  new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory),
                RecursiveIteratorIterator::CHILD_FIRST
            );
try {
    foreach( $fileSPLObjects as $fullFileName => $fileSPLObject ) {
        #if (!$fileSPLObject->isDot()) 
            print( ucfirst(str_replace([$prfx, '.java'], ['', '.php'],$fullFileName)). PHP_EOL);
    }
}
catch (UnexpectedValueException $e) {
    printf("Directory [%s] contained a directory we can not recurse into", $directory);
}


#print_r($array);