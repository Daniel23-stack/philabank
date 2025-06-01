<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WelcomeEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_sms_templates')->insert([
            [
                "name"         => "Transfer Money",
                "slug"         => "TRANSFER_MONEY",
                "subject"      => "Money Received",
                "email_body"   => "<div>\r\n<div>Hi {{name}},</div>\r\n<div>Your have received {{amount}} from {{sender}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Hi {{name}}, Your have received {{amount}} from {{sender}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{sender}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Welcome Email",
                "slug"         => "WELCOME_EMAIL",
                "subject"      => "Registration Sucessfully",
                "email_body"   => "<h2 style='color: #555555;'>Registration Successful</h2> <p style='color: #555555;'>Hi {{name}},<br /><span style='color: #555555;'>Welcome to Livo Bank and thank you for joining with us. You can now sign in to your account using your email and password.<br /><br />Regards<br />Tricky Code</span></p> <p>&nbsp;</p>",
                "sms_body"     => "",
                "shortcode"    => "{{name}} {{account_number}} {{email}} {{phone}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
        ]);
    }
}
