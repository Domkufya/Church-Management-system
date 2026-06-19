<?php

use yii\db\Migration;

/**
 * Migration: Create roles table for Church Management System
 *
 * This table defines all roles in the system.
 * The users table already has a role ENUM column — this roles table
 * acts as a reference/master table that documents those roles,
 * stores their display names, descriptions, and permissions level.
 *
 * Run:  php yii migrate --migrationPath=@app/migrations
 */
class m250618_000001_create_roles_table extends Migration
{
    // ── Table names ────────────────────────────────────────────
    private string $rolesTable = '{{%roles}}';
    private string $usersTable = '{{%users}}';

    // ──────────────────────────────────────────────────────────
    public function safeUp(): void
    {
        // 1. Create the roles table
        $this->createTable($this->rolesTable, [
            'id'          => $this->primaryKey()->unsigned()->comment('Role ID'),
            'name'        => $this->string(50)->notNull()->unique()->comment('Role key — must match users.role ENUM value'),
            'label'       => $this->string(100)->notNull()->comment('Human-readable display name'),
            'description' => $this->text()->null()->comment('What this role is allowed to do'),
            'level'       => $this->tinyInteger()->unsigned()->notNull()->defaultValue(0)->comment('Access level: higher = more access'),
            'is_active'   => $this->boolean()->notNull()->defaultValue(true)->comment('Whether this role is currently in use'),
            'created_at'  => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at'  => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // 2. Seed roles — names match your users.role ENUM values exactly
        $this->batchInsert($this->rolesTable, [
            'name', 'label', 'description', 'level', 'is_active',
        ], [
            [
                'admin',
                'Administrator',
                'Full system control: manage users, members, finance, events, departments, and system settings.',
                100,
                true,
            ],
            [
                'pastor',
                'Pastor',
                'View and manage members, prayer requests, attendance, and church reports. Cannot manage system users.',
                80,
                true,
            ],
            [
                'secretary',
                'Secretary',
                'Manage members, events, announcements, attendance records, and general church administration.',
                60,
                true,
            ],
            [
                'treasurer',
                'Treasurer',
                'Manage offerings, donations, expenses, and generate financial reports.',
                60,
                true,
            ],
            [
                'department_leader',
                'Department Leader',
                'Manage their assigned department: add/remove members, record attendance for department activities.',
                40,
                true,
            ],
            [
                'member',
                'Church Member',
                'Access personal profile, submit prayer requests, view announcements and events.',
                10,
                true,
            ],
        ]);

        // 3. Add a foreign-key-style role_id column to users (optional but recommended)
        //    This links users to the roles table while keeping the ENUM for quick queries.
        $this->addColumn(
            $this->usersTable,
            'role_id',
            $this->integer()->unsigned()->null()->after('role')
                ->comment('FK to roles.id — mirrors the role ENUM for relational integrity')
        );

        // 4. Populate role_id based on existing role ENUM values
        $this->execute("
            UPDATE {$this->usersTable} u
            JOIN   {$this->rolesTable} r ON r.name = u.role
            SET    u.role_id = r.id
        ");

        // 5. Add foreign key constraint
        $this->addForeignKey(
            'fk_users_role_id',
            $this->usersTable,
            'role_id',
            $this->rolesTable,
            'id',
            'SET NULL',   // if role deleted → role_id becomes NULL (safe)
            'CASCADE'
        );

        // 6. Index for fast lookups by role name
        $this->createIndex('idx_roles_name',  $this->rolesTable, 'name');
        $this->createIndex('idx_roles_level', $this->rolesTable, 'level');
        $this->createIndex('idx_users_role_id', $this->usersTable, 'role_id');
    }

    // ──────────────────────────────────────────────────────────
    public function safeDown(): void
    {
        // Reverse in opposite order
        $this->dropForeignKey('fk_users_role_id', $this->usersTable);
        $this->dropIndex('idx_users_role_id', $this->usersTable);
        $this->dropColumn($this->usersTable, 'role_id');

        $this->dropIndex('idx_roles_level', $this->rolesTable);
        $this->dropIndex('idx_roles_name',  $this->rolesTable);
        $this->dropTable($this->rolesTable);
    }
}
