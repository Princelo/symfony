<?php
namespace Acme\CoreBundle\Controller;

use Acme\BackendBundle\Entity\Constant;
use Acme\BackendBundle\Entity\RankLog;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\CoreBundle\Model\InitializableControllerInterface;
use DateTime;
use Acme\BackendBundle\Entity\Rank;

class CustomerController extends Controller implements InitializableControllerInterface
{
    private $user;
    //private $company;

    public function initialize(Request $request/*, SecurityContextInterface $security_context*/)
    {
        //$this->user = $security_context->getToken()->getUser();
        //echo date('w');exit;
        //get rank week day
        $objORM = $this->getDoctrine()->getManager();
        $intRankWeekDay = $objORM->getRepository('AcmeBackendBundle:Basic')
            ->getRankWeekDay();
        //generate should_rank_log
        $timeNow = new \DateTime('now');
        $intWeek = date('w', $timeNow->getTimestamp());
        $floatShouldRank = $this->datediffInWeeks('5/17/2015', $timeNow->format('m/d/Y'));
        //get latest rank log
        $intCountRanked = $objORM->getRepository('AcmeBackendBundle:RankLog')
            ->getIntCountRanked();
        $intLatestTermNo = $objORM->getRepository('AcmeBackendBundle:RankLog')
            ->getIntLatestTermNo();
        $session = $request->getSession();
        $session->set('last_term_no', $intLatestTermNo);
        $session->set('current_term_no', $intLatestTermNo + 1);
        $session->set('rank_week_day', $intRankWeekDay);
        $intNextRankTime = $this->getIntNextRankTime($intRankWeekDay);
        $session->set('next_rank_time', $intNextRankTime);
        if($intWeek >= $intRankWeekDay)
            $floatShouldRank += 1;
        //if should_rank_log's count > rank_log's count
        //generate rank
        if($floatShouldRank > $intCountRanked){
            $this->generateRank($floatShouldRank - $intCountRanked, $intLatestTermNo);
            $this->initialize($request);
        }

    }

    public function datediffInWeeks($date1, $date2)
    {
        $first = DateTime::createFromFormat('m/d/Y', $date1);
        $second = DateTime::createFromFormat('m/d/Y', $date2);
        if($date1 > $date2) return -1;
        return floor($first->diff($second)->days/7);
    }

