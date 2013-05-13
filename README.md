emmetog/cache
=====

A collection of PHP classes which act as caches.  This package has an interface
and several classes which implement it.  At the moment there are classes for the
following types of cache:

*   Memcached *(requires the php5-memcached package to be installed on your system)*
*   Registry *(uses static variables to cache things for one PHP execution only)*
*   NullCache *(can be used anywhere any other cache can but doesn't actually cache
anything)*

This package has no other dependancies, it can easily be used on it's own.

Installation
------------

This package uses [Composer](http://getcomposer.org/), to use it just add it to
your composer.json file.

For example:

    "require": {
        "emmetog/cache":    "1.0.*",
    }

Then just create the object you want (careful with namespaces) and use it, for
example:

    $registry = Emmetog\Cache\Registry::getInstance();
    
    $registry->set('hello', 'world');

    // $cachedValue will contain the string "world".
    $cachedValue = $registry->get('hello');

This package follows the [semantic versioning](http://semver.org/) guidelines.