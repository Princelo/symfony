<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Acme\BackendBundle\Entity\Constant;

/**
 * RankRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RankRepository extends EntityRepository
{
    public function getObjNewestRanklist($intZone, $intType)
    {
        if($intZone == Constant::PRCZONE)
            $strResult = 'intPRCResult';
        else if($intZone == Constant::HKTWZONE)
            $strResult = 'intHKTWResult';
        return $this->getEntityManager()
            ->createQuery(
                "SELECT s.strTitle title,
                        s.arrStrArtistName artists,
                        s.id id,
                        r.intTermNo term_no
                    FROM
                    AcmeBackendBundle:Rank r
                    JOIN r.song s
                    WHERE r.intZone = {$intZone}
                    ORDER BY s.{$strResult} DESC
                    "
            )
            ->setMaxResults(20)
            ->getResult();
    }

    public function generateRank($arrIntTerm)
    {
        return $this->getEntityManager()
            ->createQuery(
            "
                UPDATE AcmeBackendBundle:Rank r
                (r.intTermNo, r.intScore, r.intZone, r.intIndex, r.intLastIndex, r.intCountOnList, r.song_id)
                SELECT
                {$arrIntTerm[0]},
                    (
                        SELECT COUNT*4*(11-lv.intIndex)+(CASE WHEN(
                            s.boolIsPremirere = true
                        ) THEN 300 ELSE 0 END)
                         FROM AcmeBackendBundle:Votelog lv WHERE intTermNo = {$arrIntTerm[0]} AND lv.intSongId = s.id
                            AND lv.intZone = 0
                    ) AS score,
                    0,
                    1,
                    1,
                    (
                        SELECT COUNT FROM AcmeBackendBundle:Rank lr WHERE lr.song_id = s.id AND lr.intTermNo < {$arrIntTerm{0}}
                    ) AS intCountRank,
                    {$arrIntTerm[0]} AS song_id
                FROM AcmeBackendBundle:Song s


            "
            )
            ->execute();
    }
}
