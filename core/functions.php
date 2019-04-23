<?php 

function deleteHttpsFromURI( string $url ): string
{
	return  preg_replace( "(^https?:)", "", $url );
}

function userIsLoggedIn()
{
	return Session::has('username');

}

function escape( $output )
{
	return htmlspecialchars( $output, ENT_QUOTES, 'UTF-8');
}

function clean( $input )
{
	$input = trim($input);

	$input = stripslashes($input);

	$input = strip_tags($input);

	return $input;
}

function get( $path )
{
	$data  = require ROOT_PATH . '/core/database.php';
	$parts = explode( '/', $path );
	foreach( $parts as $part ) {
		$data = $data[$part];
	}
	return $data;
}

function url($string)
{
	echo get('url/root') . $string;
	return;

}

function path($string)
{
	echo get('path/root') . $string;
  	return;
}

function getSize($size)
{

	if ( $size >= 1073741824 ) {
		$size = round( $size / 1073741824 * 100 ) / 100 . ' GB';
	} elseif ( $size >= 1048576 ) {
		$size = round( $size / 1048576 * 100 ) / 100 . ' MB';
	} elseif ( $size >= 1024 ) {
		$size = round( $size / 1024 * 100 ) / 100 . ' KB';
	} elseif ( $size <= 1024 ) {
		$size = $size . ' KB';
	}else {
		$size = 'uknown';
	}

	return $size;
}

function makeClickableURI($text){

    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" rel="nofollow" target="_blank">$1</a>', $text);
}

