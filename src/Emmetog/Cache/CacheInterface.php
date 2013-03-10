<?php

namespace Emmetog\Cache;

/**
 * The CacheInterface interface.
 * 
 * All cache types must implement this interface.
 */
interface CacheInterface
{
    public function get($key);

    public function set($key, $value, $expiration_seconds);

    public function delete($key);

    public function exists($key);

    public function flush();
}

?>
