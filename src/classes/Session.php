<?php

// Required settings for config.php
require_once dirname(__DIR__) . '/settings/config.php';

/**
* Session helper.
* Prefix sessions with useful methods.
* 
* @author Guilherme Alves | theguilherme.com@gmail.com
* @version 1.0
*/
class Session
{
	
	/**
	 * Determine if session has started.
	 * 
	 * @var bool
	 */
	private static $_started = false;

	/**
	 * Initialize method.
	 * If session has not started, start sessions.
	 * 
	 */
	public static function initialize()
	{
		if (self::$_started === false)
		{
			session_start();

			self::$_started = true;
		}
	}

	/**
	 * Set method.
	 * Add value to a session.
	 * 
	 * @param string $key name the data to save 
	 * @param string $value the data to save
	 */
	public static function set($key, $value = false)
	{
		/**
		 * Check whether session is set in array or not.
		 * If array the set all session key-values in foreach loop.
		 */
		if (is_array($key) && $value === false)
		{
			foreach ($keu as $name => $value)
			{
				$_SESSION[SESSION_PREFIX . $name] = $value;
			}
		}
		else
		{
			$_SESSION[SESSION_PREFIX . $key] = $value;
		}
	}

	/**
	 * Pull method.
	 * Extract item from session the delete from the session, finally return the item.
	 * 
	 * @param string $key item to extract
	 * 
	 * @return mixed|null return item or null when key does not exists
	 */
	public static function pull($key)
	{
		if (isset($_SESSION[SESSION_PREFIX . $key]))
		{
			$value = $_SESSION[SESSION_PREFIX . $key];
			unset($_SESSION[SESSION_PREFIX . $key]);

			return $value;
		}

		return;
	}

	/**
	 * Get method.
	 * Get item from session.
	 * 
	 * @param string $key item to look for in session
	 * @param bool $sKey if used then use as a second key
	 * 
	 * @return mixed|null returns the key value, or null if key does not exists
	 */
	public static function get($key, $sKey = false)
	{
		if ($sKey === true)
		{
			if (isset($_SESSION[SESSION_PREFIX . $key][$sKey]))
			{
				return $_SESSION[SESSION_PREFIX . $key][$sKey];
			}
		}
		else
		{
			if (isset($_SESSION[SESSION_PREFIX . $key]))
			{
				return $_SESSION[SESSION_PREFIX . $key];
			}
		}

		return;
	}

	/**
	 * Id method.
	 * 
	 * @return string with the session id
	 */
	public static function id()
	{
		return session_id();
	}

	/**
	 * Megenerate method
	 * Regenerate session_id.
	 * 
	 * @return string session_id
	 */
	public static function regenerate()
	{
		session_regenerate_id(true);

		return session_id();
	}

	/**
	 * Show method.
	 * Return the session array.
	 * 
	 * @return array of session indexes
	 */
	public static function show()
	{
		return $_SESSION;
	}

	/**
	 * Destroy method.
	 * Empties and destroys the sessions.
	 * 
	 * @param string $key session name to destroy
	 * @param type|bool $prefix if set to true clear all sessions for current SESSION_PREFIX
	 */
	public static function destroy($key = '', $prefix = false)
	{
		// Only run if session has started
		if (self::$_started === true)
		{
			// If $key is empty and $prefix is false
			if ($key === '' && $prefix === false)
			{
				session_unset();
				session_destroy();
			}
			elseif ($prefix === true)
			{
				// Clear all session for set SESSION_PREFIX
				foreach ($_SESSION as $key => $value)
				{
					if (strpos($key, SESSION_PREFIX) === 0)
					{
						unset($_SESSION[$key]);
					}
				}
			}
			else
			{
				// Clear specified session key
				unset($_SESSION[SESSION_PREFIX . $key]);
			}
		}
	}
}