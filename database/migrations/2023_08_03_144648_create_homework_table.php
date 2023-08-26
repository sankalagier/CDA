<?php

use App\Models\Classroom;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classroom::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->mediumText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
        Schema::table('homework', function(Blueprint $table){
            $table->dropForeignIdFor(Classroom::class);
        });
    }
};


//              MySQL query for up() migration :
// ⇂ create table `homework` (`id` bigint unsigned not null auto_increment primary key, `classroom_id` bigint unsigned not null, `title` varchar(255) not null, `content` mediumtext not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
// ⇂ alter table `homework` add constraint `homework_classroom_id_foreign` foreign key (`classroom_id`) references `classrooms` (`id`) on delete cascade
