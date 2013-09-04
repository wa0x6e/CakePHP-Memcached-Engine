# Memcached Cache engine for CakePHP [![Build Status](https://travis-ci.org/kamisama/CakePHP-Memcached-Engine.png)](https://travis-ci.org/kamisama/CakePHP-Memcached-Engine) [![Coverage Status](https://coveralls.io/repos/kamisama/CakePHP-Memcached-Engine/badge.png)](https://coveralls.io/r/kamisama/CakePHP-Memcached-Engine) [![Latest Stable Version](https://poser.pugx.org/kamisama/cakephp-memcached-engine/v/stable.png)](https://packagist.org/packages/kamisama/cakephp-memcached-engine)

This is an alternative memcached cache engine to the memcache engine shipped by default with cakePhp.
Default one uses the [memcache extension](http://ca.php.net/manual/en/book.memcache.php), whereas this one uses the [memcached extension](http://ca.php.net/manual/en/book.memcached.php). (notice the **d**)

## Background

### Benefits of Memcached over Memcache extension


* Allow binary protocol
* Increment/Decrement a compressed key
* Uses igbinary for serialization (memcached has to be compiled with --enable-igbinary)

Igbinary is the big win of the memcached extension.

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

### For CakePHP 2.2, 2.3 and 2.4

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
    
### For CakePHP 2.5+

As of CakePHP 2.5, this memcached engine will be included in the core by default. No installation required.

### For CakePHP 2.0 and 2.1

Since defining cache engine in a plugin is not supported yet on these version, you have to manually copy the *MemcachedEngine.php* file located the `Lib/Cache/Engine` directory to the `Lib/Cache/Engine` directory (create it if needed) in your `app` folder, and use it in your cache configuration :

	Cache::config('default', array('engine' => 'Memcached'));

## Notes

Binary protocol is disabled due to a Memcached [issue](https://github.com/php-memcached-dev/php-memcached/issues/21) with increment/decrement

## Changelog

####Ver 0.8 (2013-09-04)

* Minor code optimization
* Throw a CacheException when trying to use authentication with Memcached extension installed without SASL support

> **NOTE**: As of CakePHP 2.5, MemcachedEngine v0.8 will be included into the core.


####Ver 0.7 (2013-08-26)

* Merge AmazonElastiCache support back into MemcachedEngine
* Coding standard fixes

####Ver 0.6 (2013-08-26)

* Disable binary protocol due to a Memcached issue with increment/decrement [view issue](https://github.com/php-memcached-dev/php-memcached/issues/21)
* Add tests
* Add missing comma
* Add groups support
* Use `Memcached::getAllKeys()` to manage cache clearing

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