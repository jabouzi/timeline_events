<?php

function friendly_url($string, $separator = '-')
{
	setlocale(LC_CTYPE, 'en_US.UTF8');
	$string = iconv("utf-8", "ASCII//TRANSLIT//IGNORE", $string);
	$string = preg_replace('/\\s+/', $separator, $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
        $string = preg_replace('/-+/', '-', $string);
	$string = trim($string, $separator);
	$string = strtolower($string);

	return $string;
}

function generate_random_string($length = null) 
{
	$string = sha1(uniqid(rand(),true));
	if ($length) return substr($string,0,$length);
	return $string;
}

function ucname($string) 
{
	$string = ucwords(strtolower($string));
	foreach (array('-', '\'') as $delimiter) 
	{
		if (strpos($string, $delimiter)!==false) 
		{
			$string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
		}
	}
	return $string;
}

function to_boolean($str)
{
	if (strtolower($str) == 'false') return false;
	return true;
}

function isempty($string)
{
	$string = trim($string);
	return (empty($string)) ? true : false;
}

function isnull($string)
{
	if (isset($string)) return $string;
	return '';
}

function item($array, $key)
{
	return (isset($array[$key])) ? $array[$key] : false;
}

function compare_userdata($user1, $user2)
{
	if (isempty($user1['password'])) $user2['password'] = '';
	return array_merge(array_diff_assoc($user1, $user2), array_diff_assoc($user2, $user1));
}

function compare_profile($user1, $user2)
{
	return array_merge(array_diff_assoc($user1, $user2), array_diff_assoc($user2, $user1));
}

function set_maildata($from, $name, $to, $subject)
{
	$maildata = array();
	$maildata['from'] = $from;
	$maildata['name'] = $name;
	$maildata['to'] = $to;
	$maildata['subject'] = $subject;
	
	return $maildata;
}

function get_status_list()
{
	return array(48=>'user.inactive' , 49=>'user.active');
}

function array_for_dropdown($array, $value, $option = null)
{
	$dropdown = array();
	foreach($array as $item)
	{
		$temp = (array)$item;
		if ($option) 
		{
			if (is_array($option))
			{
				$dropdown[$temp[$value]] = '';
				foreach($option as $op)
				{
					$dropdown[$temp[$value]] .= $temp[$op].' ';
				}
			}
			else
			{
				$dropdown[$temp[$value]] = $temp[$option];
			}
		}
		else $dropdown[$temp[$value]] = $item;
	}
	
	return $dropdown;
}


function get_client_status_list()
{
	return array(48=>'client.inactive' , 49=>'client.active');
}

