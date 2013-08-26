# Memcached Cache engine for CakePHP

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
    
## Notes

Binary protocol is disabled due to a Memcached [issue](https://github.com/php-memcached-dev/php-memcached/issues/21) with increment/decrement

## Changelog

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