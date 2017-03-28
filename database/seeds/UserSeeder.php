<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder {

	public function run() {
		$data = [
			'name' 		=> 'Tom',
			'email' 	=> 'everton@quicktech.no',
			'password'	=> Hash::make('asdfasdf'),
			'phone' 	=> '5511999864311',
			'activated'	=> date('Y-m-d H:i:s')
		];

		User::create($data);
	}
}
