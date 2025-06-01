<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DPSEmailSMSTemplateSeeder extends Seeder
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
                "name"         => "DPS Matured",
                "slug"         => "DPS_MATURED",
                "subject"      => "DPS Matured",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Congratulations, Your DPS({{plan_name}}) has been matured at {{dateTime}}. Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Congratulations, Your DPS({{plan_name}}) has been matured at {{dateTime}}. Your account has been credited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{plan_name}} {{name}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "DPS Installment Due",
                "slug"         => "DPS_INSTALLMENT_DUE",
                "subject"      => "DPS Installment Due",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>You have due DPS({{plan_name}}) installment. Please deposit minimum {{due_amount}} to your account for paying due installment.</div>\r\n</div>",
                "sms_body"     => "You have due DPS({{plan_name}}) installment. Please deposit minimum {{due_amount}} to your account for paying due installment.",
                "shortcode"    => "{{plan_name}} {{name}} {{due_amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
        ]);
    }
}
