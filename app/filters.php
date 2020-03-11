<?php

/**
 * Theme filters.
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

add_filter(
    'wpsrd_post_types_list',
    function ($postTypes) {
        $postTypes[] = 'tariff';
        return $postTypes;
    }
);

// add_filter(
//     'soil/relative-url-filters',
//     function ( $root_rel_filters ) {
//         if (false !== strpos($_SERVER['REQUEST_URI'], '/graphql')) {
//             $root_rel_filters = array_diff($root_rel_filters, ['the_permalink', 'wp_get_attachment_url']);
//         }

//         return $root_rel_filters;
//     },
//     10,
//     1
// );

add_filter(
    'wp_get_attachment_image_src',
    function ( $image ) {
        if (false !== strpos($_SERVER['REQUEST_URI'], '/graphql')
            && $image
            && isset($image[0])
            && 0 === strpos($image[0], '/app/uploads/')
        ) {
            $image[0] = \str_replace('/app/uploads/', '/', $image[0]);
        }

        return $image;
    },
    10,
    1
);


add_filter(
    'wp_calculate_image_srcset', function ($sources) {
        foreach ((array) $sources as $source => $src) {
            $sources[$source]['url'] = \network_home_url() . $src['url'];
        }
        return $sources;
    }, 20
);

add_filter(
    'option_wp_graphql_gutenberg_block_types',
    function ($block_types) {
        $index = array_search('core/pullquote', array_column($block_types, 'name'));
        if (false !== $index) {
            $block_type = $block_types[$index];
            $deprecated_attributes = array_column($block_type['deprecated'], 'attributes');
            foreach ($deprecated_attributes as $i => $deprecated_set) {
                if (\array_key_exists('figureStyle', $deprecated_set)) {
                    unset($block_type['deprecated'][$i]['attributes']['figureStyle']);
                }
            }
            $block_types[$index] = $block_type;
        }
        return $block_types;
    },
    10
);
