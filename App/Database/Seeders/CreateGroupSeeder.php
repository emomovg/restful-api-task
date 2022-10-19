<?php

namespace App\Database\Seeders;

use App\Models\Group;

class CreateGroupSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $data = [['A1'], ['A2'], ['B1'], ['B2']];

        (new Group())->create($data);
    }
}