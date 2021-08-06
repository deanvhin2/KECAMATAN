<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('activations')->truncate();
        DB::table('persistences')->truncate();
        DB::table('reminders')->truncate();
        DB::table('role_users')->truncate();
        DB::table('throttle')->truncate();
        DB::table('users')->truncate();

        $datas = [
            [
                'email' => 'admin@kecamatan.com',
                'name' => 'Dean jajang sukmana',
                'gender' => 'Male',
                'role' => 'super-admin',
                'address' => 'Subang',
                'phone'   => '0895411291551',
                'status' => 1
            ],
        ];

        foreach ( $datas as $key => $data ) {
            $user = Sentinel::registerAndActivate( [
                'email' => $data[ 'email' ],
                'password' => "morvhincbs019",
                'name' => $data['name'],
                'gender' => $data[ 'gender' ],
                'phone' => $data[ 'phone' ],
                'address' => $data[ 'address' ],
                'status' => 1
            ] );
            Sentinel::findRoleBySlug( $data[ 'role' ] )->users()->attach( $user );
        }

        Schema::enableForeignKeyConstraints();
    }
}
