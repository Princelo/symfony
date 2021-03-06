<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
    public function getArrCommentList($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c.strContent content,
                        c.timeDateTime comment_time,
                        m.strShortName member_name
                    FROM
                    AcmeBackendBundle:Comment c
                    JOIN c.song s
                    JOIN AcmeBackendBundle:Member m
                    WITH c.intMemberId = m.id
                    WHERE s.id = {$id}
                    ORDER BY c.timeDateTime DESC
                    "
            )
            ->getResult();
    }

    public function getArrMemberCommentList($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c.strContent content,
                        c.timeDateTime comment_time,
                        mf.strShortName member_name
                    FROM
                    AcmeBackendBundle:Comment c
                    JOIN c.member m
                    JOIN AcmeBackendBundle:Member mf
                    WITH c.intMemberId = mf.id
                    WHERE m.id = {$id}
                    ORDER BY c.timeDateTime DESC
                    "
            )
            ->getResult();
    }
}
