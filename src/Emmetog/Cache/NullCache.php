<?php

namespace Emmetog\Cache;

use Emmetog\Cache\CacheInterface;

/**
 * This cache class does not cache anything, but it can be used anywhere a real cache can.
 *
 * @author Emmet O'Grady <emmet789@gmail.com>
 * @package 
 */
class NullCache implements CacheInterface
{

    public function set($key, $value, $expiration_seconds)
    {
        return true;
    }

    public function get($key)
    {
        return false;
    }

    public function exists($key)
    {
        return false;
    }

    public function delete($key)
    {
        return true;
    }

    public function flush()
    {
        return true;
    }

}

?>
