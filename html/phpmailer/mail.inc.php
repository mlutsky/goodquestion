<?
require("phpmailer.inc.php");

class my_phpmailer extends phpmailer {
	// Set default variables for all new objects
	var $From = "mlutsky@college.harvard.edu";
	var $FromName = "GoodQuestion";
	var $Mailer = "smtp";
	var $WordWrap = 75;
	var $Encoding = "8bit";
	
	// Replace the default error_handler
	function error_handler($msg) {
		print("Email System Error");
		printf("%s", $msg);
		exit;
	}
}

?>
