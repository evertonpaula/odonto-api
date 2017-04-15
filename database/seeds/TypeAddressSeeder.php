<?php
use Illuminate\Database\Seeder;

class TypeAddressSeeder extends Seeder {
	public function run() {
		$now = date('Y-m-d H:i:s');
		$types = [
			0 => [
				'name' => 'Comercial', 'slug' => 'comercial', 'created_at' => $now, 'updated_at' => $now
			],
			1 => [
				'name' => 'Residencial', 'slug' => 'residencial', 'created_at' => $now, 'updated_at' => $now
			],
			3 => [
				'name' => 'Caixa Postal', 'slug' => 'caixa-postal', 'created_at' => $now, 'updated_at' => $now
			]
		];

		DB::statement('SET foreign_key_checks = 0');
		DB::table('address_type')->truncate();
		DB::table('address_type')->insert( $types );
		DB::statement('SET foreign_key_checks = 1');
	}
}
