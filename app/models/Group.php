<?php

namespace App\Models;

use Phalcon\Mvc\Model\Behavior\SoftDelete;

class Group extends Model
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
     * @var integer
     * @Column(column="user_id", type="integer", length=20, nullable=false)
     */
    public $userId;

    /**
     *
     * @var string
     * @Column(column="name", type="string", length=32, nullable=false)
     */
    public $name;

    /**
     *
     * @var integer
     * @Column(column="is_deleted", type="integer", length=3, nullable=false)
     */
    public $isDeleted;

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
        $this->setSource("group");
        $this->addBehavior(
            new SoftDelete(
                [
                    'field' => 'isDeleted',
                    'value' => parent::DELETED,
                ]
            )
        );
        $this->belongsTo('userId', User::class, 'id', [
            'reusable' => true,
            'alias' => 'user',
        ]);

        parent::initialize();
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Group[]|Group|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Group|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
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
            'user_id' => 'userId',
            'name' => 'name',
            'is_deleted' => 'isDeleted',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt'
        ];
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'group';
    }

}
