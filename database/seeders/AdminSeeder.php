<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::create(['name' => 'super-admin']);

        $admin = DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin.t3mb0r0@gmail.com',
            'password' => Hash::make('4dm1nT3mb0r0'),
        ]);

        $user = User::find(1);
        $user->syncRoles('super-admin');

        $tags = [['berita', 'Berita'], ['wisata', 'Wisata'], ['profil-desa', 'Profil Desa'], ['produk-umkm', 'Produk UMKM']];
        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'slug' => $tag[0],
                'name' => $tag[1],
            ]);
        }
    }
}
