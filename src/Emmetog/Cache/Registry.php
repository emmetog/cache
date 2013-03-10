<?php

namespace Emmetog\Cache;

use Emmetog\Cache\CacheInterface;

/**
 * Stores items in a globally accessable object (in php memory).
 */
class Registry implements CacheInterface
{

    /**
     * The array of items stored in the registry
     * 
     * @var array
     */
    private static $registry = array();
    
    private static $instance;

    private function __construct()
    {
    }

    public function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new Registry();
        }
        
        return self::$instance;
    }

    /**
     * 
     * @param string    $key                
     * @param mixed     $value
     * @param integer   $expiration_seconds This setting is ignored in the Registry
     */
    public function set($key, $value, $expiration_seconds = null)
    {
        self::$registry[$key] = $value;
    }

    public function get($key)
    {
        return (self::exists($key)) ? self::$registry[$key] : null;
    }

    public function delete($key)
    {
        unset(self::$registry[$key]);
    }

    public function exists($key)
    {
        return (isset(self::$registry[$key]));
    }

    public function flush()
    {
        self::$registry = array();
    }

}

?>
