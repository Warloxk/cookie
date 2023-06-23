<?php
namespace Warloxk;

class Cookie
{
	private static $domain;
	private static $secure;
	private static $httponly;

	public static function Init($domain, $secure, $httponly)
	{
		self::$domain = $domain;
		self::$secure = $secure;
		self::$httponly = $httponly;
	}

	public static function Set($key, $value, $expires)
	{
		setcookie(
			$key,
			$value,
			$expires,
			'/',
			self::$domain,
			self::$secure,
			self::$httponly
		);

		$_COOKIE[$key] = $value;
	}

	public static function Get($key, $returnValueIfNotExists = null)
	{
		if (array_key_exists($key, $_COOKIE))
		{
			return $_COOKIE[$key];
		}

		return $returnValueIfNotExists;
	}

	public static function Delete($key)
	{
		if (array_key_exists($key, $_COOKIE))
		{
			setcookie(
				$key,
				null,
				time() - 86400,
				'/',
				self::$domain,
				self::$secure,
				self::$httponly
			);

			unset($_COOKIE[$key]);
		}
	}
}