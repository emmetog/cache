<?php

namespace Emmetog\Cache;

use Emmetog\Cache\CacheInterface;

/**
 * The Memcached cache.
 * 
 * This class connects to a memcached server and requires the 'php5-memcached'
 * package to be installed on the system.
 * 
 * This class is simply a wrapper for the \Memcached class.
 */
class Memcached implements CacheInterface
{

    /**
     * The prefix to use when storing strings in Cache
     * 
     * @var string
     */
    private $prefix;

    /**
     * The instance of the memcached object.
     * 
     * @var \Memcached 
     */
    private $memCacheInstance;

    public function __construct($prefix, $memcache_object)
    {
        $this->prefix = $prefix;

        $this->memCacheInstance = $memcache_object;
        
        if(!class_exists('\Memcached')) {
            throw new \RuntimeException('The php extention Memcached is not installed, the Emmetog\Cache\Memcached class will not work without it');
        }

        $this->connect();
    }

    /**
     * Connect to a memcached server.
     * 
     * @param string $ip_address The ip address of the memcached server to connect to.
     * @param integer $port The port the memcached server to connect to.
     */
    public function connect($ip_address = '127.0.0.1', $port = 11211)
    {
        $this->memCacheInstance->addServer($ip_address, $port);
    }

    /**
     * Set a value in the Memcached cache.
     * 
     * @param string $key The name to store the value under.
     * @param mixed $value The value to store.
     * @param integer $expiration_seconds The time-to-live for the value.
     */
    public function set($key, $value, $expiration_seconds = 3600)
    {
        $this->memCacheInstance->set($this->prefix . $key, $value, $expiration_seconds);
    }

    /**
     * Gets a value from the Memcached cache.
     * 
     * @param string $key The key under which the value was stored.
     * 
     * @return mixed|null The value if it was set or null if none was ever set.
     */
    public function get($key)
    {
        $value = $this->memCacheInstance->get($this->prefix . $key);
        if ($value === false || $this->memCacheInstance->getResultCode() == \Memcached::RES_NOTFOUND)
        {
            return null;
        }
        return $value;
    }

    /**
     * Delete a value from the Memcached cache.
     * 
     * @param string $key The name of the value in the Registry.
     */
    public function delete($key)
    {
        $this->memCacheInstance->delete($this->prefix . $key);
    }

    /**
     * Checks if a key is set in the Memcached cache.
     * 
     * @param string $key The key to check.
     * 
     * @return boolean True if the key has a value set, false if not.
     */
    public function exists($key)
    {
        $this->memCacheInstance->get($this->prefix . $key);
        $resultCode = $this->memCacheInstance->getResultCode();

        return ($resultCode != \Memcached::RES_NOTFOUND);
    }

    /**
     * Completely empties everything from the Memcached cache.
     */
    public function flush()
    {
        $this->memCacheInstance->flush();
    }

}
?>
