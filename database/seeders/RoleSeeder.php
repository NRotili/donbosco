<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Desarrollador']);
        $role2 = Role::create(['name' => 'Admin']);

        Permission::create(['name' => 'panel.home', 'description' => 'Panel - Home'])->syncRoles([$role1]);

        Permission::create(['name' => 'panel.administracion.clientes.index', 'description' => 'Panel - Administracion - Clientes - Index'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.clientes.create', 'description' => 'Panel - Administracion - Clientes - Create'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.clientes.show', 'description' => 'Panel - Administracion - Clientes - Show'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.clientes.edit', 'description' => 'Panel - Administracion - Clientes - Edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.clientes.destroy', 'description' => 'Panel - Administracion - Clientes - Delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'panel.administracion.ventas.index', 'description' => 'Panel - Administracion - Ventas - Index'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.ventas.create', 'description' => 'Panel - Administracion - Ventas - Create'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.ventas.edit', 'description' => 'Panel - Administracion - Ventas - Edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.ventas.show', 'description' => 'Panel - Administracion - Ventas - Show'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.ventas.destroy', 'description' => 'Panel - Administracion - Ventas - Delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'panel.administracion.productos.index', 'description' => 'Panel - Administracion - Productos - Index'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.productos.create', 'description' => 'Panel - Administracion - Productos - Create'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.productos.edit', 'description' => 'Panel - Administracion - Productos - Edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.productos.show', 'description' => 'Panel - Administracion - Productos - Show'])->syncRoles([$role1]);
        Permission::create(['name' => 'panel.administracion.productos.destroy', 'description' => 'Panel - Administracion - Productos - Delete'])->syncRoles([$role1]);

    }
}
