<?php

    namespace Roots\ParentTheme\Helpers;

    class Storage {

        private static $_path = 'wp/wp-content/storage';

	    /**
         * Check if a file exists in storage.
         *
         * @param $file
         * @return bool
         */
        public static function has($file) {
            if ( file_exists(self::$_path.'/'.$file) ) {
                return true;
            }
            return false;
        }

	    /**
         * Create a new (text based) file in storage.
         *
         * @param $file
         * @param string $contents
         * @return bool
         */
        public static function create($file, $contents = '') {
            if ( strstr($file,'/') ) {
                $dirs = explode('/',$file);
                array_pop($dirs);
                $prefix = self::$_path;
                for ( $i = 0; $i < count($dirs); $i++ ) {
                    if ( !file_exists($prefix.'/'.$dirs[$i]) && !is_dir($prefix.'/'.$dirs[$i]) ) {
                        mkdir($prefix.'/'.$dirs[$i]);
                    }
                    $prefix = $prefix.'/'.$dirs[$i];
                }
            }
            $file = fopen(self::$_path.'/'.$file, 'w');
            if ( $file ) {
                fwrite($file,$contents);
                fclose($file);
                return true;
            }
            return false;
        }

	    /**
         * Return the contents of a (text based) file from storage.
         * @param $file
         * @return bool
         */
        public static function read($file) {
            if ( file_exists(self::$_path.'/'.$file) ) {
                return file_get_contents(self::$_path.'/'.$file);
            }
            return false;
        }

    }