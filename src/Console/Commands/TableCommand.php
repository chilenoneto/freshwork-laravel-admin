<?php namespace Freshwork\Admin\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Factory;

class TableCommand extends Command {

	protected $stubsFolder;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:tables';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create the migrations needed by the package';
	/**
	 * @var
	 */
	private $files;
	/**
	 * @var Factory
	 */
	private $view;

	/**
	 * @param Filesystem $files
	 * @param Factory $view
	 */
	function __construct(Filesystem $files,Factory $view)
	{
		parent::__construct();

		$this->files = $files;

		$this->view = $view;

		$this->stubsFolder = __DIR__.'/../../stubs/migrations';
	}


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->createMigration('edit_user_table',[
			'table_name' => config('admin.auth.table')
		]);

		$this->createMigration('create_admin_configuration_table',[
			'table_name'	=> config('admin.config.table')
		]);

	}


	private function createBaseMigration($name)
	{
		$path = $this->laravel['path.database'].'/migrations';

		return $this->laravel['migration.creator']->create($name, $path);
	}

	private function createMigration($name, array $vars = [],$stubPath = null)
	{

		$stubPath = realpath($this->stubsFolder.'/'.($stubPath?:$name.".blade.php"));

		$path = $this->createBaseMigration($name);

		//echo $this->view->file($stubPath,$vars)->render();
		$this->files->put($path,$this->view->file($stubPath,$vars)->render());

		$this->info("'".$name. "' migration created");
	}


}
