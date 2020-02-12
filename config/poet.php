<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Here you may specify the post types to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post' => [
        'tariff' => [
            'enter_title_here' => 'Enter tariff name',
            'menu_position' => 20,
            'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 514 512"><path fill="currentColor" d="M350.1 480h-48.32l-5-76.66L221 314l-10.78 166H161.9a36.94 36.94 0 0 0-33 20.42A8 8 0 0 0 136 512h240a8 8 0 0 0 7.15-11.58A36.93 36.93 0 0 0 350.1 480zm48.59-54.21l-88.35-182.32a55.73 55.73 0 0 1-.73-42.79l73.28-179.07a15.8 15.8 0 0 0-27.5-15.07L241.27 163.21a55.74 55.74 0 0 1-36.47 22.4L13.32 215.94A15.81 15.81 0 0 0 0 231.89v.23a15.8 15.8 0 0 0 14.1 15.35L203.83 268a55.78 55.78 0 0 1 37.54 20.58l130.31 153.5a15.81 15.81 0 0 0 20.53 3.63l.19-.12a15.79 15.79 0 0 0 6.29-19.8zM256 248a24 24 0 1 1 24-24 24 24 0 0 1-24 24z"></path></svg>'),
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => false,
            'show_in_graphql' => true,
            'graphql_single_name' => 'Tariff',
            'graphql_plural_name' => 'Tariffs',
            'labels' => [
                'singular' => 'Tariff',
                'plural' => 'Tariffs',
            ],
            'admin_cols' => [
                'tariff_type' => [
                    'taxonomy' => 'tariff_type'
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you may specify the taxonomies to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomy' => [
        'tariff_type' => [
            'links' => ['tariff'],
            'show_in_graphql' => true,
            'graphql_single_name' => 'TariffType',
            'graphql_plural_name' => 'TariffTypes',
            'meta_box' => 'radio',
            'hierarchical' => false,
        ],
    ],
];
