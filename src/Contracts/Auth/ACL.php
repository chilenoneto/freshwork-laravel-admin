<?php  namespace Freshwork\Admin\Contracts\Auth;

interface ACL {
    /**
     * Checks if the current loged user can execute the requested permission
     *
     * @param string $permission
     * @return bool
     */
    public function can($permission);

}