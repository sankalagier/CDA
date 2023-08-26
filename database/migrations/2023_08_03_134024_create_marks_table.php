<?php

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\User;
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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subject::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Classroom::class)->constrained()->cascadeOnDelete();
            $table->decimal('mark',4,2);
            $table->integer('term');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
        Schema::table('marks', function (Blueprint $table){
            $table->dropForeignIdFor(Subject::class);
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Classroom::class);
        });
    }
};


//                  SQL query :

//  ⇂ create table `marks` (`id` bigint unsigned not null auto_increment primary key, `subject_id` bigint unsigned not null, `user_id` bigint unsigned not null, `classroom_id` bigint unsigned not null, `mark` decimal(4, 2) not null, `term` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
// ⇂ alter table `marks` add constraint `marks_subject_id_foreign` foreign key (`subject_id`) references `subjects` (`id`) on delete cascade
// ⇂ alter table `marks` add constraint `marks_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade
// ⇂ alter table `marks` add constraint `marks_classroom_id_foreign` foreign key (`classroom_id`) references `classrooms` (`id`) on delete cascade
