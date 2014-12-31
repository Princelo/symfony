<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 12/24/14
 * Time: 00:48
 */

namespace Acme\BackendBundle\Entity;
use Acme\BackendBundle\Entity\Constant;


class Menu {
    public function getMenu($intType)
    {
        switch($intType){
            case Constant::ADMIN:
                $jsonMenu = $this->getJsonAdminMenu();
                break;
            case Constant::FM:
                $jsonMenu = $this->getJsonFMMenu();
                break;
            case Constant::CORP;
                $jsonMenu = $this->getJsonCorpMenu();
                break;
            default:
                $jsonMenu = '';
                break;
        }
        return json_decode($jsonMenu);
    }

    public function getJsonAdminMenu()
    {
        return
            '
            [
                {
                    "name": "首页",
                    "item": [
                        {
                            "name": "首页",
                            "route": "_admin_index"
                        },
                        {
                            "name": "资料修改",
                            "route": "_admin_info_edit"
                        },
                        {
                            "name": "账号管理",
                            "route": "_unvadmin_password_edit"
                        },
                        {
                            "name": "管理员管理",
                            "route": "_admin_admin_edit"
                        }
                    ]
                },
                {
                    "name": "基础设置",
                    "item": [
                        {
                            "name": "放榜时间设置",
                            "route": "_admin_rank_setting"
                        },
                        {
                            "name": "网站信息",
                            "route": "_admin_site_info_edit"
                        },
                        {
                            "name": "幻灯片",
                            "route": "_admin_flash_edit"
                        },
                        {
                            "name": "广告位",
                            "route": "_admin_site_img_edit"
                        },
                        {
                            "name": "文章发布",
                            "route": "_admin_article_edit"
                        }
                    ]
                },
                {
                    "name": "加盟电台",
                    "item": [
                        {
                            "name": "电台联络表",
                            "route": "_admin_fm_contact_list"
                        }
                    ]
                },
                {
                    "name": "唱片公司",
                    "item": [
                        {
                            "name": "唱片公司表",
                            "route": "_admin_corp_contact_list"
                        }
                    ]
                },
                {
                    "name": "总榜信息",
                    "item": [
                        {
                            "name": "内地榜单",
                            "route": "_unvadmin_prc_rank"
                        },
                        {
                            "name": "港台榜单",
                            "route": "_unvadmin_hktw_rank"
                        }
                    ]
                },
                {
                    "name": "歌曲查询",
                    "item": [
                        {
                            "name": "歌曲查询",
                            "route": "_admin_song_list"
                        },
                        {
                            "name": "新增歌曲",
                            "route": "_corp_song_add"
                        }
                    ]
                },
                {
                    "name": "节目查询",
                    "item": [
                        {
                            "name": "节目查询",
                            "route": "_admin_act_list"
                        },
                        {
                            "name": "新增节目",
                            "route": "_admin_act_add"
                        }
                    ]
                }
            ]
            ';
    }


    public function getJsonFMMenu()
    {
        return
            '
            [
                {
                    "name": "首页",
                    "item": [
                        {
                            "name": "首页",
                            "route": "_fm_index"
                        },
                        {
                            "name": "资料修改",
                            "route": "_fm_info_edit"
                        },
                        {
                            "name": "账号管理",
                            "route": "_unvadmin_password_edit"
                        }
                    ]
                },
                {
                    "name": "加盟电台",
                    "item": [
                        {
                            "name": "电台联络表",
                            "route": "_unvadmin_fm_contact_list"
                        }
                    ]
                },
                {
                    "name": "唱片公司",
                    "item": [
                        {
                            "name": "唱片公司表",
                            "route": "_unvadmin_corp_contact_list"
                        }
                    ]
                },
                {
                    "name": "我榜查看",
                    "item": [
                        {
                            "name": "内地榜投票",
                            "route": "_fm_prc_vote"
                        },
                        {
                            "name": "港台榜投票",
                            "route": "_fm_hktw_vote"
                        }
                    ]
                },
                {
                    "name": "总榜信息",
                    "item": [
                        {
                            "name": "内地榜单",
                            "route": "_unvadmin_prc_rank"
                        },
                        {
                            "name": "港台榜单",
                            "route": "_unvadmin_hktw_rank"
                        }
                    ]
                },
                {
                    "name": "歌曲查询",
                    "item": [
                        {
                            "name": "歌曲查询",
                            "route": "_unvadmin_song_list"
                        }
                    ]
                },
                {
                    "name": "节目查询",
                    "item": [
                        {
                            "name": "节目查询",
                            "route": "_unvadmin_act_list"
                        }
                    ]
                }
            ]
            ';
    }


    public function getJsonCorpMenu()
    {
        return
        '
        [
            {
                "name": "首页",
                "item": [
                    {
                        "name": "首页",
                        "route": "_corp_index"
                    },
                    {
                        "name": "资料修改",
                        "route": "_corp_info_edit"
                    },
                    {
                        "name": "账号管理",
                        "route": "_unvadmin_password_edit"
                    }
                ]
            },
            {
                "name": "加盟电台",
                "item": [
                    {
                        "name": "电台联络表",
                        "route": "_unvadmin_fm_contact_list"
                    }
                ]
            },
            {
                "name": "唱片公司",
                "item": [
                    {
                        "name": "唱片公司表",
                        "route": "_unvadmin_corp_contact_list"
                    }
                ]
            },
            {
                "name": "总榜信息",
                "item": [
                    {
                        "name": "内地榜单",
                        "route": "_unvadmin_prc_rank"
                    },
                    {
                        "name": "港台榜单",
                        "route": "_unvadmin_hktw_rank"
                    }
                ]
            },
            {
                "name": "歌曲查询",
                "item": [
                    {
                        "name": "歌曲查询",
                        "route": "_unvadmin_song_list"
                    },
                    {
                        "name": "新增歌曲",
                        "route": "_corp_song_add"
                    }
                ]
            },
            {
                "name": "节目查询",
                "item": [
                    {
                        "name": "节目查询",
                        "route": "_unvadmin_act_list"
                    }
                ]
            }
        ]
        ';
    }
}