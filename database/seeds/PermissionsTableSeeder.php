<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Subjects array
     *
     * @var array $subjects
     */
    protected $subjects = [
        'user',
        'category',
        'client',
        'fieldParam',
        'field',
        'product',
        'settings',
        'requisite',
        'stock',
        'subdivision',
        'trade',
        'tradeStatus',
    ];

    /**
     * Permissions srray
     *
     * @var array $permissions
     */
    protected $permissions = [
        'view',
        'show',
        'create',
        'edit',
        'delete',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getSubjects() as $subject){
            foreach ($this->getPermissions() as $permission){
                Permission::create([
                    'name' => "permission.$subject.$permission",
                    'slug' => "$permission.$subject",
                    'description' => "$permission $subject permission",
                ]);
            }
        }

        echo 'All the permissions added'.PHP_EOL;
    }

    /**
     * Subject array
     *
     * @return array
     */
    public function getSubjects():array
    {
        return $this->subjects;
    }

    /**
     * Permissions array
     *
     * @return array
     */
    public function getPermissions():array
    {
        return $this->permissions;
    }
}
