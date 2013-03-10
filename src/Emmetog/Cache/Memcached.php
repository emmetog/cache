<?php

namespace Emmetog\Cache;

use Emmetog\Cache\CacheInterface;

class Memcached implements CacheInterface
{

    /**
     * The prefix to use when storing strings in Cache
     * 
     * @var string
     */
    private $prefix;

    /**
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

    public function connect($ip_address = '127.0.0.1')
    {
        $result = $this->memCacheInstance->addServer($ip_address, 11211);
    }

    public function set($key, $value, $expiration_seconds = 3600)
    {
        return $this->memCacheInstance->set($this->prefix . $key, $value, $expiration_seconds);
    }

    public function get($key)
    {
        $value = $this->memCacheInstance->get($this->prefix . $key);
        if ($value === false || $this->memCacheInstance->getResultCode() == \Memcached::RES_NOTFOUND)
        {
            return null;
        }
        return $value;
    }

    public function delete($key)
    {
        $this->memCacheInstance->delete($this->prefix . $key);
        return null;
    }

    public function exists($key)
    {
        $this->memCacheInstance->get($this->prefix . $key);
        $resultCode = $this->memCacheInstance->getResultCode();

        return ($resultCode != \Memcached::RES_NOTFOUND);
    }

    public function flush()
    {
        $this->memCacheInstance->flush();
    }

}
?>
