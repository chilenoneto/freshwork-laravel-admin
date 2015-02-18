<?php  namespace Freshwork\Admin\Auth;

use Freshwork\Admin\Contracts\Auth\ACL;

class BasicAcl implements ACL {

    /**
     * Checks if the current loged user can execute the requested permission
     *
     * @param string $permission
     * @return bool
     */
    public function can($permission)
    {
        return true;
    }
}