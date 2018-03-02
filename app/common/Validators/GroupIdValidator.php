<?php
// +----------------------------------------------------------------------
// | GroupIndexValidator.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Validators;

use App\Core\Validation\Validator;
use Phalcon\Validation\Validator\PresenceOf;

class GroupIdValidator extends Validator
{
    public function initialize()
    {
        $this->add(
            [
                'groupId',
            ],
            new PresenceOf([
                'message' => 'The :field is required!'
            ])
        );
    }
}
