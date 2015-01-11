<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 12/24/14
 * Time: 00:48
 */

namespace Acme\BackendBundle\Entity;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\DependencyInjection\Container;


class Choice {
    public function getCastTypelist()
    {
        return array(
            0   =>  Constant::CASTTYPE0,
            1   =>  Constant::CASTTYPE1,
            2   =>  Constant::CASTTYPE2,
            3   =>  Constant::CASTTYPE3,
            4   =>  Constant::CASTTYPE4
        );
    }
    public function getLevellist()
    {
        return array(
            0   =>  'A',
            1   =>  'B',
            2   =>  'C',
            3   =>  'A1',
            4   =>  'C+',
            5   =>  'A+'
        );
    }
    public function getWeeklist()
    {
        return array(
            0   =>  '周日',
            1   =>  '周一',
            2   =>  '周二',
            3   =>  '周三',
            4   =>  '周四',
            5   =>  '周五',
            6   =>  '周六',
        );
    }
    public function getFMValueTypelist()
    {
        return array(
            Constant::FMVALUEFM   =>  'FM',
            Constant::FMVALUEAM   =>  'AM'
        );
    }
    public function getFMTypelist()
    {
        return array(
            0   =>  Constant::FMTYPE0,
            1   =>  Constant::FMTYPE1,
            2   =>  Constant::FMTYPE2,
            3   =>  Constant::FMTYPE3,
            4   =>  Constant::FMTYPE4,
            5   =>  Constant::FMTYPE5,
            6   =>  Constant::FMTYPE6,
            7   =>  Constant::FMTYPE7,
        );
    }
    public function getGenderlist()
    {
        return array(
            Constant::MALE   =>  '男',
            Constant::FEMALE   =>  '女'
        );
    }
    public function getZonelist()
    {
        return array(
            Constant::PRCZONE   => '內地榜',
            Constant::HKTWZONE   => '港台榜',
        );
    }
    public function getSongCategorylist()
    {
        return array(
            Constant::ORIGINAL  =>  '原创',
            Constant::COVER  =>  '翻唱',
            Constant::OTHER =>  '其他'
        );
    }
    public function getSongStylelist()
    {
        return array(
            Constant::POP   =>  '流行',
            Constant::FOLK  =>  '民歌',
            Constant::AMERICAN  =>  '美声',
        );
    }
    public function getCategorylist()
    {
        return array(
            1   =>  Constant::CATEGORY1,
            2   =>  Constant::CATEGORY2,
            3   =>  Constant::CATEGORY3,
            4   =>  Constant::CATEGORY4,
            5   =>  Constant::CATEGORY5,
        );
    }
}