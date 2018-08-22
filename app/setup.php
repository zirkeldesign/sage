<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'sage/preload/main.js',
        asset_path('scripts/main.js'),
        ['jquery'],
        null,
        true
    );

    wp_enqueue_style(
        'sage/preload/main.css',
        asset_path('styles/main.css'),
        false,
        null
    );
    /**
     * When CSS is loaded async, there can be style pop (since there's no CSS file to block rendering).
     * To avoid that, you can define a small subset of Critical CSS which will be inlined if your
     * main.css hasn't been cached (i.e. if this is the first time a visitor hits the site).
     */
    if (!isset($_COOKIE['CSS_CACHED']) && file_exists(locate_asset('styles/critical.css'))) {
        wp_add_inline_style(
            'sage/preload/main.css',
            file_get_contents(locate_asset('styles/critical.css'))
        );
    }

    /**
     * If you don't want to bother w/ preloading, remove the above, and uncomment these.
     */
    // wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    // wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Set a cookie so we can guess whether we've loaded
 * css or not.
 */
add_action('send_headers', function () {
    /**
     * The method used to generate this id can and should be changed so that the id will be different
     * when new CSS assets are generated. This implementation is naive, but functional.
     */
    $css_id = hash('md4', asset_path('styles/main.css'));
    if (!isset($_COOKIE['CSS_CACHED'])) {
        // If the cookie isn't set, set it.
        setcookie('CSS_CACHED', $css_id, strtotime('+30 days'), '/');
    } elseif ($_COOKIE['CSS_CACHED'] != $css_id) {
        // If the cookie doesn't match our CSS, unset it.
        setcookie('CSS_CACHED', $_COOKIE['CSS_CACHED'], 1, '/');
        unset($_COOKIE['CSS_CACHED']);
    }
});
/**
 * Preloads any scripts that we have asked to
 * preload.
 */
add_action('wp_head', function () {
    foreach (wp_scripts()->registered as $handle => $script) {
        if (strpos($handle, 'sage/preload') === 0) {
            printf('<link rel="preload" href="%s" as="script">', apply_filters('script_loader_src', $script->src));
        }
    }
});

/**
 * Preloads any styles that we have asked to preload
 */
add_filter('style_loader_tag', function ($html, $handle, $href, $media) {
    $GLOBALS['is_preloading_styles'] = false;
    if (strpos($handle, 'sage/preload') === 0 && !isset($_COOKIE['CSS_CACHED'])) {
        $GLOBALS['is_preloading_styles'] = true;
        $url = apply_filters('style_loader_src', $href, $handle);
        // @codingStandardsIgnoreStart
        return sprintf(
            '<link rel="preload" href="%1$s" as="style" type="text/css" onload="this.onload=null;this.rel=\'stylesheet\'" media="%2$s">%3$s<noscript><link rel="stylesheet" href="%1$s"></noscript>',
            $url,
            $media,
            PHP_EOL
        );
        // @codingStandardsIgnoreEnd
    }
    return $html;
}, 10, 4);

/**
 * Inline some JavaScript to handle preloading CSS.
 * Only loaded if we're actually preloading stuff!
 *
 * @link https://github.com/filamentgroup/loadCSS
 */
add_action('wp_footer', function () {
    if ($GLOBALS['is_preloading_styles'] === true) :
        $preloadPolyfill = '';
        echo '<!-- Preload Polyfill -->';
        // @codingStandardsIgnoreStart
        echo '<script type="text/javascript" charset="utf-8">/*! loadCSS. [c]2017 Filament Group, Inc. MIT License */!function(n){"use strict";n.loadCSS||(n.loadCSS=function(){});var o=loadCSS.relpreload={};if(o.support=function(){var e;try{e=n.document.createElement("link").relList.supports("preload")}catch(t){e=!1}return function(){return e}}(),o.bindMediaToggle=function(t){var e=t.media||"all";function a(){t.media=e}t.addEventListener?t.addEventListener("load",a):t.attachEvent&&t.attachEvent("onload",a),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(a,3e3)},o.poly=function(){if(!o.support())for(var t=n.document.getElementsByTagName("link"),e=0;e<t.length;e++){var a=t[e];"preload"!==a.rel||"style"!==a.getAttribute("as")||a.getAttribute("data-loadcss")||(a.setAttribute("data-loadcss",!0),o.bindMediaToggle(a))}},!o.support()){o.poly();var t=n.setInterval(o.poly,500);n.addEventListener?n.addEventListener("load",function(){o.poly(),n.clearInterval(t)}):n.attachEvent&&n.attachEvent("onload",function(){o.poly(),n.clearInterval(t)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:n.loadCSS=loadCSS}("undefined"!=typeof global?global:this);</script>';
        // @codingStandardsIgnoreEnd
    endif;
}, 99);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});
