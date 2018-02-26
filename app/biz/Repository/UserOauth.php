<?php
// +----------------------------------------------------------------------
// | UserOauth.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Repository;

use Xin\Traits\Common\InstanceTrait;
use App\Models\UserOauth as UserOauthModel;

class UserOauth
{
    use InstanceTrait;

    /**
     * @desc   根据OpenId获取Oauth信息
     * @author limx
     * @param $openId
     * @return UserOauthModel|\Phalcon\Mvc\Model\ResultInterface
     */
    public function findByOpenId($openId)
    {
        return UserOauthModel::findFirst([
            'openid' => $openId,
        ]);
    }

    /**
     * @desc   绑定授权信息
     * @author limx
     * @param $userId
     * @param $openId
     * @return bool
     */
    public function bind($userId, $openId)
    {
        $oauth = UserOauthModel::findFirst([
            'openid' => $openId,
        ]);
        if (empty($oauth)) {
            $oauth = new UserOauthModel();
            $oauth->openid = $openId;
        }
        $oauth->userId = $userId;
        return $oauth->save();
    }
}