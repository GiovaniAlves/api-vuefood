<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'uuid' => Str::uuid(),
            'cnpj' => '34405074000120',
            'name' => 'GTech',
            'email' => 'contato@gtech.com.br',
            'url' => 'gtech',
        ]);
    }
}
