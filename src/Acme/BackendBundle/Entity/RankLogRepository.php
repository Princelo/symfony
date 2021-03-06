<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Snc\RedisBundle\Doctrine\Cache\RedisCache;
use Predis\Client;

/**
 * RankLogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RankLogRepository extends EntityRepository
{
    public function getIntCountRanked($cache_time = 0)
    {
        $query = $this->getEntityManager()
            ->createQuery(
            'SELECT COUNT(l.id) - 1 FROM AcmeBackendBundle:RankLog l'
            );
        if($cache_time > 0) {
            $predis = new RedisCache();
            $predis->setRedis(new Client());
            $cache_lifetime = $cache_time;
            $query
                ->setResultCacheDriver($predis)
                ->setResultCacheLifetime($cache_lifetime);
        }
        return $query->getSingleScalarResult();
    }

    public function getIntLatestTermNo($cache_time = 0)
    {
        $query = $this->getEntityManager()
            ->createQuery(
            "SELECT l.intTermNo FROM AcmeBackendBundle:RankLog l ORDER BY l.id DESC"
            )
            ->setMaxResults(1);
        if($cache_time > 0) {
            $predis = new RedisCache();
            $predis->setRedis(new Client());
            $cache_lifetime = $cache_time;
            $query
                ->setResultCacheDriver($predis)
                ->setResultCacheLifetime($cache_lifetime);
        }

        return $query->getSingleScalarResult();
    }
}
