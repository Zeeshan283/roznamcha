<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('username', 'admin')->first();

        if (is_null($admin)) {
            $admin1           = new Admin();
            $admin1->name     = "Admin";
            $admin1->email    = "admin@roznamcha.com";
            $admin1->phone    = "03012345678";
            $admin1->username = "admin";
            $admin1->currency = "all";
            $admin1->password = Hash::make('admin123');
            $admin1->save();
            
            $admin2           = new Admin();
            $admin2->name     = "پشاور کلدار خرچه";
            $admin2->email    = "peshawarpk@roznamcha.com";
            $admin2->phone    = "123";
            $admin2->username = "پشاور کلدار خرچه";
            $admin2->currency = "all";
            $admin2->password = Hash::make('admin123');
            $admin2->save();
            
            $admin3           = new Admin();
            $admin3->name     = "کابل کلدار خرچه";
            $admin3->email    = "kabulpk@roznamcha.com";
            $admin3->phone    = "123";
            $admin3->username = "کابل کلدار خرچه";
            $admin3->currency = "all";
            $admin3->password = Hash::make('admin123');
            $admin3->save();
       
            $admin4           = new Admin();
            $admin4->name     = "خوست کلدار خرچه";
            $admin4->email    = "khostpk@roznamcha.com";
            $admin4->phone    = "123";
            $admin4->username = "خوست کلدار خرچه";
            $admin4->currency = "all";
            $admin4->password = Hash::make('admin123');
            $admin4->save();
        
            $admin5           = new Admin();
            $admin5->name     = "کاټ کمشن کلدار";
            $admin5->email    = "commissionpk@roznamcha.com";
            $admin5->phone    = "123";
            $admin5->username = "کاټ کمشن کلدار";
            $admin5->currency = "all";
            $admin5->password = Hash::make('admin123');
            $admin5->save();
        
            $admin6           = new Admin();
            $admin6->name     = "زکات";
            $admin6->email    = "zakat@roznamcha.com";
            $admin6->phone    = "123";
            $admin6->username = "زکات";
            $admin6->currency = "all";
            $admin6->password = Hash::make('admin123');
            $admin6->save();
        
            $admin7           = new Admin();
            $admin7->name     = "کابل افغانی خرچه";
            $admin7->email    = "kabulaf@roznamcha.com";
            $admin7->phone    = "123";
            $admin7->username = "کابل افغانی خرچه";
            $admin7->currency = "all";
            $admin7->password = Hash::make('admin123');
            $admin7->save();
        
            $admin8           = new Admin();
            $admin8->name     = "خوست افغانی خرچه";
            $admin8->email    = "khostaf@roznamcha.com";
            $admin8->phone    = "123";
            $admin8->username = "خوست افغانی خرچه";
            $admin8->currency = "all";
            $admin8->password = Hash::make('admin123');
            $admin8->save();
        
            $admin9           = new Admin();
            $admin9->name     = "کاټ کمشن افغانی";
            $admin9->email    = "commissionaf@roznamcha.com";
            $admin9->phone    = "123";
            $admin9->username = "کاټ کمشن افغانی";
            $admin9->currency = "all";
            $admin9->password = Hash::make('admin123');
            $admin9->save();
        }
    }
}
