<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
     //   $this->call(CitySeeder::class);
        $this->call(DefaultCustomerSeeder::class);
        $this->call(DefaultVatSeeder::class);
        $this->call(SaleConfigSeeder::class);
        $this->call(NumberFormatSeeder::class);
        $this->call(BarcodeTypeSeeder::class);
        $this->call(CompanyInfoSeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(LanguageSeeder::class);
    }
}
