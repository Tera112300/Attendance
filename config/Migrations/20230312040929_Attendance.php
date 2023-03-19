<?php
declare(strict_types=1);

use BaserCore\Database\Migration\BcMigration;

class Attendance extends BcMigration
{
    public function up()
    {
        $this->table('attendance')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('start_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('remarks', 'text', [
                'default' => null,
                'limit' => 4294967295,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }
    public function down(): void
    {
        $this->table('attendance')->drop()->save();
    }
}
