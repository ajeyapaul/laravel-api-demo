<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
			'user_management_access',
			'permission_create',
			'permission_edit',
			'permission_show',
			'permission_delete',
			'permission_access',
			'role_create',
			'role_edit',
			'role_show',
			'role_delete',
			'role_access',
			'user_create',
			'user_edit',
			'user_show',
			'user_delete',
			'user_access',
			'c_r_m_access',
			'crm_status_create',
			'crm_status_edit',
			'crm_status_show',
			'crm_status_delete',
			'crm_status_access',
			'crm_customer_create',
			'crm_customer_edit',
			'crm_customer_show',
			'crm_customer_delete',
			'crm_customer_access',
			'crm_note_create',
			'crm_note_edit',
			'crm_note_show',
			'crm_note_delete',
			'crm_note_access',
			'crm_document_create',
			'crm_document_edit',
			'crm_document_show',
			'crm_document_delete',
			'crm_document_access',
			'profile_password_edit'
		];

        foreach ($permissions as $permission) {
            Permission::create([
                'title' => $permission
            ]);
        }
    }
}