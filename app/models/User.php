<?php

namespace App\Models;

class User extends Model
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
     * @Column(column="login", type="string", length=32, nullable=false)
     */
    public $login;

    /**
     *
     * @var string
     * @Column(column="password", type="string", length=128, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(column="nickname", type="string", length=32, nullable=false)
     */
    public $nickname;

    /**
     *
     * @var string
     * @Column(column="created_at", type="string", nullable=true)
     */
    public $createdAt;

    /**
     *
     * @var string
     * @Column(column="updated_at", type="string", nullable=true)
     */
    public $updatedAt;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("dtm");
        $this->setSource("user");
        $this->hasMany('id', Group::class, 'user_id', [
            'reusable' => true,
            'alias' => 'groups'
        ]);
        parent::initialize();
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]|User|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User|\Phalcon\Mvc\Model\ResultInterface
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
        return 'user';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'login' => 'login',
            'password' => 'password',
            'nickname' => 'nickname',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt'
        ];
    }

}
