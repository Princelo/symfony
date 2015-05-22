<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Snc\RedisBundle\Doctrine\Cache\RedisCache;
use Predis\Client;

/**
 * ChampionlogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChampionlogRepository extends EntityRepository
{
    public function getArrChampionlog($intZone, $intLimit, $cache_time = 0)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT
                     s.strTitle title,
                     s.arrStrArtistName artists,
                     m.strShortName voter,
                     c.timeDateTime time
                FROM AcmeBackendBundle:Championlog c
                    JOIN AcmeBackendBundle:Song s
                    WITH c.intSongId = s.id
                    JOIN AcmeBackendBundle:Member m
                    WITH c.intMemberId = m.id
                WHERE c.intZone = {$intZone}
                ORDER BY c.id DESC"
            )
            ->setMaxResults($intLimit);
        if($cache_time > 0) {
            $predis = new RedisCache();
            $predis->setRedis(new Client());
            $cache_lifetime = $cache_time;
            $query
                ->setResultCacheDriver($predis)
                ->setResultCacheLifetime($cache_lifetime);
        }
        return $query->getResult();
    }
}
