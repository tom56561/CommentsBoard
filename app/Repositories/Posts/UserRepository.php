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

    public function getUserList(): array
    {
        return $this->oUser
                    ->get()
                    ->toArray();
    }

    public function editUser(int $_iId, string $_sName, string $_sEmail, string $_sRole): bool
    {
        return $this->oUser
                    ->where(['id' => $_iId])
                    ->update([
                        'name' => $_sName,
                        'email' => $_sEmail,
                        'role' => $_sRole,
                    ]);
    }

    public function getUserListByCondition(int $_iId): array
    {
        return $this->oUser
                    ->where(['id' => $_iId])
                    ->first()
                    ->toArray();
    }

    public function deleteUser(int $_iId): bool
    {
        return $this->oUser
                    ->where(['id' => $_iId])
                    ->delete();
    }

    public function searchUser(string $_sName, string $_sEmail, string $_sRole, array $_aDatefilter): array
    {
        $oUser = $this->oUser;
        if ($_sName != '') {
            $oUser = $oUser->where('name', 'like', '%' . $_sName . '%');
        }
        if ($_sEmail != '') {
            $oUser = $oUser->where('email', 'like', '%' . $_sEmail . '%');
        }
        if ($_sRole != 'all') {
            $oUser = $oUser->where(['role' => $_sRole]);
        }
        if ($_aDatefilter[0] != '') {
            $oUser = $oUser->whereDate('created_at', '>=', $_aDatefilter[0])
                            ->whereDate('created_at', '<=', $_aDatefilter[1]);
        }
        $aUser = $oUser->get()->toArray();
        return $aUser;
    }
}
