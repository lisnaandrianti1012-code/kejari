<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pangkats') && !Schema::hasColumn('pangkats', 'nip')) {
            Schema::table('pangkats', function (Blueprint $table) {
                $table->string('nip')->nullable()->after('id');
            });
        }

        if (Schema::hasTable('kehadirans') && !Schema::hasColumn('kehadirans', 'nip')) {
            Schema::table('kehadirans', function (Blueprint $table) {
                $table->string('nip')->nullable()->after('id');
            });
        }

        if (Schema::hasTable('gajis') && !Schema::hasColumn('gajis', 'nip')) {
            Schema::table('gajis', function (Blueprint $table) {
                $table->string('nip')->nullable()->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pangkats') && Schema::hasColumn('pangkats', 'nip')) {
            Schema::table('pangkats', function (Blueprint $table) {
                $table->dropColumn('nip');
            });
        }

        if (Schema::hasTable('kehadirans') && Schema::hasColumn('kehadirans', 'nip')) {
            Schema::table('kehadirans', function (Blueprint $table) {
                $table->dropColumn('nip');
            });
        }

        if (Schema::hasTable('gajis') && Schema::hasColumn('gajis', 'nip')) {
            Schema::table('gajis', function (Blueprint $table) {
                $table->dropColumn('nip');
            });
        }
    }
};
