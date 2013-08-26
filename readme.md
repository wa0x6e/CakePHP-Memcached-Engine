# Memcached Cache engine for CakePHP

This is an alternative memcached cache engine to the memcache engine shipped by default with cakePhp.
Default one uses the [memcache extension](http://ca.php.net/manual/en/book.memcache.php), whereas this one uses the [memcached extension](http://ca.php.net/manual/en/book.memcached.php). (notice the **d**)

## Background

### Benefits of Memcached over Memcache extension


* Allow binary protocol
* Increment/Decrement a compressed key
* Uses igbinary for serialization (memcached has to be compiled with --enable-igbinary)

Igbinary is the big win of the memcached extension, and will be automatically used if available.

> Igbinary is a drop in replacement for the standard php serializer. Instead of
time and space consuming textual representation, igbinary stores php data
structures in a compact binary form. Savings are significant when using
memcached or similar memory based storages for serialized data. You can
expect about 50% reduction in storage requirement and speed is at least on par
with the standard PHP serializer. Specific numbers depend on your data, of
course.

see [https://github.com/phadej/igbinary](https://github.com/phadej/igbinary)
and [some benchmark](http://phpolyk.wordpress.com/2011/08/28/igbinary-the-new-php-serializer/)

## Installation

_[Manual]_

* Download this: [http://github.com/kamisama/CakePHP-Memcached-Engine/zipball/master](http://github.com/kamisama/CakePHP-Memcached-Engine/zipball/master)
* Unzip that download.
* Copy the resulting folder to `app/Plugin`
* Rename the folder you just copied to `Memcached`

_[GIT Submodule]_

In your app directory type:

    git submodule add -b master git://github.com/kamisama/CakePHP-Memcached-Engine.git Plugin/kamisama/Memcached
    git submodule init
    git submodule update

_[GIT Clone]_

In your `Plugin` directory type:

    git clone -b master git://github.com/kamisama/CakePHP-Memcached-Engine.git Memcached

_[Composer]_

Add *kamisama/cakephp-memcached-engine* to your composer dependencies, then run

    composer install

### Enable plugin

In 2.0 you need to enable the plugin your `app/Config/bootstrap.php` file:

    CakePlugin::load('Memcached');

If you are already using `CakePlugin::loadAll();`, then this is not necessary.

## Usage

Add this class to the CakePHP Autoloader:

    App::uses('MemcachedEngine', 'Memcached.Lib/Cache/Engine');

And then call it in your cache configuration:

    Cache::config('default', array('engine' => 'Memcached'));

This cache engine can take the following options:

	Cache::config('router', array(
		# Usual options
		'engine' => 'Memcached',
		'prefix' => 'mc_',
		'duration' => '+7 days', // Expires in 7 days, from now
		'servers' => array(
			'127.0.0.1', // Default port 11211
			'127.0.0.1:11212' // Or you can specify the port
		)
		
		# Memcached options
		'compress' => false,
		'persistent' => true,
		'persistent_id' => 'mc',
		'login' => null,
		'password => null
	));
	
### compress

*Default: `true`*  
Compress the cached data. Unlike memcache, memcache**d** can increment/decrement compressed keys

### persistent

*Default: `true`*  
Use a persistent connection to the memcached server

### persistent_id

*Default: `mc`*  
If you're using more than one persistent connection, you should assign them a different `persistent_id` each.

### login and password

*Default: `null`*  
The memcached server credidentials, if using SASL for authentication.

### Notes
Current version of the memcached extension (2.1.0) implements a very basic `getStats()`, that doesn't allow retrieval of the list of keys stored in cache.
Each key is stored in another key in memcache when `Cache::write()` is called, that's read to extract all the keys. This implementation takes more place, but there's no other solution.

## Changelog

####Ver 0.5 (2013-08-26)

* Pluginize cache engine (@josegonzalez)
* Add support for SASL authentication (@josegonzalez)

####Ver 0.4 (2013-08-18)
* Fix #6: init() a second persistent connection returns false
* Add persistent_id option to create separate persistent connection
* Skip duplicate when searching for key to clear

####Ver 0.3 (2012-08-29)
* Code formatted to Cake standard

####Ver 0.2 (2012-03-22)
* Implemented `Cache::clear()`

## License

This plugin is released under the MIT licence