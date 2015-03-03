<?php  namespace Freshwork\Admin\Models;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Eloquent\Model;

class AdminConfiguration extends Model implements Repository {

    protected $table;

    protected $cache;

    function __construct()
    {
        $this->table = config('admin.config.table');
    }

    /**
     * Determine if the given configuration value exists.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key)
    {
        $row = static::where('key',$key)->first();

        if($row === null)
        {
            return false;
        }

        $this->cache[$key] = $row->value;

        return true;
    }

    /**
     * Get the specified configuration value.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {

        return isset($this->cache[$key])?$this->cache[$key]:static::where('key',$key)->firstOrFail();

    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string $key
     * @param  mixed $value
     * @return void
     */
    public function set($key, $value = null)
    {
        $this->cache[$key] = $value;

        static::where('key',$key)->update('value',$value);
    }

    /**
     * Prepend a value onto an array configuration value.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function prepend($key, $value)
    {
        // TODO: Implement prepend() method.
    }

    /**
	 * Push a value onto an array configuration value.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function push($key='', $value=''){
        parent::push();
    }

    public function add($key,$value='')
    {
        $this->cache[$key] = $value;
        $conf = new self();
        $conf->key=$key;
        $conf->value = $value;
        $conf->save();
    }

    public function remove($key)
    {
        $this->where('key',$key)->delete();
    }
}