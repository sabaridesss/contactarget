<?php
ob_start();
include("smarty_config.php");
include("phpmailfunction.php");
function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
$php_mail = new phpmail_function();


$company_admin 		= $_REQUEST['company_users']; 

$check         =     "SELECT information FROM footer_content WHERE company_admin='".$company_admin."'";
$check_record 	    =     mysql_query($check); 


$gen_info='<p>Law firms providing financial services, such as estate and tax planning, to individuals are now required by federal law to inform their clients of their policies regarding privacy of client information. We have always safeguarded the confidentiality of information provided to us by our clients and are bound by our professional standards to continue to maintain this vital aspect of our professional relationship.</p>
<p><strong>I.&nbsp; Acquisition of Client Information</strong></p>
<blockquote dir="ltr" style="margin-right: 0px;">
<p>The firm collects nonpublic personal information about our clients from the following sources:</p>
</blockquote>
<ul>
<li>Information You Provide: Our client engagements routinely require us to obtain private information about our clients so that we can proceed with the various services we perform for our clients as part of the professional relationship.</li>
<li>Other Sources: Depending upon the particular service a client has engaged the firm to complete, we may request nonpublic information concerning the matter at hand. However, this information is never obtained without our client&rsquo;s specific authorization for the type of information and the source(s) from which it may be obtained.</li>
</ul>
<p><strong>II.&nbsp;Disclosure of Nonpublic Information</strong></p>
<blockquote dir="ltr" style="margin-right: 0px;">
<p>Our firm policy is never to disclose nonpublic information about our clients. Nonpublic personal information is defined in the regulations as any publicly available information that we acquire by using information you have provided us in connection with any professional services we perform for you, which is not public information. An example would be a bank account number that is somehow used to acquire information regarding a court trial or other public record that would not have been found by us without using the bank account number acquired from you. In a generic sense, any information that a client provides us that involves financial product or service is likely considered nonpublic personal information and receives the same protection from disclosure as all other information about our clients. For purposes of our business relationships with our clients, all information acquired is disclosed only under the following conditions:</p>
</blockquote>
<ul>
<li>Employees of the firm: Employees who need such information to conclude a transaction for which the client has engaged the firm.</li>
<li>Service Providers: As with any business, we have our own accounting, insurance and other service firms that we may need to provide information that the regulations consider nonpublic personal information. An example might be your account activity for our accounting firm to prepare financial statements for our internal or external purposes. Another example would be computer consultants that must have access to certain client records so as to be able to increase the efficiency of our computer processing systems. We have always insisted that any such information that needed to be disclosed for a business purpose be considered confidential and not used for any purpose other than the specific business need. That well-understood business policy of confidentiality will be reinforced as needed by contractual agreements between such service providers to the firm, referencing the Federal Trade Commission (FTC) regulations.</li>
<li>Others: Other than as state above, we do not disclose nonpublic personal information, or any other information, to any outside party without specific client authorization. An example would be other professionals who are assisting the firm in carrying our a client engagement. In such a case, we would require the client&rsquo;s approval for such a disclosure.</li>
</ul>
<blockquote dir="ltr" style="margin-right: 0px;">
<p>In addition to the privacy protection that the new FTC regulations provide you, the Internal Revenue Code prevents the disclosure of client information provided for tax planning or preparation services without the client&rsquo;s written permission. Further, the ethics rules that govern the operation principles that our firm must follow prohibit disclosing client information.</p>
</blockquote>
<p><strong>III. Security Arrangements</strong></p>
<blockquote dir="ltr" style="margin-right: 0px;">
<p>We maintain physical, electronic and procedural safeguards that comply with federal regulations to guard our clients&rsquo; nonpublic personal information and any other information, to ensure our clients that their privacy is a major part of the firm&rsquo;s commitment to provide the finest service possible.</p>
</blockquote>
<p dir="ltr"><strong>IV.&nbsp; Opt Out Provision</strong></p>
<blockquote dir="ltr" style="margin-right: 0px;">
<p dir="ltr">The Federal Trade Commission regulations provide that this notice must include a provision for you to request that the firm not release your nonpublic personal information. While such a request is unnecessary, because the firm does not disclose your nonpublic personal information in a manner that would allow you to opt out, in the interests of satisfying regulations, we include this Opt Out Provision.</p>
</blockquote>
<p dir="ltr">if you have any questions, because your privacy, our professional standard, and the ability to provide you with quality professional services are very important to us.</p>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Privacy Policy</title>
<style type="text/css">
.content {
	background:#fff;
	padding:10px;
	margin-top:10px;
	border:1px solid #C0C0C0;
	max-width:800px;
	

}
.content p {
	font:normal 12px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
	text-align:center;
}
.content span {
	font:bold 14px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
	display:block;
}
.content ul {
	list-style:circle;
}
.content ul li {
	font:normal 12px/18px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
}
.spacer {
	clear:both;
}
</style>
</head>
<body class="content"  >
<center>
  <?php 

if($check_record)
{
if(mysql_num_rows($check_record)>0) { 

 $get_data=mysql_fetch_array($check_record);
 
 echo $get_data['information'];
  
  ?>
  <?php


}
else
{
echo $gen_info;
}
}
else
{
echo $gen_info;

}

 ?>
</center>
</body>
</body>
</html>
