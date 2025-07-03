<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Doctrine\Inflector\Rules\Substitution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create reading subscriptions
        Subscription::create([
            'name' => 'Reading 3 Month',
            'price' => 300,
            'type' => 'reading',
            'duration_in_days'=> 90,
            'description' => 'قراءة غير محدودة لمدة 3 شهور',
            'service_id' => 1
        ]);
        Subscription::create([
            'name' => 'Reading 6 Month',
            'price' => 500,
            'type' => 'reading',
            'duration_in_days'=> 180,
            'description' => 'قراءة غير محدودة لمدة 6 شهور',
            'service_id' => 1
        ]);
        Subscription::create([
            'name' => 'Reading 12 Month',
            'price' => 850,
            'type' => 'reading',
            'duration_in_days'=> 360,
            'description' => 'قراءة غير محدودة لمدة 12 شهر',
            'service_id' => 1
        ]);

        //create audio subscriptions
        Subscription::create([
            'name' => 'audio 3 Month',
            'price' => 600,
            'type' => 'audio',
            'duration_in_days'=> 90,
            'description' => 'الاستماع غير محدودة لمدة 3 شهور',
            'service_id' => 2
        ]);
        Subscription::create([
            'name' => 'audio 6 Month',
            'price' => 1100,
            'type' => 'audio',
            'duration_in_days'=> 180,
            'description' => 'الاستماع غير محدودة لمدة 6 شهور',
            'service_id' => 2
        ]);
        Subscription::create([
            'name' => 'audio 12 Month',
            'price' => 2200,
            'type' => 'audio',
            'duration_in_days'=> 360,
            'description' => 'الاستماع غير محدودة لمدة 12 شهر',
            'service_id' => 2
        ]);

        //create download subscriptions
        Subscription::create([
            'name' => 'download 3 Month',
            'price' => 1000,
            'type' => 'download',
            'duration_in_days'=> 90,
            'description' => 'التحميل غير محدودة لمدة 3 شهور',
            'service_id' => 3
        ]);
        Subscription::create([
            'name' => 'download 6 Month',
            'price' => 1900,
            'type' => 'download',
            'duration_in_days'=> 180,
            'description' => 'التحميل غير محدودة لمدة 6 شهور',
            'service_id' => 3
        ]);
        Subscription::create([
            'name' => 'download 12 Month',
            'price' => 2750,
            'type' => 'download',            
            'duration_in_days'=> 360,
            'description' => 'التحميل غير محدودة لمدة 12 شهر',
            'service_id' => 3
        ]);
    }
}
