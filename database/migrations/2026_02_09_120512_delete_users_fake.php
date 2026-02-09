<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            User::get()->each(function ($user) {

                if ($user->email === 'casa@casa.com') {
                    $user->assignRole('admin');
                } else {
                    if($user->created_at->isToday()){
                        $user->delete();
                    }
                }
            });
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
