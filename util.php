<?php

/**
 * Utility functions
 */
namespace Treffynnon\Util {
    /**
     * Force a variable to be an array
     * @param mixed $array
     * @return array
     */
    function ensure_array($array) {
        return is_array($array) ?
                $array :
                [$array];
    }
}
