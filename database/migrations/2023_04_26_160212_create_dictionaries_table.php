<?php

use App\Models\Application;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('title');
            $table->timestamps();
        });

        DB::table('dictionaries')->insert([
            [
                'id'    => Application::STATUS_ID_CREATED,
                'key'   => 'application_status',
                'title' => 'Создан'
            ],
            [
                'id'    => Application::STATUS_ID_REJECTED,
                'key'   => 'application_status',
                'title' => 'Отклонен'
            ],
            [
                'id'    => Application::STATUS_ID_ACCEPTED,
                'key'   => 'application_status',
                'title' => 'Принят'
            ],
            [
                'id'    => Application::STATUS_ID_IN_PROGRESS,
                'key'   => 'application_status',
                'title' => 'В работе'
            ],
            [
                'id'    => Application::STATUS_ID_COMPLETED,
                'key'   => 'application_status',
                'title' => 'Завершен'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionaries');
    }
};
