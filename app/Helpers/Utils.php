<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class Utils
{

	public static function requireRoute( $routeAddress )
	{
		// compose file name/path
		$file = str_replace( '.', '/', $routeAddress );
		$path = sprintf( "%s/Http/Routes/%s.php", app()->path(), $file );
		// throw file exception if missing
		if( !file_exists( $path ) ) {
			throw new FileException("Unable to find route file: $path");
		}

		// get lumen app instance
		$app = app()->getInstance();
		// include route file
		require_once( $path );
	}
}
