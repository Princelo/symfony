<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;


/**
 * SongRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SongRepository extends EntityRepository
{

    public function getQuerySonglist($where = null)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT
                        s.id,
                        s.strTitle title,
                        s.arrStrArtistName artists,
                        s.intRankZone zone,
                        s.strCorpName corp,
                        s.strSongFile file,
                        (CASE WHEN(
                            s.boolIsRank = true
                            AND
                            s.timeRankTimeFrom IS NOT NULL
                            AND s.timeRankTimeTo IS NOT NULL
                            ) THEN s.timeRankTimeFrom ELSE s.timeRankTime
                        END
                        ) AS rank_from,
                        (CASE WHEN(
                            s.boolIsRank = true
                            AND
                            s.timeRankTimeFrom IS NOT NULL
                            AND s.timeRankTimeTo IS NOT NULL
                            ) THEN s.timeRankTimeTo ELSE DATE_ADD(s.timeRankTime, 60, 'DAY')
                        END
                        ) AS rank_to,
                        s.timeUploadDateTime upload_time,
                        s.strSongFile download,
                        (CASE WHEN(
                         s.boolIsRank = TRUE
                         AND (
                             (
                                (
                                    CURRENT_DATE() BETWEEN s.timeRankTimeFrom AND s.timeRankTimeTo
                                )
                                AND s.timeRankTimeFrom IS NOT NULL
                                AND s.timeRankTimeTo IS NOT NULL
                            )OR(
                                (
                                    CURRENT_DATE() BETWEEN s.timeRankTime AND DATE_ADD(s.timeRankTime, 60, 'DAY')
                                )
                                AND s.timeRankTimeFrom IS NULL
                                AND s.timeRankTimeTo IS NULL
                            )
                         )
                        ) THEN TRUE ELSE FALSE
                        END) AS is_ranking,
                        (CASE WHEN(
                         s.boolIsRank = TRUE
                         AND (
                            (
                                (
                                    CURRENT_DATE() < s.timeRankTimeFrom
                                )
                                AND s.timeRankTimeFrom IS NOT NULL
                                AND s.timeRankTimeTo IS NOT NULL
                            )OR(
                                (
                                    CURRENT_DATE() < s.timeRankTime
                                )
                                AND s.timeRankTimeFrom IS NULL
                                AND s.timeRankTimeTo IS NULL
                            )
                         )
                        ) THEN TRUE ELSE FALSE
                        END) AS is_wait,
                        (CASE WHEN(
                         s.boolIsRank = TRUE
                         AND (
                             (
                                (
                                    CURRENT_DATE() > s.timeRankTimeTo
                                )
                                AND s.timeRankTimeFrom IS NOT NULL
                                AND s.timeRankTimeTo IS NOT NULL
                             )OR(
                                (
                                    CURRENT_DATE() > DATE_ADD(s.timeRankTime, 60, 'DAY')
                                )
                                AND s.timeRankTimeFrom IS NULL
                                AND s.timeRankTimeTo IS NULL
                             )
                         )
                        ) THEN TRUE ELSE FALSE
                        END) AS is_expire,
                        s.boolIsRank is_rank,
                        m.strShortName uploader,
                        COUNT(c.id) AS comment_count
                    FROM
                    AcmeBackendBundle:Song s
                    LEFT JOIN s.member m
                    LEFT JOIN s.comments c
                    WHERE 1 = 1
                    {$where}
                    GROUP BY s.id, s.strTitle, s.intRankZone, s.strCorpName, s.timeRankTimeFrom, s.timeRankTimeTo,
                        s.timeRankTime, s.timeUploadDateTime, m.strShortName
                    ORDER BY upload_time DESC
                    "
            );
    }

    public function getArrRankingByTermNo($intTermNo, $intZone)
    {
        $intLastTermNo = $intTermNo - 1;
        $rsm = new ResultSetMapping();
        return $this->getEntityManager()
            ->createNativeQuery(
            "
                SELECT s.id sid,
                    (SELECT SUM(foo.score) AS fm_score FROM (
                        SELECT COUNT(s.id)*4*(11-lv.intIndex)+8 FROM AcmeBackendBundle:Votelog lv WHERE lv.intTermNo = {$intTermNo}
                            AND lv.intSongId = s.id AND lv.intZone = {$intZone}
                    ) AS foo ) as fm_score,
                    s.boolIsPremiere is_pre,
                    (
                        SELECT lr2.intIndex FROM AcmeBackendBundle:Rank lr2 WHERE lr2.song_id = s.id
                            AND lr2.intTermNo = {$intLastTermNo} AND lr2.intZone = {$intZone}
                    ) AS last_index,
                    (
                        SELECT COUNT(lr.song_id) FROM AcmeBackendBundle:Rank lr WHERE lr.song_id = s.id AND lr.intZone = {$intZone} AND lr.intIndex < 21
                    ) AS count_rank,
                    (CASE WHEN s.intRankZone = " . Constant::PRCZONE . "
                        THEN
                        s.intTopRankPRC
                        ELSE
                        s.intTopRankHKTW
                        END
                        ) AS top

                FROM
                    AcmeBackendBundle:Song s
                WHERE
                    s.intRankZone = {$intZone}
                GROUP BY s.id
            ",
            $rsm
            )
            ->getResult();
    }

    public function getArrRankingForVote($intTermNo, $intZone)
    {
        $intLastTermNo = $intTermNo - 1;
        return $this->getEntityManager()
            ->createQuery(
            "
                SELECT s.id id,
                    (
                        SELECT COUNT(s.id)*4*(11-lv.intIndex)+8 FROM AcmeBackendBundle:Votelog lv WHERE lv.intTermNo = {$intTermNo}
                            AND lv.intSongId = s.id AND lv.intZone = {$intZone}
                    ) AS fm_score,
                    s.boolIsPremiere is_pre,
                    s.strTitle title,
                    s.arrStrArtistName artists,
                    s.strCorpName corp,
                    s.intRankZone zone,
                    (
                        SELECT lr2.intIndex FROM AcmeBackendBundle:Rank lr2 WHERE lr2.song = s.id
                            AND lr2.intTermNo = {$intLastTermNo} AND lr2.intZone = {$intZone}
                    ) AS last_index,
                    (
                        SELECT COUNT(lr.song) FROM AcmeBackendBundle:Rank lr WHERE lr.song = s.id AND lr.intZone = {$intZone} AND lr.intIndex < 21
                    ) AS count_rank,
                    (
                        SELECT lr3.intScore FROM AcmeBackendBundle:Rank lr3 WHERE lr3.song = s.id AND lr3.intZone = {$intZone}
                            AND lr3.intTermNo = {$intLastTermNo}
                    ) AS last_score,
                    (CASE WHEN s.intRankZone = " . Constant::PRCZONE . "
                        THEN
                        s.intTopRankPRC
                        ELSE
                        s.intTopRankHKTW
                        END
                        ) AS top
                FROM
                    AcmeBackendBundle:Song s
                WHERE
                    s.intRankZone = {$intZone}
                GROUP BY s.id

            "
            )
            ->getResult();
    }


}
