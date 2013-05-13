<?php

namespace Emmetog\Cache;

/**
 * The CacheInterface interface.
 * 
 * All cache types should implement this interface.
 */
interface CacheInterface
{

    /**
     * Gets a value from the cache.
     * 
     * @param string $key The key under which the value was stored.
     * 
     * @return mixed|null The value if it was set or null if none was ever set.
     */
    public function get($key);

    /**
     * Set a value in the cache.
     * 
     * @param string $key The name to store the value under.
     * @param mixed $value The value to store.
     * @param integer $expiration_seconds The time-to-live for the value.
     */
    public function set($key, $value, $expiration_seconds);

    /**
     * Delete a value from the cache.
     * 
     * @param string $key The name of the value.
     */
    public function delete($key);

    /**
     * Checks if a key is set in the cache.
     * 
     * @param string $key The key to check.
     * 
     * @return boolean True if the key has a value set, false if not.
     */
    public function exists($key);

    /**
     * Completely empties everything from the cache.
     */
    public function flush();
}

?>
