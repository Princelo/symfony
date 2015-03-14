<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * VotelogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VotelogRepository extends EntityRepository
{

    public function getArrVotedList($intTermNo, $intMemberId, $strSortType)
    {
        return $this->getEntityManager()
            ->createQuery(
                "
                SELECT v.intSongId sid
                FROM AcmeBackendBundle:Votelog v
                WHERE v.intTermNo = {$intTermNo}
                    AND v.intMemberId = {$intMemberId}
                ORDER BY v.intIndex {$strSortType}
            "
            )
            ->getResult();
    }

    public  function getArrVoteDetails($intTermNo, $intZone, $intSongId)
    {
        return $this->getEntityManager()
            ->createQuery(
            "
                SELECT
                       s.strTitle     title,
                       s.arrStrArtistName artists,
                       s.strCorpName    corp,
                       f.strShortName as fm,
                       v.intIndex     as rank_index,
                       COUNT(vd.id)   as week_count,
                       lv.intIndex as last_index,
                       min(fv.intIndex)     as top_index,
                       (11-v.intIndex)*4+8    as score,
                       r.intIndex   all_index,
                       r.intLastIndex  all_last_index,
                       r.intScore all_score,
                       COUNT(rd.id)    all_week_count,
                       s.boolIsPremiere is_pre
                FROM
                    AcmeBackendBundle:Votelog v
                    LEFT JOIN AcmeBackendBundle:Member f
                        WITH v.intMemberId = f.id
                    LEFT JOIN AcmeBackendBundle:Votelog vd
                        WITH vd.intSongId = {$intSongId}
                        AND vd.intZone = {$intZone}
                        AND vd.intMemberId = f.id
                    LEFT JOIN AcmeBackendBundle:Votelog lv
                        WITH lv.intSongId = {$intSongId}
                        AND lv.intZone = {$intZone}
                        AND lv.intTermNo + 1 =  {$intTermNo}
                        AND lv.intMemberId = f.id
                    LEFT JOIN AcmeBackendBundle:Votelog fv
                        WITH fv.intSongId = {$intSongId}
                        AND fv.intZone = {$intZone}
                        AND fv.intMemberId = f.id
                    LEFT JOIN AcmeBackendBundle:Song s
                        WITH s.id = {$intSongId}
                    LEFT JOIN s.ranks r
                        WITH r.intTermNo = {$intTermNo}
                    LEFT JOIN s.ranks rd
                    WHERE
                        v.intSongId = {$intSongId}
                        AND v.intTermNo = {$intTermNo}
                        AND v.intZone = {$intZone}
                        AND v.intMemberId = f.id
                    GROUP BY f.strShortName, v.intIndex, lv.intIndex, s.strTitle, s.arrStrArtistName, s.strCorpName,
                        r.intIndex, r.intLastIndex, r.intScore, s.boolIsPremiere
            "
            )
            ->getResult();
    }


    public  function getArrVoteDetailsSearch($intTermNo, $intZone, $intSongInfo)
    {
        return $this->getEntityManager()
            ->createQuery(
                "
                SELECT
                       s.strTitle     title,
                       s.arrStrArtistName artists,
                       s.strCorpName    corp,
                       f.strShortName as fm,
                       v.intIndex     as rank_index,
                       COUNT(vd.id)   as week_count,
                       lv.intIndex as last_index,
                       min(fv.intIndex)     as top_index,
                       (11-v.intIndex)*4+8    as score,
                       r.intIndex   all_index,
                       r.intLastIndex  all_last_index,
                       r.intScore all_score,
                       COUNT(rd.id)    all_week_count,
                       s.boolIsPremiere is_pre
                FROM
                    AcmeBackendBundle:Votelog v
                    LEFT JOIN AcmeBackendBundle:Song s
                        WITH s.strTitle LIKE '%{$intSongInfo}%'
                        OR s.arrStrArtistName LIKE '%{$intSongInfo}%'
                    LEFT JOIN AcmeBackendBundle:Member f
                        WITH v.intMemberId = f.id
                    LEFT JOIN AcmeBackendBundle:Votelog vd
                        WITH vd.intSongId = s.id
                        AND vd.intZone = {$intZone}
                        AND vd.intMemberId = f.id
                    LEFT JOIN AcmeBackendBundle:Votelog lv
                        WITH lv.intSongId = s.id
                        AND lv.intZone = {$intZone}
                        AND lv.intTermNo + 1 =  {$intTermNo}
                        AND lv.intMemberId = f.id
                    LEFT JOIN AcmeBackendBundle:Votelog fv
                        WITH fv.intSongId = s.id
                        AND fv.intZone = {$intZone}
                        AND fv.intMemberId = f.id
                    LEFT JOIN s.ranks r
                        WITH r.intTermNo = {$intTermNo}
                    LEFT JOIN s.ranks rd
                    WHERE
                        v.intSongId = s.id
                        AND v.intTermNo = {$intTermNo}
                        AND v.intZone = {$intZone}
                        AND v.intMemberId = f.id
                    GROUP BY f.strShortName, v.intIndex, lv.intIndex, s.strTitle, s.arrStrArtistName, s.strCorpName,
                        r.intIndex, r.intLastIndex, r.intScore, s.boolIsPremiere
            "
            )
            ->getResult();
    }

    public function getArrVotelogInfo($intFmId, $intTermNo, $intZone)
    {
        return $this->getEntityManager()
            ->createQuery(
            "
                SELECT
                    s.id id,
                    s.strTitle title,
                    s.arrStrArtistName artists,
                    s.strCorpName corp,
                    lv.intIndex last_index,
                    COUNT(vd.id) week_count,
                    MIN(vd.intIndex) top,
                    v.intIndex rank_index,
                    (11 - v.intIndex)*4+8 as score,
                    s.strSongFile file
                FROM
                    AcmeBackendBundle:Votelog v
                    JOIN AcmeBackendBundle:Song s
                        WITH v.intSongId = s.id
                    LEFT JOIN AcmeBackendBundle:Votelog lv
                        WITH lv.intMemberId = v.intMemberId
                        AND lv.intTermNo + 1 = v.intTermNo
                        AND lv.intZone = v.intZone
                    LEFT JOIN AcmeBackendBundle:Votelog vd
                        WITH vd.intMemberId = v.intMemberId
                        AND vd.intZone = v.intZone
                        AND vd.intSongId = s.id
                WHERE
                    v.intMemberId = {$intFmId}
                    AND v.intTermNo = {$intTermNo}
                    AND v.intZone = {$intZone}
                GROUP BY s.strTitle, s.arrStrArtistName, s.strCorpName,
                         lv.intIndex, v.intIndex, s.strSongFile, s.id

            "
            )
            ->getResult();
    }


}
