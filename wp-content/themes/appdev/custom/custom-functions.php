<?php

/**
 * The custom code that can be used to enhance the theme. Also, you can override existing functionality to provide your own functionality using WP filters.
 * Very handy for customization without touching the theme code.
 * You may want to backup and retain this file when updating the theme to retain customizations.
 *
 *
 * @package Appdev
 * @subpackage Functions
 */

/*
Credit: http://www.johannheyne.de
Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
*/

function mo_shortcode_empty_paragraph_fix($content) {
    $replace = array(
        '<p></p>' => '',
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']',
        "<br />\r[" => "\r[",
        "<br />\r\n[" => "\r\n[",
        "<br />\n[" => "\n["
    );

    $content = strtr($content, $replace);

    return $content;
}

//add_filter('the_content', 'mo_shortcode_empty_paragraph_fix');

$prefix = mo_get_prefix();
//add_action("{$prefix}_after_entry", 'mo_yarpp_related_posts', 9);


function mo_yarpp_related_posts() {
    if (function_exists('related_posts') && is_single())
        related_posts();

}

//add_filter('post_class', 'mo_add_recipe_format');

/* Make the recipe site micro formatted */
function mo_add_recipe_format($classes) {

    if (is_single()) {

        $new_classes[] = 'hrecipe';

        foreach ($classes as $value) {
            $new_classes[] = $value;
        }
        return $new_classes;
    }
    return $classes;

}


?>