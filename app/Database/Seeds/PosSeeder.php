<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('customers')->insertBatch([
            ['full_name' => 'Juan Dela Cruz', 'email' => 'juan@example.com', 'phone' => '09171234567'],
            ['full_name' => 'Maria Santos', 'email' => 'maria@example.com', 'phone' => '09181234567'],
            ['full_name' => 'Carlo Reyes', 'email' => 'carlo@example.com', 'phone' => '09191234567'],
        ]);

        $this->db->table('users')->insertBatch([
            ['username' => 'admin', 'full_name' => 'System Administrator', 'role' => 'Administrator'],
            ['username' => 'jdelacruz', 'full_name' => 'Juan Dela Cruz', 'role' => 'Cashier'],
            ['username' => 'msantos', 'full_name' => 'Maria Santos', 'role' => 'Cashier'],
        ]);
    }
}
