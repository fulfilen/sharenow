<?php
class Flash
{

	public static function set( $type, $message )
	{
		Session::put($type, $message);
	}

	public static function show()
	{
		if (Session::has('errorm')) 
		{
			echo "<div class='alert alert-danger'>
			<i class='fa fa-exclamation-circle'></i> " . ucwords(Session::get('errorm')) . "</div>";
			Session::delete('errorm');
		}
		

		if ( Session::has('successm') ) 
			{
			echo "<div class='alert alert-success'>
			<i class='fa fa-check-circle'></i> " .ucwords(Session::get('successm')). "</div>";
			Session::delete('successm');
		}

	}
}