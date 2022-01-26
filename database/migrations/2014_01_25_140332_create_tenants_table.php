<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('cnpj')->unique();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();

            // status tenant (se inativar 'N' ele perde acesso ao sistema)
            $table->enum('active', ['Y', 'N'])->default('Y');

            // Subscription
            $table->date('subscription')->nullable(); // data que se inscreveu
            $table->date('expires_at')->nullable(); // data que inspira o acesso
            $table->string('subscription_id', 255)->nullable(); // identificador no gateway da pagamento
            $table->boolean('subscription_active')->default(false); // assinatura ativa
            $table->boolean('subscription_suspended')->default(false); // assinatura cancelada

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
        Schema::dropIfExists('tenants');
    }
}
