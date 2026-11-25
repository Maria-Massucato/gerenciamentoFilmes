
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->year('ano_lancamento');
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->restrictOnDelete();
            $table->foreignId('idioma_id')
                  ->constrained('idiomas')
                  ->restrictOnDelete();
            $table->foreignId('nacionalidade_id')
                  ->nullable()
                  ->constrained('nacionalidades')
                  ->nullOnDelete();
            $table->string('classificacao', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
