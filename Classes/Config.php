<?php

class Config
{
	protected static $data;

	public static function load( $file )
	{
		self::$data = require $file;
	}

	public static function get( $path )
	{
		$parts = explode( '/', $path );
		$data = self::$data;

		foreach( $parts as $part ) {

			if(! isset($data[$part] )) {

				throw new Exception( sprintf( "%s doesn't exist in config file", $value ) );
				
			} else {

				$data = $data[$part];
			}

		}
		return $data;
	}
}