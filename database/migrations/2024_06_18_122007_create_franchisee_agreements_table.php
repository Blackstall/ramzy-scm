<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseeAgreementsTable extends Migration
{
    public function up()
    {
        Schema::create('franchisee_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('phone_number');
            $table->integer('business_experience');
            $table->string('ssm_certificate')->nullable();
            $table->string('receipt')->nullable();
            $table->enum('status', ['Pending', 'Paid', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('franchisee_agreements');
    }
}
