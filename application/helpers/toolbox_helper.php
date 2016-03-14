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
	return array(0 => 'user.inactive' , 1 => 'user.active');
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
	return array(0 => 'client.inactive' , 1 => 'client.active');
}

function sizeFilter( $bytes )
{
    $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
    for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
    return( round( $bytes, 2 ) . " " . $label[$i] );
}

function documents_icons()
{
	return array('ppt' => '<svg id="icon-powerpoint"  viewBox="0 0 29 32" x="2160">
										<path fill="#444" d="M20.635 15.933c1.75-.03 3.367.677 4.68 1.634l-4.54 6.32 7.59 2.384c-.998 3.18-3.94 5.51-7.452 5.57-4.392.08-8.015-3.42-8.092-7.81s3.43-8.01 7.82-8.09zm-15.908 6.93h5.682v2.274H4.72v-2.273zm0-3.408h6.818v2.273H4.727v-2.273zm0-1.137v-2.273h7.955v2.273H4.727z"/>
										<path fill="#444" d="M.182.136H16.66l8.52 8.524v7.066l-2.273-1.172V11.5h-9.092V2.41H2.455v25h8.69c.243.82.617 1.586 1.095 2.273H.18V.138zm15.91 2.84v6.25h6.25l-6.25-6.25z"/>
									</svg>',
				'pdf' => '<svg id="icon-pdf"  viewBox="0 0 24 32" x="2016">
										<path fill="#444" d="M0 31.288C0 32 .71 32 .71 32h22.045s.71 0 .71-.71V6.4l-6.4-6.4H.71S0 0 0 .71v30.58zm1.067-1.024V1.734c0-.667.647-.667.647-.667H16v5.69c0 .71.71.71.71.71h5.69v22.798c0 .668-.647.668-.647.668H1.715s-.647 0-.647-.67zm9.392-13.47l.2-.51c-.69-2.633-1.11-4.746-.74-6.112.1-.356.51-.572.95-.572l.27.004c.65-.01.93.76.97 1.058.05.497-.18 1.34-.18 1.34 0-.34.01-.89-.2-1.364-.25-.548-.49-.876-.71-.928-.11.072-.22.222-.25.51-.08.402-.1.91-.1 1.173 0 .926.18 2.15.54 3.41.07-.196.13-.384.17-.56l.54-2.11s-.12 2.442-.28 3.18l-.12.47c.59 1.65 1.54 3.125 2.68 4.186.44.41 1.01.75 1.54 1.06 1.17-.17 2.25-.25 3.15-.24 1.19.01 2.06.19 2.42.54.17.17.24.37.26.6 0 .09-.04.3-.05.35.01-.07.01-.38-.95-.69-.76-.24-2.17-.24-3.86-.06 1.96.95 3.864 1.43 4.47 1.15.15-.07.33-.32.33-.32s-.11.48-.19.6c-.1.13-.29.27-.47.32-.95.25-3.44-.34-5.6-1.58-2.42.36-5.08 1.01-7.21 1.71-2.094 3.67-3.668 5.35-4.948 4.71l-.47-.24c-.19-.11-.22-.38-.18-.59.15-.73 1.063-1.83 2.9-2.93.2-.12 1.08-.59 1.08-.59s-.65.63-.805.75c-1.47 1.2-2.55 2.71-2.527 3.3 1.26-.13 3.13-2.667 5.53-7.37.58-1.14 1.248-2.426 1.778-3.72zm-1.02 4.108c-.4.756-.8 1.457-1.16 2.1 2-.84 4.16-1.376 6.21-1.758-.28-.19-.55-.392-.8-.606-1.14-.957-2-2.15-2.62-3.408-.4 1.068-.87 2.202-1.65 3.672z"/>
									</svg>'
			);
}

function get_holidays($year)
{
	$holidays = array();
	
	$d1 = new DateTime($year.'-03-21');
	$d1->add(new DateInterval('P'.easter_days($year).'D'));
	$d1->add(new DateInterval('P1D')); // lundi
	$holidays['easter_monday'] = $d1->format('Y-m-d');
	
	$d1->sub(new DateInterval('P3D')); // vendredi
	$holidays['good_friday'] = $d1->format('Y-m-d');
	
	$d1 = new DateTime($year.'-05-25');
	$d1->modify('previous monday');
	$holidays['queen-patriots'] = $d1->format('Y-m-d');
	
	$d1 = new DateTime($year.'-09-01');
	$d1->modify('first monday');
	$holidays['labor-day']  = $d1->format('Y-m-d');
	
	$d1 = new DateTime($year.'-10-01');
	$d1->modify('second monday');
	$holidays['thanks-giving'] = $d1->format('Y-m-d');
	
	$d1 = new DateTime($year.'-07-01');
	if ($d1->format('N') == 7) $holidays['canada-day'] = $d1->add(new DateInterval('P1D'))->format('Y-m-d');
	else $holidays['canada-day'] = $d1->format('Y-m-d');
	
	$d1 = new DateTime($year.'-05-24');
	$holidays['saint-Jean'] = $d1->format('Y-m-d');
	
	$d1 = new DateTime($year.'-01-01');
	$holidays['new_year'] = $d1->format('Y-m-d');
	
	$d1 = new DateTime($year.'-12-25');
	$holidays['christmas'] = $d1->format('Y-m-d');
	
	return $holidays;
}

function get_manager_type()
{
	return array(0 => '<input class="trash" type="image" src="'.site_url().'assets/images/icn_alert_error.png">',
	1 => '<input class="trash" type="image" src="'.site_url().'assets/images/icn_alert_success.png">');
}