function timeAgo($datetime, $full = true)
{
	$now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function timeAgo2($time_ago)
{
	if ( ! is_numeric( $time_ago ) ) {
		$time_ago = strtotime( $time_ago );
	}

	$cur_time     = time();
	$time_elapsed = $cur_time - $time_ago;
	$thisMonth    = date( "m", $cur_time );
	$thisDay      = date( "d", $cur_time );
	$thisYear     = date( "Y", $cur_time );
	$agoMonth     = date( "m", $time_ago );
	$agoDay       = date( "d", $time_ago );
	$agoYear      = date( "Y", $time_ago );
	$seconds      = $time_elapsed;
	$minutes      = round( $time_elapsed / 60 );
	$hours        = round( $time_elapsed / 3600 );
	$days         = round( $time_elapsed / 86400 );
	$weeks        = round( $time_elapsed / 604800 );
	$months       = round( $time_elapsed / 2600640 );
	$years        = round( $time_elapsed / 31207680 );
	//Yesterday
	if ( $thisYear - $agoYear >= 1 ) {
		return date( "M d, Y - h:iA", $time_ago );
	} elseif ( $thisMonth - $agoMonth >= 1 ) {
		return date( "M d", $time_ago );
	} elseif ( $thisMonth == $agoMonth && $thisDay - $agoDay == 1 ) {
		return "Yesterday";
	} // Seconds
	elseif ( $seconds <= 60 ) {
		return "just now";
	} //Minutes
	elseif ( $minutes <= 60 ) {
		if ( $minutes == 1 ) {
			return "one minute ago";
		} else {
			return "$minutes minutes ago";
		}
	} //Hours
	elseif ( $hours <= 24 ) {
		if ( $hours == 1 ) {
			return "an hour and " . ( $minutes - 60 ) . " minutes ago";
		} else {
			return "$hours hrs ago";
		}
	} //Days
	elseif ( $days <= 7 ) {
		if ( $days == 1 ) {
			return "$days day and " . ( $hours - 24 ) . " hrs ago";
		} else {
			return "$days days ago";
		}
	} //Weeks
	elseif ( $weeks <= 4.3 ) {
		if ( $weeks == 1 ) {
			return "a week ago";
		} else {
			return "$weeks weeks ago";
		}
	}
}

function customize_name ($file_name, $added_text, $is_prefix = false, $separator = '_') {
    if ( ! $is_prefix ) {
        $parts = explode('.', $file_name);
        $extension = strtolower(end($parts));
        $extension_length = strlen($extension) + 1; // +1 for the dot '.' symbol
        $raw_name = substr($file_name, 0, -$extension_length); // Name with extension stripped off
        $return = $raw_name . $separator . $added_text . ".$extension"; // Append our text to the raw name
    } else {
        $return = $added_text . $separator . $file_name;
    }
    return $return;
}


function createSlug($text)
{
	$text = html_entity_decode(trim($text), ENT_QUOTES, 'UTF-8');
	$text=str_replace(" ","-", $text);
	$text=str_replace("–","-", $text);
	$text=str_replace("--","-", $text);
	$text=str_replace("@","-",$text);
	$text=str_replace("/","-",$text);
	$text=str_replace("\\","-",$text);
	$text=str_replace(":","",$text);
	$text=str_replace("\"","",$text);
	$text=str_replace("'","",$text);
	$text=str_replace("<","",$text);
	$text=str_replace(">","",$text);
	$text=str_replace(",","",$text);
	$text=str_replace("?","",$text);
	$text=str_replace(";","",$text);
	$text=str_replace(".","",$text);
	$text=str_replace("[","",$text);
	$text=str_replace("]","",$text);
	$text=str_replace("(","",$text);
	$text=str_replace(")","",$text);
	$text=str_replace("*","",$text);
	$text=str_replace("!","",$text);
	$text=str_replace("$","-",$text);
	$text=str_replace("&","-and-",$text);
	$text=str_replace("%","",$text);
	$text=str_replace("#","",$text);
	$text=str_replace("^","",$text);
	$text=str_replace("=","",$text);
	$text=str_replace("+","",$text);
	$text=str_replace("~","",$text);
	$text=str_replace("`","",$text);
	$text=str_replace("--","-",$text);
	$text = preg_replace("/(Г?|Г?|б ?|б ?|Г?|Г?|б ?|б ?|б ?|б ?|б ?|Д?|б ?|б ?|б ?|б ?|б ?)/", 'a', $text);
	$text = preg_replace("/(aМ?|aМ?|aМ?|aМ?|aМ?|Г?|Г?М?|Г?М?|Г?М?|Г?М?|Г?М?|Д?|Д?М?|ДМ?|Д?М?|Д?М?|Д?М?)/", 'a', $text);
	$text = preg_replace("/(ГЁ|Г?|б  |б  |б  |Г?|б ?|б  |б ?|б ?|б ?)/", 'e', $text);$text = preg_replace("/(eМ?|eМ?|eМ?|eМ?|eМ?|Г?|Г?М?|Г?М?|Г?М?|Г?М?|Г?М?)/", 'e', $text);
	$text = preg_replace("/(Г?|Г?|б ?|б ?|Д?)/", 'i', $text);$text = preg_replace("/(iМ?|iМ?|iМ?|iМ?|iМ?)/", 'i', $text);
	$text = preg_replace("/(Г?|Г?|б ?|б ?|Г?|Г?|б ?|б ?|б ?|б ?|б ?|Ж?|б ?|б ?|б ?|б ?|б ?)/", 'o', $text);$text = preg_replace("/(oМ?|oМ?|oМ?|oМ?|oМ?|Г?|Г?М?|Г?М?|Г?М?|Г?М?|Г?М?|Ж?|Ж?М?|Ж?М?|Ж?М?|Ж?М?|Ж?М?)/", 'o', $text);
	$text = preg_replace("/(Г |Г |б ?|б ?|Е?|Ж?|б ?|б ?|б ?|б ?|б ?)/", 'u', $text);$text = preg_replace("/(uМ?|uМ?|uМ?|uМ?|uМ?|Ж?|Ж?М?|Ж?М?|Ж?М?|Ж?М?|Ж?М?)/", 'u', $text);
	$text = preg_replace("/(б ?|Г |б ?|б ?|б  )/", 'y', $text);$text = preg_replace("/(Д?)/", 'd', $text);
	$text = preg_replace("/(yМ?|yМ?|yМ?|yМ?|yМ?)/", 'y', $text);$text = preg_replace("/(Д?)/", 'd', $text);
	$text = preg_replace("/(Г?|Г?|б ?|б ?|Г?|Г?|б ?|б ?|б ?|б Ё|б ?|Д?|б ?|б ?|б ?|б ?|б ?)/", 'A', $text);$text = preg_replace("/(AМ?|AМ?|AМ?|AМ?|AМ?|Г?|Г?М?|Г?М?|Г?М?|Г?М?|Г?М?|Д?|Д?М?|Д?М?|Д?М|Д?М?|Д?М?)/", 'A', $text);
	$text = preg_replace("/(Г?|Г?|б ё|б  |б  |Г?|б ?|б  |б ?|б ?|б ?)/", 'E', $text);$text = preg_replace("/(EМ?|EМ?|EМ?|EМ?|EМ?|Г?|Г?М?|Г?М?|Г?М?|Г?М?|Г?М?)/", 'E', $text);
	$text = preg_replace("/(Г?|Г?|б ?|б ?|ДЁ)/", 'I', $text);$text = preg_replace("/(IМ?|IМ?|IМ?|IМ?|IМ?)/", 'I', $text);
	$text = preg_replace("/(Г?|Г?|б ?|б ?|Г?|Г?|б ?|б ?|б ?|б ?|б ?|Ж?|б ?|б ?|б ?|б ?|б ?)/", 'O', $text);$text = preg_replace("/(OМ?|OМ?|OМ?|OМ?|OМ?|Г?|Г?М?|Г?М?|Г?М?|Г?М?|Г?М?|Ж?|Ж?М?|Ж?М?|Ж?М?|Ж?М?|Ж?М?)/", 'O', $text);
	$text = preg_replace("/(Г?|Г?|б ?|б ?|ЕЁ|Ж?|б ?|б Ё|б ?|б ?|б ?)/", 'U', $text);$text = preg_replace("/(UМ?|UМ?|UМ?|UМ?|UМ?|Ж?|Ж?М?|Ж?М?|Ж?М?|Ж?М?|Ж?М?)/", 'U', $text);
	$text = preg_replace("/(б ?|Г?|б ?|б ?|б ё)/", 'Y', $text);$text = preg_replace("/(Д?)/", 'D', $text);
	$text = preg_replace("/(YМ?|YМ?|YМ?|YМ?|YМ?)/", 'Y', $text);$text = preg_replace("/(Д)/", 'D', $text);
	$text=strtolower($text);
	return $text;
}
	
