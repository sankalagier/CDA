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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Classroom::class)->nullable()->constrained()->nullOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeignIdFor(Classroom::class);
        });
    }
};


//              The actual SQL query in up() migration

// ⇂ create table `classrooms` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
// ⇂ alter table `users` add `classroom_id` bigint unsigned null
// ⇂ alter table `users` add constraint `users_classroom_id_foreign` foreign key (`classroom_id`) references `classrooms` (`id`) on delete set null
