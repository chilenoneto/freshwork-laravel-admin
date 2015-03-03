<?php  namespace Freshwork\Admin\Models;

use Freshwork\Admin\Contracts\Auth\CanLoginToPanel;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements CanLoginToPanel {
    protected $table;

    protected $fillable = [
        'name',
        'panel_access',
        'super_user',
        'active'
    ];


	protected $hidden = ['remember_token'];


    function __construct()
    {
        $this->table = config('admin.auth.table');

        $this->fillable[] = config('admin.auth.login_field');
        $this->fillable[] = config('admin.auth.password_field');

        $this->hidden[] = config('admin.auth.password_field');
    }

    /**
     * Returns the user's ID.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the name for the user's login.
     *
     * @return string
     */
    public function getLoginName()
    {
        // TODO: Implement getLoginName() method.
    }

    /**
     * Returns the user's login.
     *
     * @return string
     */
    public function getLogin()
    {
        // TODO: Implement getLogin() method.
    }

    /**
     * Returns the name for the user's password.
     *
     * @return string
     */
    public function getPasswordName()
    {
        // TODO: Implement getPasswordName() method.
    }

    /**
     * Gets a code for when the user is
     * persisted to a cookie or session which
     * identifies the user.
     *
     * @return string
     */
    public function getPersistCode()
    {
        // TODO: Implement getPersistCode() method.
    }

    /**
     * Checks the given persist code.
     *
     * @param  string $persistCode
     * @return bool
     */
    public function checkPersistCode($persistCode)
    {
        // TODO: Implement checkPersistCode() method.
    }

    /**
     * Get an activation code for the given user.
     *
     * @return string
     */
    public function getActivationCode()
    {
        // TODO: Implement getActivationCode() method.
    }

    /**
     * Attempts to activate the given user by checking
     * the activate code.
     *
     * @param $activationCode
     * @return mixed
     */
    public function attemptActivation($activationCode)
    {
        // TODO: Implement attemptActivation() method.
    }

    /**
     * Checks the password passed matches the user's password.
     *
     * @param  string $password
     * @return bool
     */
    public function checkPassword($password)
    {
        // TODO: Implement checkPassword() method.
    }

    /**
     * Get a reset password code for the given user.
     *
     * @return string
     */
    public function getResetPasswordCode()
    {
        // TODO: Implement getResetPasswordCode() method.
    }

    /**
     * Checks if the provided user reset password code is
     * valid without actually resetting the password.
     *
     * @param  string $resetCode
     * @return bool
     */
    public function checkResetPasswordCode($resetCode)
    {
        // TODO: Implement checkResetPasswordCode() method.
    }

    /**
     * Attempts to reset a user's password by matching
     * the reset code generated with the user's.
     *
     * @param  string $resetCode
     * @param  string $newPassword
     * @return bool
     */
    public function attemptResetPassword($resetCode, $newPassword)
    {
        // TODO: Implement attemptResetPassword() method.
    }

    /**
     * Wipes out the data associated with resetting
     * a password.
     *
     * @return void
     */
    public function clearResetPassword()
    {
        // TODO: Implement clearResetPassword() method.
    }

    /**
     * Returns the user's password (hashed).
     *
     * @return string
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * Returns true if the current user/resource has access to the panel
     * @return mixed
     */
    public function hasPanelAccess()
    {
        // TODO: Implement hasPanelAccess() method.
    }

    /**
     * Return the total users count that have access to the panel. Used in the installation process.
     * @return mixed
     */
    public function withAccessPanelCount()
    {
        return static::where('panel_access',true)->count();
    }

    /**
     * Check if the user is activated.
     *
     * @return bool
     */
    public function isActivated()
    {
        // TODO: Implement isActivated() method.
    }

    /**
     * Checks if the user is a super user - has
     * access to everything regardless of permissions.
     *
     * @return bool
     */
    public function isSuperUser()
    {
        // TODO: Implement isSuperUser() method.
    }
}