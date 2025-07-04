<?php

namespace App\Utilities;

use \Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

/**
 * Class Installer
 *
 * Contains all of the Business logic to install the app. Either through the CLI or the `/install` web UI.
 *
 * @package App\Utilities
 */
class Installer {
	private static $minPhpVersion = '8.2';

	public static function checkServerRequirements() {
		$requirements = array();

		if (phpversion() < self::$minPhpVersion) {
			$requirements[] = 'Minimum PHP Version 8.2 required';
		}

		if (ini_get('safe_mode')) {
			$requirements[] = 'Safe Mode feature needs to be disabled!';
		}

		if (ini_get('register_globals')) {
			$requirements[] = 'Register Globals feature needs to be disabled!';
		}

		if (ini_get('magic_quotes_gpc')) {
			$requirements[] = 'Magic Quotes feature needs to be disabled!';
		}

		if (!ini_get('file_uploads')) {
			$requirements[] = 'File Uploads feature needs to be enabled!';
		}

		if (!class_exists('PDO')) {
			$requirements[] = 'MySQL PDO feature needs to be enabled!';
		}

		if (!extension_loaded('openssl')) {
			$requirements[] = 'OpenSSL extension needs to be loaded!';
		}

		if (!extension_loaded('tokenizer')) {
			$requirements[] = 'Tokenizer extension needs to be loaded!';
		}

		if (!extension_loaded('mbstring')) {
			$requirements[] = 'mbstring extension needs to be loaded!';
		}

		if (!extension_loaded('curl')) {
			$requirements[] = 'cURL extension needs to be loaded!';
		}

		if (!extension_loaded('xml')) {
			$requirements[] = 'XML extension needs to be loaded!';
		}

		if (!extension_loaded('zip')) {
			$requirements[] = 'ZIP extension needs to be loaded!';
		}

		if (!extension_loaded('fileinfo')) {
			$requirements[] = 'fileinfo extension needs to be loaded!';
		}

		if (!is_writable(base_path('storage/app'))) {
			$requirements[] = 'storage/app directory needs to be writable!';
		}

		if (!is_writable(base_path('storage/framework'))) {
			$requirements[] = 'storage/framework directory needs to be writable!';
		}

		if (!is_writable(base_path('storage/logs'))) {
			$requirements[] = 'storage/logs directory needs to be writable!';
		}

		if (!is_writable(base_path('resources/language'))) {
			$requirements[] = 'resources/language directory needs to be writable!';
		}

		if (!is_writable(base_path('public/uploads'))) {
			$requirements[] = 'public/uploads directory needs to be writable!';
		}

		if (!is_writable(base_path('public/backup'))) {
			$requirements[] = 'public/backup directory needs to be writable!';
		}

		if (!is_writable(base_path('.env'))) {
			$requirements[] = '.env file needs to be writable!';
		}

		return $requirements;
	}

	public static function createDbTables($host, $database, $username, $password) {
		if (!static::isDbValid($host, $database, $username, $password)) {
			return false;
		}

		// Set database details
		static::saveDbVariables($host, 3306, $database, $username, $password);

		// Try to increase the maximum execution time
		@set_time_limit(300); // 5 minutes

		// Create tables
		Artisan::call('migrate:fresh', ['--force' => true]);

		// Run seeder
		Artisan::call('db:seed', ['--force' => true]);

		return true;
	}

	/**
	 * Check if the database exists and is accessible.
	 *
	 * @param $host
	 * @param $port
	 * @param $database
	 * @param $host
	 * @param $database
	 * @param $username
	 * @param $password
	 *
	 * @return bool
	 */
	public static function isDbValid($host, $database, $username, $password) {
		Config::set('database.connections.install_test', [
			'host' => $host,
			'port' => env('DB_PORT', '3306'),
			'database' => $database,
			'username' => $username,
			'password' => $password,
			'driver' => env('DB_CONNECTION', 'mysql'),
			'charset' => env('DB_CHARSET', 'utf8mb4'),
		]);

		try {
			DB::connection('install_test')->getPdo();
		} catch (\Exception $e) {
			;
			return false;
		}

		// Purge test connection
		DB::purge('install_test');

		return true;
	}

	public static function saveDbVariables($host, $port, $database, $username, $password) {

		// Update .env file
		static::updateEnv([
			'DB_HOST' => $host,
			'DB_PORT' => $port,
			'DB_DATABASE' => $database,
			'DB_USERNAME' => $username,
			'DB_PASSWORD' => "'" . $password . "'",
			//'DB_PREFIX'     =>  $prefix,
		]);

		$con = env('DB_CONNECTION', 'mysql');

		// Change current connection
		$db = Config::get('database.connections.' . $con);

		$db['host'] = $host;
		$db['database'] = $database;
		$db['username'] = $username;
		$db['password'] = $password;
		//$db['prefix'] = $prefix;

		Config::set('database.connections.' . $con, $db);

		DB::purge($con);
		DB::reconnect($con);
	}

	public static function updateSettings($post) {
		foreach ($post as $key => $value) {
			if ($key == "_token") {
				continue;
			}

			$data = array();
			$data['value'] = $value;
			$data['updated_at'] = Carbon::now();
			if (Setting::where('name', $key)->exists()) {
				Setting::where('name', '=', $key)->update($data);
			} else {
				$data['name'] = $key;
				$data['created_at'] = Carbon::now();
				Setting::insert($data);
			}
		}
	}

	public static function createUser($name, $email, $password) {
		// Create the user
		$user = new User();
		$user->name = $name;
		$user->email = $email;
		$user->email_verified_at = date('Y-m-d H:i:s');
		$user->password = $password;
		$user->status = 1;
		$user->profile_picture = 'default.png';
		$user->user_type = 'admin';
		$user->save();

	}

	public static function finalTouches($app_name = 'TrickBiz') {
		// Update .env file
		static::updateEnv([
			'APP_NAME' => '"' . $app_name . '"',
			'APP_LOCALE' => session('locale'),
			'APP_INSTALLED' => 'true',
			'APP_DEBUG' => 'false',
			'APP_URL' => url(''),
		]);

		//Import Dummy Data
		$dummy_data = file_get_contents('public/uploads/dummy_data.sql');
        $dummy_data = str_replace('Livo Bank', $app_name, $dummy_data);
        $dummy_data = str_replace('LivoBank', $app_name, $dummy_data);
        $dummy_data = str_replace('Tricky Code', $app_name, $dummy_data);
        $dummy_data = str_replace('https://livo-bank.trickycode.xyz', url(''), $dummy_data);
		DB::unprepared($dummy_data);

		//Update APP Version
		update_option('APP_VERSION', env('APP_VERSION', 1.0));

		// Rename the robots.txt file
		try {
			File::move(base_path('robots.txt.dist'), base_path('robots.txt'));
		} catch (\Exception $e) {
			// nothing to do
		}
	}

	public static function updateEnv($data) {
		if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
			return false;
		}

		$env = file_get_contents(base_path('.env'));

		$env = explode("\n", $env);

		foreach ($data as $data_key => $data_value) {
			foreach ($env as $env_key => $env_value) {
				$entry = explode('=', $env_value, 2);

				// Check if new or old key
				if ($entry[0] == $data_key) {
					$env[$env_key] = $data_key . '=' . $data_value;
				} else {
					$env[$env_key] = $env_value;
				}
			}
		}

		$env = implode("\n", $env);

		file_put_contents(base_path('.env'), $env);

		return true;
	}
}
