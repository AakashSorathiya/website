<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/*
	|--------------------------------------------------------------------------
	|	User Agent
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	The "user agent"
	*/
	$config["useragent"]	= "CodeIgniter";

	/*
	|--------------------------------------------------------------------------
	|	Protocol
	|--------------------------------------------------------------------------
	|
	|	Opions:			mail, sendmail, or smtp
	|	Description:	The mail sending protocol.
	*/
	$config["protocol"]	= "mail";

	/*
	|--------------------------------------------------------------------------
	|	Mail Path
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	The server path to Sendmail.
	*/
	$config["mailpath"]	= "/usr/sbin/sendmail";

	/*
	|--------------------------------------------------------------------------
	|	STMP Host
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	SMTP Server Address.
	*/
	$config["smtp_host"]	= "No Default";

	/*
	|--------------------------------------------------------------------------
	|	STMP Username
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	SMTP Username.
	*/
	$config["smtp_user"]	= "No Default";

	/*
	|--------------------------------------------------------------------------
	|	STMP Password
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	SMTP Password.
	*/
	$config["smtp_pass"]	= "No Default";

	/*
	|--------------------------------------------------------------------------
	|	STMP Port
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	SMTP Port.
	*/
	$config["smtp_port"]	= 25;

	/*
	|--------------------------------------------------------------------------
	|	STMP Timeout
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	SMTP Timeout (in seconds).
	*/
	$config["smtp_timeout"]	= 5;

	/*
	|--------------------------------------------------------------------------
	|	Enable Wordwrap
	|--------------------------------------------------------------------------
	|
	|	Opions:			TRUE or FALSE (boolean)
	|	Description:	Enable word-wrap.
	*/
	$config["wordwrap"]	= TRUE;

	/*
	|--------------------------------------------------------------------------
	|	Wrap Limit
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	Character count to wrap at.
	*/
	$config["wrapchars"]	= 76;

	/*
	|--------------------------------------------------------------------------
	|	Mail Type
	|--------------------------------------------------------------------------
	|
	|	Opions:			text or html
	|	Description:	Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don't have any relative links or relative image paths otherwise they will not work.
	*/
	$config["mailtype"]	= "html";

	/*
	|--------------------------------------------------------------------------
	|	Character Set
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	Character set (utf-8, iso-8859-1, etc.).
	*/
	$config["charset"]	= "utf-8";

	/*
	|--------------------------------------------------------------------------
	|	Email Validation
	|--------------------------------------------------------------------------
	|
	|	Opions:			TRUE or FALSE (boolean)
	|	Description:	Whether to validate the email address.
	*/
	$config["validate"]	= FALSE;

	/*
	|--------------------------------------------------------------------------
	|	Email Priority
	|--------------------------------------------------------------------------
	|
	|	Opions:			1, 2, 3, 4, 5
	|	Description:	Email Priority. 1 = highest. 5 = lowest. 3 = normal.
	*/
	$config["priority"]	= 3;

	/*
	|--------------------------------------------------------------------------
	|	Cairrage Return Character
	|--------------------------------------------------------------------------
	|
	|	Opions:			"\r\n" or "\n" or "\r"
	|	Description:	Newline character. (Use "\r\n" to comply with RFC 822).
	*/
	$config["crlf"]	= "\r\n";

	/*
	|--------------------------------------------------------------------------
	|	New Line Character
	|--------------------------------------------------------------------------
	|
	|	Opions:			"\r\n" or "\n" or "\r"
	|	Description:	Newline character. (Use "\r\n" to comply with RFC 822).
	*/
	$config["newline"]	= "\r\n";

	/*
	|--------------------------------------------------------------------------
	|	BCC Configuration
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	Enable BCC Batch Mode.
	*/
	$config["bcc_batch_mode"]	= FALSE;

	/*
	|--------------------------------------------------------------------------
	|	BCC Batch Size
	|--------------------------------------------------------------------------
	|
	|	Opions:			None
	|	Description:	Number of emails in each BCC batch.
	*/
	$config["bcc_batch_size"]	= 200;
?>