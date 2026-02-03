<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // On lie la commande à l'utilisateur qui achète
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Le prix total (10 chiffres au total, 2 après la virgule)
            $table->decimal('total_price', 10, 2);
            
            // Le statut de la commande pour tes notifications
            $table->string('status')->default('En attente');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};