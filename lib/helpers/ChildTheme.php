<?php

namespace Roots\ParentTheme\Helpers;

class ChildTheme {

    /**
     * Returns the absolute path to the child theme directory.
     * @return string
     */
    public static function path() {
        return dirname( get_bloginfo('stylesheet_url') );
    }

    /**
     * Includes a partial theme file. Optionally, an array of variables can be provided.
     * @param $path
     * @param null $vars
     */
    public static function partial($path, $vars = null) {
        if ( is_array($vars) ) {
            foreach ( $vars as $k => $v ) {
                $$k = $v;
            }
        }
        include 'wp/wp-content/themes/child-theme/partials/'.str_replace('.','/',$path).'.php';
    }

}