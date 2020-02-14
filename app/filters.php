<?php

/**
 * Theme filters.
 *
 * @copyright https://roots.io/ Roots
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter(
    'excerpt_more', function () {
        return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
    }
);

add_filter(
    'acf/fields/google_map/api', function ($api) {
        if (env('GOOGLE_MAPS_KEY')) {
            $api['key'] = env('GOOGLE_MAPS_KEY');
        }
        return $api;
    }
);
