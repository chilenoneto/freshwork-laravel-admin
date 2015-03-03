<?php echo "<?php"; ?>


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminConfigurationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 */
	public function up()
	{
		Schema::create('{{ $table_name }}', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key');
			$table->string('value')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 */
	public function down()
	{
		Schema::drop('{{ $table_name }}');
	}

}
