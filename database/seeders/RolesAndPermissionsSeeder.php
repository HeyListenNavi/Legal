<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::firstOrCreate(['name' => 'admin']);

        $appointmentViewAny = Permission::firstOrCreate(['name' => 'appointment.view_any']);
        $appointmentView = Permission::firstOrCreate(['name' => 'appointment.view']);
        $appointmentCreate = Permission::firstOrCreate(['name' => 'appointment.create']);
        $appointmentUpdate = Permission::firstOrCreate(['name' => 'appointment.update']);
        $appointmentDelete = Permission::firstOrCreate(['name' => 'appointment.delete']);

        $clientViewAny = Permission::firstOrCreate(['name' => 'client.view_any']);
        $clientView = Permission::firstOrCreate(['name' => 'client.view']);
        $clientCreate = Permission::firstOrCreate(['name' => 'client.create']);
        $clientUpdate = Permission::firstOrCreate(['name' => 'client.update']);
        $clientDelete = Permission::firstOrCreate(['name' => 'client.delete']);

        $clientCaseViewAny = Permission::firstOrCreate(['name' => 'client_case.view_any']);
        $clientCaseView = Permission::firstOrCreate(['name' => 'client_case.view']);
        $clientCaseCreate = Permission::firstOrCreate(['name' => 'client_case.create']);
        $clientCaseUpdate = Permission::firstOrCreate(['name' => 'client_case.update']);
        $clientCaseDelete = Permission::firstOrCreate(['name' => 'client_case.delete']);

        $internalAnnouncementViewAny = Permission::firstOrCreate(['name' => 'internal_announcement.view_any']);
        $internalAnnouncementView = Permission::firstOrCreate(['name' => 'internal_announcement.view']);
        $internalAnnouncementCreate = Permission::firstOrCreate(['name' => 'internal_announcement.create']);
        $internalAnnouncementUpdate = Permission::firstOrCreate(['name' => 'internal_announcement.update']);
        $internalAnnouncementDelete = Permission::firstOrCreate(['name' => 'internal_announcement.delete']);

        $messageViewAny = Permission::firstOrCreate(['name' => 'message.view_any']);
        $messageView = Permission::firstOrCreate(['name' => 'message.view']);
        $messageCreate = Permission::firstOrCreate(['name' => 'message.create']);
        $messageUpdate = Permission::firstOrCreate(['name' => 'message.update']);
        $messageDelete = Permission::firstOrCreate(['name' => 'message.delete']);

        $paymentViewAny = Permission::firstOrCreate(['name' => 'payment.view_any']);
        $paymentView = Permission::firstOrCreate(['name' => 'payment.view']);
        $paymentCreate = Permission::firstOrCreate(['name' => 'payment.create']);
        $paymentUpdate = Permission::firstOrCreate(['name' => 'payment.update']);
        $paymentDelete = Permission::firstOrCreate(['name' => 'payment.delete']);

        $procedureViewAny = Permission::firstOrCreate(['name' => 'procedure.view_any']);
        $procedureView = Permission::firstOrCreate(['name' => 'procedure.view']);
        $procedureCreate = Permission::firstOrCreate(['name' => 'procedure.create']);
        $procedureUpdate = Permission::firstOrCreate(['name' => 'procedure.update']);
        $procedureDelete = Permission::firstOrCreate(['name' => 'procedure.delete']);

        $roleViewAny = Permission::firstOrCreate(['name' => 'role.view_any']);
        $roleView = Permission::firstOrCreate(['name' => 'role.view']);
        $roleCreate = Permission::firstOrCreate(['name' => 'role.create']);
        $roleUpdate = Permission::firstOrCreate(['name' => 'role.update']);
        $roleDelete = Permission::firstOrCreate(['name' => 'role.delete']);

        $userViewAny = Permission::firstOrCreate(['name' => 'user.view_any']);
        $userView = Permission::firstOrCreate(['name' => 'user.view']);
        $userCreate = Permission::firstOrCreate(['name' => 'user.create']);
        $userUpdate = Permission::firstOrCreate(['name' => 'user.update']);
        $userDelete = Permission::firstOrCreate(['name' => 'user.delete']);

        $commentViewAny = Permission::firstOrCreate(['name' => 'comment.view_any']);
        $commentView = Permission::firstOrCreate(['name' => 'comment.view']);
        $commentCreate = Permission::firstOrCreate(['name' => 'comment.create']);
        $commentUpdate = Permission::firstOrCreate(['name' => 'comment.update']);
        $commentDelete = Permission::firstOrCreate(['name' => 'comment.delete']);

        $documentViewAny = Permission::firstOrCreate(['name' => 'document.view_any']);
        $documentView = Permission::firstOrCreate(['name' => 'document.view']);
        $documentCreate = Permission::firstOrCreate(['name' => 'document.create']);
        $documentUpdate = Permission::firstOrCreate(['name' => 'document.update']);
        $documentDelete = Permission::firstOrCreate(['name' => 'document.delete']);

        $admin->givePermissionTo([
            $appointmentViewAny,
            $appointmentView,
            $appointmentCreate,
            $appointmentUpdate,
            $appointmentDelete,

            $clientViewAny,
            $clientView,
            $clientCreate,
            $clientUpdate,
            $clientDelete,

            $clientCaseDelete,
            $clientCaseUpdate,
            $clientCaseCreate,
            $clientCaseView,
            $clientCaseViewAny,

            $internalAnnouncementViewAny,
            $internalAnnouncementView,
            $internalAnnouncementCreate,
            $internalAnnouncementUpdate,
            $internalAnnouncementDelete,

            $messageDelete,
            $messageUpdate,
            $messageCreate,
            $messageView,
            $messageViewAny,

            $paymentViewAny,
            $paymentView,
            $paymentCreate,
            $paymentUpdate,
            $paymentDelete,

            $procedureView,
            $procedureViewAny,
            $procedureCreate,
            $procedureUpdate,
            $procedureDelete,

            $roleViewAny,
            $roleView,
            $roleCreate,
            $roleUpdate,
            $roleDelete,

            $userViewAny,
            $userView,
            $userCreate,
            $userUpdate,
            $userDelete,

            $commentDelete,
            $commentUpdate,
            $commentCreate,
            $commentView,
            $commentViewAny,

            $documentDelete,
            $documentUpdate,
            $documentCreate,
            $documentView,
            $documentViewAny,
        ]);

        $adminEmails = [
            'admin@admin.com',
        ];

        $adminUsers = User::whereIn('email', $adminEmails)->get();

        foreach ($adminUsers as $adminUser) {
            $adminUser->assignRole($admin);
        }
    }
}
