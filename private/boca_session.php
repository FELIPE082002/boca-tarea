<?php
/**
 * Centralized session cookie options so PHPSESSID is valid site-wide
 * (BOCA uses /admin, /system, /team, etc.).
 */
if (!function_exists('boca_session_start')) {
	function boca_session_start() {
		if (session_status() === PHP_SESSION_ACTIVE) {
			return;
		}
		$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
			|| (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower((string)$_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
			|| (isset($_SERVER['SERVER_PORT']) && (string)$_SERVER['SERVER_PORT'] === '443');

		session_set_cookie_params([
			'lifetime' => 0,
			'path' => '/',
			'secure' => $secure,
			'httponly' => true,
			'samesite' => 'Lax',
		]);
		session_start();
	}
}
