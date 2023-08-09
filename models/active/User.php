<?php

namespace models\active;

/**
 * This is the ActiveQuery class for [[\models\User]].
 *
 * @see \models\User
 */
class User extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \models\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \models\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
