<?php  namespace Freshwork\Admin\Contracts\Auth;

interface AdminUserProvider {

    /**
	 * Creates a user.
	 *
	 * @param  array  $credentials
	 * @return CanLoginToPanel
	 */
	public function create(array $credentials);

    /**
     * Return the count of users with panel access
     * @return mixed
     */
    public function withPanelAccessCount();

}