    public function generateRank($intCount, $intLatestTermNo)
    {
        $arrShouldGen = array();
        for($i = 1; $i <= $intCount; $i ++)
        {
            array_push($arrShouldGen, $intLatestTermNo + $i);
        }
        /*$objORM = $this->getDoctrine()->getManager();
        $objORM->getRepository('AcmeBackendBundle:Rank')
            ->generateRank($arrShouldGen);*/
        $objORM = $this->getDoctrine()->getManager();
        foreach($arrShouldGen as $key => $val){
            $ranklog = new RankLog();
            $ranklog->setIntTermNo($val);
            $objORM->persist($ranklog);
            $arrSongPRC = $objORM->getRepository('AcmeBackendBundle:Song')
                ->getArrRankingByTermNo($arrShouldGen[$key], Constant::PRCZONE);
            $arrSongHKTW = $objORM->getRepository('AcmeBackendBundle:Song')
                ->getArrRankingByTermNo($arrShouldGen[$key], Constant::HKTWZONE);
            $arrSortedSongPRC = array();
            $arrSortedSongHKTW = array();
            foreach($arrSongPRC as $k => $v)
            {
                //$v['score'] = $v['fm_score'] + ($v['is_pre'])?300:0;
                $v['score'] = $v['fm_score'];
                if($v['fm_score'] > 0)
                    array_push($arrSortedSongPRC, $v);
            }
            foreach($arrSongHKTW as $k => $v)
            {
                //$v['score'] = $v['fm_score'] + ($v['is_pre'])?300:0;
                $v['score'] = $v['fm_score'];
                if($v['fm_score'] > 0)
                    array_push($arrSortedSongHKTW, $v);
            }
            /*if(!empty($arrSortedSongPRC)){
                foreach ($arrSortedSongPRC as $ikey => $row) {
                    $score[$ikey]  = $row['score'];
                    $is_pre[$ikey] = $row['is_pre'];
                    $sid[$ikey]     = $row['sid'];
                }
                array_multisort($score, SORT_DESC, $arrSortedSongPRC);
            }
            if(!empty($arrSortedSongHKTW)){
                foreach ($arrSortedSongHKTW as $ikey => $row) {
                    $score[$ikey]  = $row['score'];
                    $is_pre[$ikey] = $row['is_pre'];
                    $sid[$ikey]     = $row['sid'];
                }
                array_multisort($score, SORT_DESC, $arrSortedSongHKTW,
                                $is_pre, SORT_DESC, $arrSortedSongHKTW,
                                $sid,    SORT_DESC, $arrSortedSongHKTW);
            }*/
            foreach($arrSortedSongPRC as $k => $v)
            {
                $objRank = new Rank();
                $objRank->setIntTermNo($val);
                $objRank->setIntZone(Constant::PRCZONE);
                $objSong = $this->getDoctrine()->getRepository('AcmeBackendBundle:Song')->find($v['sid']);
                $objRank->setSong($objSong);
                $objRank->setIntIndex($k + 1);
                $objRank->setIntLastIndex($v['last_index']);
                $objRank->setIntCountOnList($v['count_rank']);
                $objRank->setBoolIsPrePlus($v['is_pre']);
                $objRank->setIntFMScore($v['fm_score']);
                $objRank->setIntScore($v['score']);
                if($objSong->getIntTopRankPRC() > 0
                    && $objSong->getIntTopRankPRC() < $v['top'])
                    $objSong->setIntRankPRC($v['top']);
                $objORM->persist($objSong);
                $objORM->persist($objRank);
            }
            foreach($arrSortedSongHKTW as $k => $v)
            {
                $objRank = new Rank();
                $objRank->setIntTermNo($val);
                $objRank->setIntZone(Constant::HKTWZONE);
                $objSong = $this->getDoctrine()->getRepository('AcmeBackendBundle:Song')->find($v['sid']);
                $objRank->setSong($objSong);
                $objRank->setIntIndex($k + 1);
                $objRank->setIntLastIndex($v['last_index']);
                $objRank->setIntCountOnList($v['count_rank']);
                $objRank->setBoolIsPrePlus($v['is_pre']);
                $objRank->setIntFMScore($v['fm_score']);
                $objRank->setIntScore($v['score']);
                if($objSong->getIntTopRankHKTW() > 0
                    && $objSong->getIntTopRankHKTW() < $v['top'])
                    $objSong->setIntRankHKTW($v['top']);
                $objORM->persist($objSong);
                $objORM->persist($objRank);
            }
            $objORM->flush();
        }
    }


    protected function getIntNextRankTime($intRankWeekDay)
    {
        switch($intRankWeekDay)
        {
            case 0:
                $intNextRankTime = $intRankWeekDay<=date('w')?strtotime('next Sunday'):strtotime('Sunday');
                break;
            case 1:
                $intNextRankTime = $intRankWeekDay<=date('w')?strtotime('next Monday'):strtotime('Monday');
                break;
            case 2:
                $intNextRankTime = $intRankWeekDay<=date('w')?strtotime('next Tuesday'):strtotime('Tuesday');
                break;
            case 3:
                $intNextRankTime = $intRankWeekDay<=date('w')?strtotime('next Wednesday'):strtotime('Wednesday');
                break;
            case 4:
                $intNextRankTime = $intRankWeekDay<=date('w')?strtotime('next Thursday'):strtotime('Thursday');
                break;
            case 5:
                $intNextRankTime = $intRankWeekDay<=date('w')?strtotime('next Friday'):strtotime('Friday');
                break;
            case 6:
                $intNextRankTime = $intRankWeekDay<=date('w')?strtotime('next Saturday'):strtotime('Saturday');
                break;
            default:
                $intNextRankTime = 0;
                break;
        }
        return $intNextRankTime;
    }

}