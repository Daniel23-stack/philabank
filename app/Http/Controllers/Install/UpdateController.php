<?php

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use App\Models\EmailSMSTemplate;
use App\Utilities\Installer;
use Database\Seeders\DPSEmailSMSTemplateSeeder;
use Database\Seeders\WelcomeEmailSeeder;
use Illuminate\Support\Facades\Artisan;

class UpdateController extends Controller {

	public function update_migration() {
		$app_version = '2.1';

		Artisan::call('migrate', ['--force' => true]);

		$email_template = EmailSMSTemplate::where('slug', 'TRANSFER_MONEY')->first();
		if (!$email_template) {
			Artisan::call('db:seed', ['--class' => WelcomeEmailSeeder::class, '--force' => true]);
		}

		$email_template = EmailSMSTemplate::where('slug', 'DPS_MATURED')->first();
		if (!$email_template) {
			Artisan::call('db:seed', ['--class' => DPSEmailSMSTemplateSeeder::class, '--force' => true]);
		}

		//Update Version Number
		Installer::updateEnv([
			'APP_VERSION' => $app_version,
		]);
		update_option('APP_VERSION', $app_version);
		echo "Migration Updated successfully<br>";
	}
}
