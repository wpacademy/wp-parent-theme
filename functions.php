<?php

/*
|--------------------------------------------------------------------------
| Composer autoloader
|--------------------------------------------------------------------------
*/

require 'vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Library includes
|--------------------------------------------------------------------------
|
| The $lib_includes array determines the code library included in your
| theme. Add or remove files to the array as needed.
| Please note that missing files will produce a fatal error.
|
*/

$lib_includes = [
    'lib/init.php',                                 // Theme setup
    'lib/functions.php',                            // Standalone functions
    'lib/helpers/ParentTheme.php',
    'lib/helpers/ChildTheme.php',
    'lib/helpers/Storage.php',
    'lib/helpers/Category.php',
    'lib/helpers/Post.php',
    'lib/helpers/Tag.php',

    'lib/classes/instagram/instagram.class.php'     // Simple custom Instagram class
];

foreach ($lib_includes as $file) {
    require_once($file);
}
unset($file);


/*
|--------------------------------------------------------------------------
| Class aliases
|--------------------------------------------------------------------------
|
| Some classes - helper classes in most cases - are there to add
| functionality to theme templates. To avoid having to reference these
| classes by their full namespace (and/or original class name), you can
| create aliases for them. Add them here as needed.
|
*/

class_alias('\Roots\ParentTheme\Helpers\ParentTheme','ParentTheme');
class_alias('\Roots\ParentTheme\Helpers\ChildTheme','ChildTheme');
class_alias('\Roots\ParentTheme\Helpers\Storage','Storage');
class_alias('\Roots\ParentTheme\Helpers\Category','Category');
class_alias('\Roots\ParentTheme\Helpers\Post','Post');
class_alias('\Roots\ParentTheme\Helpers\Tag','Tag');

class_alias('\Roots\ParentTheme\Classes\Instagram','Instagram');