<?php
function url_exists($url)
{
	$result = false;
	$url = filter_var($url, FILTER_VALIDATE_URL);
	$handle = curl_init($url);
	curl_setopt_array($handle, array(
		CURLOPT_FOLLOWLOCATION => TRUE,     
		CURLOPT_NOBODY => TRUE,            
		CURLOPT_HEADER => FALSE,            
		CURLOPT_RETURNTRANSFER => FALSE,    
		CURLOPT_SSL_VERIFYHOST => FALSE,    
		CURLOPT_SSL_VERIFYPEER => FALSE     
	));

	$response = curl_exec($handle);
	$httpCode = curl_getinfo($handle, CURLINFO_EFFECTIVE_URL); 
	$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);  
	if ($httpCode == 200) {
		$result = true;
	}

	return $result;
	curl_close($handle);
}

function http_request($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
function getBrowser()
{
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version = "";
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}

	if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif (preg_match('/Firefox/i', $u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif (preg_match('/OPR/i', $u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif (preg_match('/Netscape/i', $u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	} elseif (preg_match('/Edge/i', $u_agent)) {
		$bname = 'Edge';
		$ub = "Edge";
	} elseif (preg_match('/Trident/i', $u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	}

	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		
	}
	
	$i = count($matches['browser']);
	if ($i != 1) {
		
		if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
			$version = $matches['version'][0];
		} else {
			$version = $matches['version'][1];
		}
	} else {
		$version = $matches['version'][0];
	}

	if ($version == null || $version == "") {
		$version = "?";
	}

	return array(
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'    => $pattern
	);
}
function enkripsi($string)
{
	$output = false;

	$encrypt_method = "AES-256-CBC";
	$secret_key = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';
	$secret_iv = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';

	$key = hash('sha256', $secret_key);

	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($output);

	return $output;
}

function dekripsi($string)
{
	$output = false;

	$encrypt_method = "AES-256-CBC";
	$secret_key = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';
	$secret_iv = 'abcdefghijklmnopqrstuvwxyzABNCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|}{:?><';

	$key = hash('sha256', $secret_key);

	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

	return $output;
}
function cek_session_admin()
{

	$level = $_SESSION['level'];
	if ($level != 'admin') {

		echo "<script>document.location='.';</script>";
		exit();
	}
}
function cek_session_siswa()
{
	if (!isset($_SESSION['id_siswa'])) {
		echo "<script>document.location='.';</script>";
		exit();
	}
}

function cek_session_guru()
{
	$level = $_SESSION['level'];
	if ($level != 'guru' and $level != 'admin' and $level != 'kepala') {
		echo "<script>document.location='.';</script>";
		exit();
	}
}

function jump($page)
{
	echo "<script>location=('$page');</script>";
}
function info($string, $type = null)
{
	if ($type == 'OK') {
		$class = "success";
		$icon = "fa-check";
	} elseif ($type == 'NO') {
		$class = "danger";
		$icon = "fa-warning";
	} else {
		$class = "warning";
		$icon = "fa-info-circle";
	}
	return "<p class='text-$class'><i class='fa $icon'></i> $string</p>";
}
function timeAgo($tanggal)
{
	$ayeuna = date('Y-m-d H:i:s');
	$detik = strtotime($ayeuna) - strtotime($tanggal);
	if ($detik <= 0) {
		return "Baru saja";
	} else {
		if ($detik < 60) {
			return $detik . " detik";
		} else {
			$menit = $detik / 60;
			if ($menit < 60) {
				return number_format($menit, 0) . " menit";
			} else {
				$jam = $menit / 60;
				if ($jam < 24) {
					return number_format($jam, 0) . " jam";
				} else {
					$hari = $jam / 24;
					if ($hari < 2) {
						return "Kemarin";
					} elseif ($hari < 3) {
						return number_format($hari, 0) . " hari";
					} else {
						return $tanggal;
					}
				}
			}
		}
	}
}

function bulan_indo($tanggal)
{
	$bulan = array(
		1 =>
		'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $bulan[(int) $pecahkan[1]];
}

function buat_tanggal($format, $time = null)
{
	$time = ($time == null) ? time() : strtotime($time);
	$str = date($format, $time);
	for ($t = 1; $t <= 9; $t++) {
		$str = str_replace("0$t ", "$t ", $str);
	}
	$str = str_replace("Jan", "Januari", $str);
	$str = str_replace("Feb", "Februari", $str);
	$str = str_replace("Mar", "Maret", $str);
	$str = str_replace("Apr", "April", $str);
	$str = str_replace("May", "Mei", $str);
	$str = str_replace("Jun", "Juni", $str);
	$str = str_replace("Jul", "Juli", $str);
	$str = str_replace("Aug", "Agustus", $str);
	$str = str_replace("Sep", "September", $str);
	$str = str_replace("Oct", "Oktober", $str);
	$str = str_replace("Nov", "Nopember", $str);
	$str = str_replace("Dec", "Desember", $str);
	$str = str_replace("Mon", "Senin", $str);
	$str = str_replace("Tue", "Selasa", $str);
	$str = str_replace("Wed", "Rabu", $str);
	$str = str_replace("Thu", "Kamis", $str);
	$str = str_replace("Fri", "Jumat", $str);
	$str = str_replace("Sat", "Sabtu", $str);
	$str = str_replace("Sun", "Minggu", $str);
	return $str;
}
function enum($bool)
{
	$bool = ($bool == 1) ? 'Ya' : 'Tidak';
	return $bool;
}
function html2str($str)
{
	$str = str_replace('"', "”", $str);
	$str = str_replace("'", "’", $str);
	$str = str_replace("<", "&lt;", $str);
	$str = str_replace(">", "&gt;", $str);
	return $str;
}

function create_zip($files = array(), $destination = '', $overwrite = false)
{	
	if (file_exists($destination) && !$overwrite) {
		return false;
	}
	
	if (is_array($files)) {
				
		foreach ($files as $file) {
		
			if (file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	} elseif (is_dir($files)) {
		if ($handle = opendir($files)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && !is_dir($files . '/' . $entry)) {
					$valid_files[] = $files . '/' . $entry;
				}
			}
			closedir($handle);
		}
	}
	
	if (count($valid_files)) {
		
		$zip = new ZipArchive();
		if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		
		foreach ($valid_files as $file) {
			$zip->addFile($file, $file);
		}
		
		$zip->close();
		
		return file_exists($destination);
	} else {
		return false;
	}
}


function genPass($panjang)
{
	$karakter = 'abcdefghijklmnopqrstuvwxyz123456789';
	$string = '';
	for ($i = 0; $i < $panjang; $i++) {
		$pos = rand(0, strlen($karakter) - 1);
		$string .= $karakter[$pos];
	}
	return $string;
}

if (!function_exists('cutText')) {

	function cutText($text, $length, $mode = 2)
	{
		if ($mode != 1) {
			$char = $text[$length - 1];
			switch ($mode) {
				case 2:
					while ($char != ' ') {
						$char = $text[--$length];
					}
				case 3:
					while ($char != ' ') {
						$char = $text[++$num_char];
					}
			}
		}
		return substr($text, 0, $length);
	}
}

function lamaujian($seconds)
{

	if ($seconds) {
		$gmdate = gmdate("z:H:i:s", $seconds);
		$data = explode(":", $gmdate);

		$string = isset($data[0]) && $data[0] > 0 ? $data[0] . " Hari" : "";
		$string .= isset($data[1]) && $data[1] > 0 ? $data[1] . " Jam " : "";
		$string .= isset($data[2]) && $data[2] > 0 ? $data[2] . " Menit " : "";
	} else {
		$string = '--';
	}
	return $string;
}
