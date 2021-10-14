<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name' => 'Navegar Usuarios',
            'slug' => 'users.index',
            'description' => 'usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle Usuarios',
            'slug' => 'users.show',
            'description' => 'Ver usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Usuarios',
            'slug' => 'users.edit',
            'description' => 'Editar usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Usuarios',
            'slug' => 'users.destroy',
            'description' => 'Eliminar usuarios del sistema',
        ]);
        // Permission::create([
        //     'name' => 'Crear Usuarios',
        //     'slug' => 'users.create',
        //     'description' => 'Crear usuarios del sistema',
        // ]);

        //Roles
        Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'roles.index',
            'description' => 'roles del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle roles',
            'slug' => 'roles.show',
            'description' => 'Ver roles del sistema',
        ]);
        Permission::create([
            'name' => 'Editar roles',
            'slug' => 'roles.edit',
            'description' => 'Editar roles del sistema',
        ]);
        Permission::create([
            'name' => 'Crear roles',
            'slug' => 'roles.create',
            'description' => 'Crear roles del sistema',
        ]);

        //cliente
        Permission::create([
            'name' => 'Navegar cliente',
            'slug' => 'cliente.index',
            'description' => 'cliente del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle cliente',
            'slug' => 'cliente.show',
            'description' => 'Ver cliente del sistema',
        ]);
        Permission::create([
            'name' => 'Editar cliente',
            'slug' => 'cliente.edit',
            'description' => 'Editar cliente del sistema',
        ]);
        Permission::create([
            'name' => 'Crear cliente',
            'slug' => 'cliente.create',
            'description' => 'Crear cliente del sistema',
        ]);

        //empleados
        Permission::create([
            'name' => 'Navegar empleados',
            'slug' => 'empleados.index',
            'description' => 'empleados del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle empleados',
            'slug' => 'empleados.show',
            'description' => 'Ver empleados del sistema',
        ]);
        Permission::create([
            'name' => 'Editar empleados',
            'slug' => 'empleados.edit',
            'description' => 'Editar empleados del sistema',
        ]);
        Permission::create([
            'name' => 'Cambiar estado empleados',
            'slug' => 'empleados.cambiarestado',
            'description' => 'cambiar el estado de empleados del sistema',
        ]);
        Permission::create([
            'name' => 'Crear empleados',
            'slug' => 'empleados.create',
            'description' => 'Crear empleados del sistema',
        ]);

        //cargos
        Permission::create([
            'name' => 'Navegar cargos',
            'slug' => 'cargos.index',
            'description' => 'cargos del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle cargos',
            'slug' => 'cargos.show',
            'description' => 'Ver cargos del sistema',
        ]);
        Permission::create([
            'name' => 'Editar cargos',
            'slug' => 'cargos.edit',
            'description' => 'Editar cargos del sistema',
        ]);
        Permission::create([
            'name' => 'Crear cargos',
            'slug' => 'cargos.create',
            'description' => 'Crear cargos del sistema',
        ]);

        //ciudad
        Permission::create([
            'name' => 'Navegar ciudad',
            'slug' => 'ciudad.index',
            'description' => 'ciudad del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle ciudad',
            'slug' => 'ciudad.show',
            'description' => 'Ver ciudad del sistema',
        ]);
        Permission::create([
            'name' => 'Editar ciudad',
            'slug' => 'ciudad.edit',
            'description' => 'Editar ciudad del sistema',
        ]);
        Permission::create([
            'name' => 'Crear ciudad',
            'slug' => 'ciudad.create',
            'description' => 'Crear ciudad del sistema',
        ]);

        //genero
        Permission::create([
            'name' => 'Navegar genero',
            'slug' => 'genero.index',
            'description' => 'genero del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle genero',
            'slug' => 'genero.show',
            'description' => 'Ver genero del sistema',
        ]);
        Permission::create([
            'name' => 'Editar genero',
            'slug' => 'genero.edit',
            'description' => 'Editar genero del sistema',
        ]);
        Permission::create([
            'name' => 'Crear genero',
            'slug' => 'genero.create',
            'description' => 'Crear genero del sistema',
        ]);
        
        // Tipo de servicio
        Permission::create([
            'name' => 'Navegar Tipo de servicio',
            'slug' => 'Tiposervicio.index',
            'description' => 'Tipo de servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle Tipo de servicio',
            'slug' => 'Tiposervicio.show',
            'description' => 'Ver Tipo de servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Editar Tipo de servicio',
            'slug' => 'Tiposervicio.edit',
            'description' => 'Editar Tipo de servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Crear Tipo de servicio',
            'slug' => 'Tiposervicio.create',
            'description' => 'Crear Tipo de servicio del sistema',
        ]);

        // Servicios
        Permission::create([
            'name' => 'Navegar servicios',
            'slug' => 'servicios.index',
            'description' => 'servicios del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle servicios',
            'slug' => 'servicios.show',
            'description' => 'Ver servicios del sistema',
        ]);
        Permission::create([
            'name' => 'Editar servicios',
            'slug' => 'servicios.edit',
            'description' => 'Editar servicios del sistema',
        ]);
        Permission::create([
            'name' => 'Crear servicios',
            'slug' => 'servicios.create',
            'description' => 'Crear servicios del sistema',
        ]);

        // implementos
        Permission::create([
            'name' => 'Navegar implementos',
            'slug' => 'implementos.index',
            'description' => 'implementos del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle implementos',
            'slug' => 'implementos.show',
            'description' => 'Ver implementos del sistema',
        ]);
        Permission::create([
            'name' => 'Editar implementos',
            'slug' => 'implementos.edit',
            'description' => 'Editar implementos del sistema',
        ]);
        Permission::create([
            'name' => 'Crear implementos',
            'slug' => 'implementos.create',
            'description' => 'Crear implementos del sistema',
        ]);
        Permission::create([
            'name' => 'Cambiar estado implementos',
            'slug' => 'implementos.cambiarestado',
            'description' => 'cambiar el estado de implementos del sistema',
        ]);

        // categorias
        Permission::create([
            'name' => 'Navegar categorias',
            'slug' => 'categorias.index',
            'description' => 'categorias del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle categorias',
            'slug' => 'categorias.show',
            'description' => 'Ver categorias del sistema',
        ]);
        Permission::create([
            'name' => 'Editar categorias',
            'slug' => 'categorias.edit',
            'description' => 'Editar categorias del sistema',
        ]);
        Permission::create([
            'name' => 'Crear categorias',
            'slug' => 'categorias.create',
            'description' => 'Crear categorias del sistema',
        ]);

        // novedades
        Permission::create([
            'name' => 'Navegar novedades',
            'slug' => 'novedades.index',
            'description' => 'novedades del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle novedades',
            'slug' => 'novedades.show',
            'description' => 'Ver novedades del sistema',
        ]);
        Permission::create([
            'name' => 'Editar novedades',
            'slug' => 'novedades.edit',
            'description' => 'Editar novedades del sistema',
        ]);
        Permission::create([
            'name' => 'Crear novedades',
            'slug' => 'novedades.create',
            'description' => 'Crear novedades del sistema',
        ]);
        Permission::create([
            'name' => 'Cambiar estado novedades',
            'slug' => 'novedades.cambiarestado',
            'description' => 'cambiar el estado de novedades del sistema',
        ]);

        // visitas
        Permission::create([
            'name' => 'Navegar visitas',
            'slug' => 'visitas.index',
            'description' => 'visitas del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle visitas',
            'slug' => 'visitas.show',
            'description' => 'Ver visitas del sistema',
        ]);
        Permission::create([
            'name' => 'Editar visitas',
            'slug' => 'visitas.edit',
            'description' => 'Editar visitas del sistema',
        ]);
        Permission::create([
            'name' => 'Crear visitas',
            'slug' => 'visitas.create',
            'description' => 'Crear visitas del sistema',
        ]);
        Permission::create([
            'name' => 'Cambiar estado visitas',
            'slug' => 'visitas.cambiarestado',
            'description' => 'cambiar el estado de visitas del sistema',
        ]);

        // kits
        Permission::create([
            'name' => 'Navegar kits',
            'slug' => 'kits.index',
            'description' => 'kits del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle kits',
            'slug' => 'kits.show',
            'description' => 'Ver kits del sistema',
        ]);
        Permission::create([
            'name' => 'Editar kits',
            'slug' => 'kits.edit',
            'description' => 'Editar kits del sistema',
        ]);
        Permission::create([
            'name' => 'Crear kits',
            'slug' => 'kits.create',
            'description' => 'Crear kits del sistema',
        ]);
        Permission::create([
            'name' => 'Cambiar estado kits',
            'slug' => 'kits.cambiarestado',
            'description' => 'cambiar el estado de kits del sistema',
        ]);

        // orden de servicio
        Permission::create([
            'name' => 'Navegar orden de servicio',
            'slug' => 'ordenservicios.index',
            'description' => 'orden de servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle orden de servicio',
            'slug' => 'ordenservicios.show',
            'description' => 'Ver orden de servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Editar orden de servicio',
            'slug' => 'ordenservicios.edit',
            'description' => 'Editar orden de servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Crear orden de servicio',
            'slug' => 'ordenservicios.create',
            'description' => 'Crear orden de servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Cambiar estado orden de servicio',
            'slug' => 'ordenservicios.cambiarestado',
            'description' => 'cambiar el estado de orden de servicio del sistema',
        ]);

        // estados
        Permission::create([
            'name' => 'Navegar estados',
            'slug' => 'estados.index',
            'description' => 'estados del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle estados',
            'slug' => 'estados.show',
            'description' => 'Ver estados del sistema',
        ]);
        Permission::create([
            'name' => 'Editar estados',
            'slug' => 'estados.edit',
            'description' => 'Editar estados del sistema',
        ]);
        Permission::create([
            'name' => 'Crear estados',
            'slug' => 'estados.create',
            'description' => 'Crear estados del sistema',
        ]);
    }
}
