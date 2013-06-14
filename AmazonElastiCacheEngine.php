<?php
App::uses('MemcachedEngine', 'Cache/Engine');
/**
 * Amazon ElastiCache storage engine for cache
 *
 * - Supports auto-discovery of the Amazon ElastiCache.
 * ex) app/Config/bootstrap.php
 * Cache::config('default', array(
 *     'engine' => 'AmazonElastiCache', //[required]
 *      ...
 *      'servers' => array(
 *          'php-autodiscovery.1zvgtq.cfg.use1.cache.amazonaws.com:11211' // Amazone ElastiCache Configuration Endpoint, default port 11211
 *      ), //[required]
 * ));
 *
 * @link          http://docs.aws.amazon.com/AmazonElastiCache/latest/UserGuide/Appendix.PHPAutoDiscoverySetup.html
 * @link          http://docs.aws.amazon.com/AmazonElastiCache/latest/UserGuide/AutoDiscovery.html
 * @package       Cake.Cache.Engine
 */
class AmazonElastiCacheEngine extends MemcachedEngine
{
	protected function _setOptions()
	{
		parent::_setOptions();
		$this->_Memcached->setOption(Memcached::OPT_CLIENT_MODE, Memcached::DYNAMIC_CLIENT_MODE);
	}
}

