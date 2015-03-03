<?php  namespace Freshwork\Admin\Tools;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Class EnvironmentConfigurator
 * @package Freshwork\Admin\Tools
 */
class EnvironmentConfigurator {
    /**
     * @var
     */
    protected $file;

    /**
     * @var null
     */
    protected $file_content = null;

    /**
     * @var null
     */
    protected $original_content = null;

    /**
     * @return null
     */
    public function getFileContent()
    {
        return $this->file_content;
    }


    /**
     * @param mixed $file
     * @return $this
     */
    public function setEnvironmentFile($file)
    {
        $this->file = $file;

        return $this;
    }


    /**
     * Execute the command.
     *
     * @param array $variables
     * @param bool $force
     * @param bool $replace
     * @return $this
     */
    public function configure(array $variables,$force = true,$replace=false)
    {
        $this->get();
        foreach($variables as $key => $value)
        {
            if($this->keyExists($key))
            {
                if(!$force)continue;

                if($replace)
                {
                    $this->replaceKey($key,$value);
                }
                else
                {
                    $this->deleteKey($key)->addKey($key,$value);
                }
            }
            else
            {
                $this->addKey($key,$value);
            }

        }

        $this->save();

        return $this;
    }

    /**
     * Restore the original content and save the file (optional)
     * @param bool $save define if the file is automatically saved
     * @return $this
     */
    public function restore($save = true)
    {
        $this->file_content = $this->original_content;
        if($save)$this->save();

        return $this;
    }

    /**
     *
     */
    public function get()
    {
        $this->file_content = $this->original_content = file_get_contents($this->file)."\n";
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    private function replaceKey($key, $value){
        $key = strtoupper($key);

        $regex = "/$key=(.*)/";

        $replace_regex="$key=$1";

        $this->file_content =  preg_replace($regex,$replace_regex,$this->file_content);

        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function deleteKey($key)
    {
        $key = strtoupper($key);
        $regex = "/$key=(.*)(\n)?/";
        $this->file_content = preg_replace($regex,'',$this->file_content);
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addKey($key, $value)
    {
        $key = strtoupper($key);
        $this->file_content .= "\n$key={$value}";
        return $this;
    }

    /**
     * @return $this
     */
    public function save()
    {
        file_put_contents($this->file, $this->file_content);

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function keyExists($key)
    {
        $key = strtoupper($key);
        return preg_match("/$key=(.*)/",$this->file_content) === 1;
    }


}