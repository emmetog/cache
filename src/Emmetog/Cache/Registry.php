<?php

namespace Emmetog\Cache;

use Emmetog\Cache\CacheInterface;

/**
 * Stores items in a globally accessable object (in php memory).
 * 
 * It is a Singleton (it has a private contructor).
 */
class Registry implements CacheInterface
{

    /**
     * The array of items stored in the registry
     * 
     * @var array
     */
    private static $registry = array();

    /**
     * The instance of the object.
     *
     * @var Registry
     */
    private static $instance;

    /**
     * The object constructor.
     */
    private function __construct()
    {
	
    }

    /**
     * Gets the instance of the Registry object.
     * 
     * @return Registry
     */
    public function getInstance()
    {
	if (!self::$instance)
	{
	    self::$instance = new Registry();
	}

	return self::$instance;
    }

    /**
     * Set a value in the Registry cache.
     * 
     * @param string $key The name to store the value under.
     * @param mixed $value The value to store.
     * @param integer $expiration_seconds This setting is ignored in the Registry.
     */
    public function set($key, $value, $expiration_seconds = null)
    {
	self::$registry[$key] = $value;
    }

    /**
     * Gets a value from the Registry cache.
     * 
     * @param string $key The key under which the value was stored.
     * 
     * @return mixed|null The value if it was set or null if none was ever set.
     */
    public function get($key)
    {
	return (self::exists($key)) ? self::$registry[$key] : null;
    }

    /**
     * Delete a value from the Registry cache.
     * 
     * @param string $key The name of the value in the Registry.
     */
    public function delete($key)
    {
	unset(self::$registry[$key]);
    }

    /**
     * Checks if a key is set in the Registry cache.
     * 
     * @param string $key The key to check.
     * 
     * @return boolean True if the key has a value set, false if not.
     */
    public function exists($key)
    {
	return (isset(self::$registry[$key]));
    }

    /**
     * Completely empties everything from the Registry cache.
     */
    public function flush()
    {
	self::$registry = array();
    }

}

?>
