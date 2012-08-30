Memcached Cache engine for CakePHP
===

This is an alternative memcached cache engine to the memcache engine shipped by default with cakePhp.
Default one uses the [memcache extension](http://ca.php.net/manual/en/book.memcache.php), whereas this one uses the [memcached extension](http://ca.php.net/manual/en/book.memcached.php). (notice the **d**)


Benefits of Memcached over Memcache extension
---

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

Install
--
Just drop the *MemcachedEngine.php* file in you *app/Lib/Cache/Engine/* directory, and use `$engine => 'Memcached'` in your `Cache::config`.

Notes
--
Current version of the memcached extension (2.1.0) implements a very basic `getStats()`, that doesn't allow retrieval of the list of keys stored in cache.   
Each key is stored in another key in memcache when `Cache::write()` is called, that's read to extract all the keys. This implementation takes more place, but there's no other solution.

Changelog
--
####Ver 0.3 (2012-08-29)
* Code formatted to Cake standard

####Ver 0.2 (2012-03-22)
* Implemented `Cache::clear()`