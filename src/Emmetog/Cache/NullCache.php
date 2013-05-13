<?php

namespace Emmetog\Cache;

use Emmetog\Cache\CacheInterface;

/**
 * This cache class does not actaully cache anything, but it can be used
 * anywhere a real cache can.
 *
 * @author Emmet O'Grady <emmet789@gmail.com>
 */
class NullCache implements CacheInterface
{

    public function set($key, $value, $expiration_seconds)
    {
        return true;
    }

    public function get($key)
    {
        return null;
    }

    public function exists($key)
    {
        return false;
    }

    public function delete($key)
    {
        return null;
    }

    public function flush()
    {
        return true;
    }

}

?>
