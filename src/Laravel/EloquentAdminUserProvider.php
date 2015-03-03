<?php  namespace Freshwork\Admin\Laravel;

use Freshwork\Admin\Contracts\Auth\AdminUserProvider;
use Freshwork\Admin\Contracts\Auth\CanLoginToPanel;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentAdminUserProvider
 * @package Freshwork\Admin\Laravel
 */
class EloquentAdminUserProvider implements AdminUserProvider{

    /**
     * @var CanLoginToPanel
     */
    private $user;
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * Instantiate the provider
     *
     * @param CanLoginToPanel $user
     */
    function __construct(CanLoginToPanel $user, Hasher $hasher)
    {
        $this->user = $user;
        $this->hasher = $hasher;
    }


    /**
     * Creates a user.
     *
     * @param  array $credentials
     * @return CanLoginToPanel
     */
    public function create(array $credentials)
    {
        $class = get_class($this->user);
        $user = new $class();
        $credentials[config('admin.auth.password_field')] = $this->hasher->make($credentials[config('admin.auth.password_field')]);
        $user->fill($credentials);
        $user->save();
    }

    /**
     * Return the count of users with panel access
     * @return mixed
     */
    public function withPanelAccessCount()
    {
        return $this->user->where('panel_access',true)->count();
    }
}