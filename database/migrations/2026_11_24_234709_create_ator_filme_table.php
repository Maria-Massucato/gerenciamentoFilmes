
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ator_filme', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ator_id')
                  ->constrained('atores')
                  ->cascadeOnDelete();
            $table->foreignId('filme_id')
                  ->constrained('filmes')
                  ->cascadeOnDelete();

            $table->unique(['ator_id', 'filme_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ator_filme');
    }
};
