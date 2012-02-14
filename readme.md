Memcached Cache engine for CakePHP
===

This is an alternative memcached cache engine to the memcache engine shipped by default with cakePhp.
Default one uses the [memcache extension](http://ca.php.net/manual/en/book.memcache.php), whereas this one uses the [memcached extension](http://ca.php.net/manual/en/book.memcached.php). (notice the **d**)

Current version of the memcached extension (1.0.2), as well as the next beta (2.
0.0b2) implements a very basic `getStats()`, that doesn't allow retrieval of the list of keys stored in cache.   
`Cache::clear()` is thus impossible, and **not** implemented in this engine. 

If `Cache::clear()` support is primordial to you, uses the memcache engine shipped with CakePhp.

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