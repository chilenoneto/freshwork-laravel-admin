<?php echo "<?php"; ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('{{ $table_name }}', function(Blueprint $table)
		{
			$table->boolean('panel_access')->default(0);
			$table->boolean('super_user')->default(0);
			$table->boolean('active')->default(1);
			$table->string('picture')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('{{ $table_name }}', function(Blueprint $table)
		{
			$table->dropColumn('panel_access');
			$table->dropColumn('super_user');
			$table->dropColumn('active');
			$table->dropColumn('picture');
		});
	}

}
