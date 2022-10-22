<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->string('price', 20)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->smallInteger('status')->default(1);
            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
