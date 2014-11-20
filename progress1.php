<?php
set_time_limit(0);
ob_start();
include("smarty_config.php");
/**
 * Progress bar for a lengthy PHP process
 * http://spidgorny.blogspot.com/2012/02/progress-bar-for-lengthy-php-process.html
 */
$INCLUDE_DIR = "mailer/";
    require($INCLUDE_DIR . "class.phpmailer.php");
	$mail = new PHPMailer();
class ProgressBar {
	var $percentDone = 0;
	var $pbid;
	var $pbarid;
	var $tbarid;
	var $textid;
	var $decimals = 1;

	function __construct($percentDone = 0) {
		$this->pbid = 'pb';
		$this->pbarid = 'progress-bar';
		$this->tbarid = 'transparent-bar';
		$this->textid = 'pb_text';
		$this->percentDone = $percentDone;
	}

	function render() {
		//print ($GLOBALS['CONTENT']);
		//$GLOBALS['CONTENT'] = '';
		print($this->getContent());
		$this->flush();
		//$this->setProgressBarProgress(0);
	}

	function getContent() {
		$this->percentDone = floatval($this->percentDone);
		$percentDone = number_format($this->percentDone, $this->decimals, '.', '') .'%';
		$content .= '<div id="'.$this->pbid.'" class="pb_container">
			<div id="'.$this->textid.'" class="'.$this->textid.'">'.$percentDone.'</div>
			<div class="pb_bar">
				<div id="'.$this->pbarid.'" class="pb_before"
				style="width: '.$percentDone.';"></div>
				<div id="'.$this->tbarid.'" class="pb_after"></div>
			</div>
			<br style="height: 1px; font-size: 1px;"/>
		</div>
		<style>
			.pb_container {
				position: relative;
			}
			.pb_bar {
				width: 100%;
				height: 1.3em;
				border: 1px solid silver;
				-moz-border-radius-topleft: 5px;
				-moz-border-radius-topright: 5px;
				-moz-border-radius-bottomleft: 5px;
				-moz-border-radius-bottomright: 5px;
				-webkit-border-top-left-radius: 5px;
				-webkit-border-top-right-radius: 5px;
				-webkit-border-bottom-left-radius: 5px;
				-webkit-border-bottom-right-radius: 5px;
			}
			.pb_before {
				float: left;
				height: 1.3em;
				background-color: #43b6df;
				-moz-border-radius-topleft: 5px;
				-moz-border-radius-bottomleft: 5px;
				-webkit-border-top-left-radius: 5px;
				-webkit-border-bottom-left-radius: 5px;
			}
			.pb_after {
				float: left;
				background-color: #FEFEFE;
				-moz-border-radius-topright: 5px;
				-moz-border-radius-bottomright: 5px;
				-webkit-border-top-right-radius: 5px;
				-webkit-border-bottom-right-radius: 5px;
			}
			.pb_text {
				padding-top: 0.1em;
				position: absolute;
				left: 48%;
			}
		</style>'."\r\n";
		return $content;
	}

	function setProgressBarProgress($percentDone, $text = '') {
		$this->percentDone = $percentDone;
		$text = $text ? $text : number_format($this->percentDone, $this->decimals, '.', '').'%';
		print('
		<script type="text/javascript">
		if (document.getElementById("'.$this->pbarid.'")) {
			document.getElementById("'.$this->pbarid.'").style.width = "'.$percentDone.'%";');
		if ($percentDone == 100) {
			print('document.getElementById("'.$this->pbid.'").style.display = "none";');
		} else {
			print('document.getElementById("'.$this->tbarid.'").style.width = "'.(100-$percentDone).'%";');
		}
		if ($text) {
			print('document.getElementById("'.$this->textid.'").innerHTML = "'.htmlspecialchars($text).'";');
		}
		print('}</script>'."\n");
		$this->flush();
	}

	function flush() {
		print str_pad('', intval(ini_get('output_buffering')))."\n";
		//ob_end_flush();
		flush();
	}

}

echo 'Starting&hellip;<br />';

$p = new ProgressBar();
echo '<div style="width: 300px;">';
$p->render();
echo '</div>';
	
 $email_query = "SELECT * FROM user_tbl";
	$email_result = mysql_query($email_query);
	 $email_count          =  mysql_num_rows($email_result);
	$counti = 1;
	while($email_data = mysql_fetch_array($email_result))
	{
	        $email_data["firstname"];
		    $mail->IsSMTP();                                   // send via SMTP
			$mail->Host = "smtp.1and1.com";
			//$mail->Host     = "smtp.gmail.com"; // SMTP servers
			$mail->Port     = 587; // SMTP Port
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username = "eblast@desss.com";  // SMTP username
			$mail->Password = "1234567"; // SMTP password
			$mail->From     = "eblast@desss.com";
			//$mail->FromName = $fet_qual['company_name'];
			$mail->FromName = "Desss";
			$mail->addAttachment($banPathNme);

			$mail->AddAddress($email_address);	

$mail->IsHTML(true);                              
$mail->Subject  =  "TEst";
$mail->Body     =  "TEst";
$mail->Send();
$p->setProgressBarProgress(intval($counti/$email_count * 100));
echo '<br>'.$counti;

   $counti++;
    }	
	


$p->setProgressBarProgress(100);

echo 'Done.<br />';