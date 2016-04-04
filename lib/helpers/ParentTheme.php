<?php

namespace Roots\ParentTheme\Helpers;

class ParentTheme {

    /**
     * Returns the absolute path to the parent theme directory.
     * @return mixed
     */
    public static function path() {
        return get_template_directory_uri();
    }

}