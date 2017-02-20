<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Motive;
use App\Domain;

class WebSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->domains();

        $this->createWebSupports();
    }

    protected function createWebSupports()
    {
        for ($i=0; $i < 10 ; $i++) { 
            $user = User::find(random_int(1, 12));
            $motive = Motive::find(random_int(1, 10));
            $domain = Domain::find(random_int(1, 130));

            factory(App\webSupport::class)->create([
                'user' => $user->username,
                'motive' => $motive->description,
                'domain' => $domain->domain,
            ]);
        }
    }

    protected function domains()
    {
        $cpanel = new \Gufy\CpanelPhp\Cpanel([
            'host'        =>  'https://216.55.141.226:2087', // ip or domain complete with its protocol and port
            'username'    =>  'root', // username of your server, it usually root.
            'auth_type'   =>  'password', // set 'hash' or 'password'
            'password'    =>  '9VRF1VyBN9NWnW', // long hash or your user's password 
        ]);
        $data = json_decode($cpanel->listAccounts());
        
            foreach ($data->acct as $key => $value) {
                Domain::create([
                    'domain' => $value->domain,
                ]);
            }

        // foreach ($data->acct as $key => $value) {
        //     $domains[$value->domain] = $value->domain;
        // }

        // return $domains;
    }
}
