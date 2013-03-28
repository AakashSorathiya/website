<?php
/**
 * Copyright (c) Rochester Institute of Technology, All Rights Reserved.
 *
 * $URL: svn+ssh://shell01off01.rit.edu/home/w-seo/svnrepo/edu.rit.seo/branches/old-1.0/www/employers/oncampus/removejob.php $
 * $Id: removejob.php 3 2009-03-20 19:42:55Z sto9228 $
 * $Author: sto9228 $
 * $Date: 2009-03-20 15:42:55 -0400 (Fri, 20 Mar 2009) $
 * $Revision: 3 $
 */ 

require_once('SiteConfigVars.php');
require_once('./content/postings/scrub.php');

function populate($field_name) {
	if (isset($_POST[$field_name])) {
		return scrub ( $_POST[$field_name] );
	}
}
function is_jobnumber($number) {
	$retVal = true;
	if(strlen($number) != 6 || ereg("[^0-9]", $number)) {
		$retVal = false;
	}
	return $retVal;
}

	$showForm = true;
	$success = false;
	$fieldErr = false;
	$submitErr = false;
	
	if(isset($_POST['submit']) && strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
		$header = "From: SEO Website <967dept@rit.edu>\n";
		$header .= "Reply-To: 967dept@rit.edu\n";
		$header .= "Return-Path: 967dept@rit.edu\n";
		$recipient = getConfigValue('formEmail');
		$subject = "On-Campus Job Removal Form - REMOVE FROM WEB";
		$msg = "Submitted: " . date("D d-M-Y h:i:s A T") . "\n\n";
		$msg .= "Action to Take: REMOVE FROM WEB\n\n";
		$msg .= "Job Number: " . scrub ( $_POST['jobnumber'] );
		if(!is_jobnumber( scrub ( $_POST['jobnumber'] ))) {
			$fieldErr = true;
		} else {
			// Required by security scanner before db/mail commands
			// require_once('ExitIfSecurityScanner.php');
			if (mail($recipient, $subject, $msg, $header))
			{
				$success = true;
				$showForm = false;
			}
			else
			{
				$submitErr = true;
			}
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>RIT - Student Employment Office - On-Campus Job Removal Form</title>
	</head>
	<body>
		<div id="maincontent">
			<a name="pagecontent"></a>
			<h1>On-Campus Job Removal Form</h1>
	<?php if($showForm) { ?>
			<p>
				This form may be used to remove a job currently posted on the SEO website. If you do not know what your
				job number is, please <a href="../../contact.php">contact the SEO</a>. If you would like to create or
				post a <b>NEW</b> job, you will need to submit an <a href="forms.php">SEO Job Description Form</a>.
			</p>
			<p>
				* denotes a required field.
			</p>
	<?php } ?>
	<?php if($success) { ?>
			<div class="successbox">
				<h2><span class="success">Form Submitted</span></h2>
			</div>
			<p>
				Job Number <b><?php echo scrub ( $_POST['jobnumber'] ); ?></b> will be removed from the
				SEO website within 24 hours.
			</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
	<?php } else if($fieldErr) { ?>
			<div class="errorbox">
				<h2><span class="error">Form NOT Submitted!</span></h2>
				<p>
					The following field appears to be blank or contains incorrect data:
				</p>
				<blockquote>
					<p>
						Job Number must be 6 digits long
					</p>
				</blockquote>
			</div>
	<?php } else if($submitErr) { ?>
			<div class="errorbox">
				<h2><span class="error">Form NOT Submitted!</span></h2>
				<p>
					An error occurred attempting to submit the form. Please try again later.
				</p>
			</div>
	<?php } ?>
	<?php if($showForm) { ?>
			<form method="post" action="?/postings/oncampus/remove/">
				<fieldset>
					<legend>Remove a Job</legend>
					<div>
						<label for="jobnumber">Job Number*:</label>
						<input type="text" name="jobnumber" id="jobnumber" size="25" maxlength="6" value="<?php echo populate('jobnumber'); ?>" />
					</div>
				</fieldset>
				<br />
				<div>
					<input class="submitbutton" type="submit" name="submit" id="submit" value="Submit" />
				</div>
			</form>
	<?php } ?>
			<div id="clearer">&nbsp;</div>
		</div>
	</body>
</html>
