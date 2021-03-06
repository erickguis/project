<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Eloquent::unguard();

        $this->createModules();
        $this->createRoles();

        Eloquent::reguard();
    }

    private function createModules()
    {
        $statuses = [

            ['name' => 'Sistemas'],
            ['name' => 'Fondo de Retiro'],
            ['name' => 'Complemento Económico'],
            ['name' => 'Contabilidad'],
            ['name' => 'Presupuesto'],
            ['name' => 'Tesorería']
        ];

        foreach ($statuses as $status) {

            Muserpol\Module::create($status);
        }
    }

    private function createRoles()
    {
        $statuses = [

            ['module_id' => '1', 'name' => 'Administrador'],
            ['module_id' => '2', 'name' => 'Ventanilla'],
            ['module_id' => '2', 'name' => 'Certificación'],
            ['module_id' => '2', 'name' => 'Calificación'],
            ['module_id' => '2', 'name' => 'Legal'],
            ['module_id' => '2', 'name' => 'Administrador'],
            ['module_id' => '3', 'name' => 'Recepción'],
            ['module_id' => '3', 'name' => 'Revisión'],
            ['module_id' => '3', 'name' => 'Administrador']

        ];

        foreach ($statuses as $status) {

            Muserpol\Role::create($status);

        }
    }
}
