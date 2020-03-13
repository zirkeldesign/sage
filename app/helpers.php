<?php

/**
 * Theme helpers.
 */

namespace App;

/**
 * Returns, wether it's a graphql request.
 *
 * @return boolean
 */
function is_graphql() : bool {
    return false !== strpos($_SERVER['REQUEST_URI'], '/graphql');
}
