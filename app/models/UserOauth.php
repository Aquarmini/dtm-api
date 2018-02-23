<?php

namespace App\Models;

class UserOauth extends Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=20, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(column="openid", type="string", length=64, nullable=false)
     */
    public $openid;

    /**
     *
     * @var integer
     * @Column(column="user_id", type="integer", length=20, nullable=true)
     */
    public $user_id;

    /**
     *
     * @var string
     * @Column(column="created_at", type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(column="updated_at", type="string", nullable=true)
     */
    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("dtm");
        $this->setSource("user_oauth");
        parent::initialize();
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserOauth[]|UserOauth|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserOauth|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_oauth';
    }

}
