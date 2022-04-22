<?php

namespace App\Repositories\Posts;

use App\Models\User;


class UserRepository
{
    private $oUser;

    public function __construct(User $_oUser)
    {
        $this->oUser = $_oUser;
    }

    public function getUserList() :array
    {
        return $this->oUser
                    ->get()
                    ->toArray();
    }

    public function editUser(int $_iId, string $_sName, string $_sEmail, string $_sRole) :bool
    {
        return $this->oUser
                    ->where(['id' => $_iId])
                    ->update([
                        'name' => $_sName,
                        'email' => $_sEmail,
                        'role' => $_sRole,
                    ]);
    }
    
    public function getUserListByCondition(int $_iId) :array
    {
        return $this->oUser
                    ->where(['id' => $_iId])
                    ->first()
                    ->toArray();

    }

    public function deleteUser(int $_iId) :bool
    {
        return $this->oUser
                    ->where(['id' => $_iId])
                    ->delete();
    }
    
    // public function addNewUser(int $_iUserId, string $_sContent) :array
    // {
    //     return $this->oUser
    //                 ->create(['user_id' => $_iUserId, 'content' => $_sContent])
    //                 ->toArray();
    // }



}