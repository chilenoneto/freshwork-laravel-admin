<?php  namespace Freshwork\Admin\Contracts\Auth;

/**
 * Interface CanLoginToPanel
 * @package Freshwork\Admin\Contracts
 */
interface CanLoginToPanel {
    /**
	 * Returns the user's ID.
	 *
	 * @return mixed
	 */
	public function getId();
	/**
	 * Returns the name for the user's login.
	 *
	 * @return string
	 */
	public function getLoginName();

    /**
	 * Returns the user's login.
	 *
	 * @return string
	 */
	public function getLogin();

    /**
	 * Returns the name for the user's password.
	 *
	 * @return string
	 */
	public function getPasswordName();

    /**
	 * Gets a code for when the user is
	 * persisted to a cookie or session which
	 * identifies the user.
	 *
	 * @return string
	 */
	public function getPersistCode();

	/**
	 * Checks the given persist code.
	 *
	 * @param  string  $persistCode
	 * @return bool
	 */
	public function checkPersistCode($persistCode);


    /**
	 * Get an activation code for the given user.
	 *
	 * @return string
	 */
	public function getActivationCode();

    /**
     * Attempts to activate the given user by checking
	 * the activate code.
     *
     * @param $activationCode
     * @return mixed
     */
    public function attemptActivation($activationCode);

    /**
	 * Checks the password passed matches the user's password.
	 *
	 * @param  string  $password
	 * @return bool
	 */
	public function checkPassword($password);

    /**
	 * Get a reset password code for the given user.
	 *
	 * @return string
	 */
	public function getResetPasswordCode();

    /**
	 * Checks if the provided user reset password code is
	 * valid without actually resetting the password.
	 *
	 * @param  string  $resetCode
	 * @return bool
	 */
	public function checkResetPasswordCode($resetCode);

    /**
	 * Attempts to reset a user's password by matching
	 * the reset code generated with the user's.
	 *
	 * @param  string  $resetCode
	 * @param  string  $newPassword
	 * @return bool
	 */
	public function attemptResetPassword($resetCode, $newPassword);

    /**
	 * Wipes out the data associated with resetting
	 * a password.
	 *
	 * @return void
	 */
	public function clearResetPassword();


	/**
	 * Returns the user's password (hashed).
	 *
	 * @return string
	 */
	public function getPassword();

    /**
     * Returns true if the current user/resource has access to the panel
     * @return mixed
     */
    public function hasPanelAccess();

    /**
     * Return the total users count that have access to the panel. Used in the installation process.
     * @return mixed
     */
    public function withAccessPanelCount();

    /**
	 * Check if the user is activated.
	 *
	 * @return bool
	 */
	public function isActivated();
	/**
	 * Checks if the user is a super user - has
	 * access to everything regardless of permissions.
	 *
	 * @return bool
	 */
	public function isSuperUser();

    /**
	 * Save the user.
	 *
	 * @return bool
	 */
	public function save();
	/**
	 * Delete the user.
	 *
	 * @return bool
	 */
	public function delete();

}