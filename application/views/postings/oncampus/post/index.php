<?php
/**
 * Copyright (c) Rochester Institute of Technology, All Rights Reserved.
 *
 * $URL: svn+ssh://shell01off01.rit.edu/home/w-seo/svnrepo/edu.rit.seo/branches/old-1.0/www/employers/oncampus/postjob.php $
 * $Id: postjob.php 3 2009-03-20 19:42:55Z sto9228 $
 * $Author: sto9228 $
 * $Date: 2009-03-20 15:42:55 -0400 (Fri, 20 Mar 2009) $
 * $Revision: 3 $
 */

require_once('SiteConfigVars.php');
require_once('./content/postings/scrub.php');

function populate($field_name) {
	if (isset($_POST[$field_name])) {
		return scrub( $_POST[$field_name] );
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
	if(isset($_POST['submit']) && strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0 ) {
		$header = "From: SEO Website <967dept@rit.edu>\n";
		$header .= "Reply-To: " . scrub ( $_POST['email'] ) .  "\n";
		$header .= "Return-Path: " . scrub ( $_POST['email'] ) .  "\n";
		$recipient = getConfigValue('formEmail');
		$subject = "On-Campus Job Posting Form - POST A JOB";
		$workdays = "";
		$workdays .= " " . populate('sunday') . " ";
		$workdays .= " " . populate('monday') . " ";
		$workdays .= " " . populate('tuesday') . " ";
		$workdays .= " " . populate('wednesday') . " ";
		$workdays .= " " . populate('thursday') . " ";
		$workdays .= " " . populate('friday') . " ";
		$workdays .= " " . populate('saturday') . " ";
		$msg = "Submitted: " . date("D d-M-Y h:i:s A T") . "\n\n";
		$msg .= "Action to Take: POST A JOB\n\n";
		$msg .= "Job Number: " . scrub ( $_POST['jobnumber'] ) .  "\n";
		$msg .= "Job Title: " . scrub ( $_POST['jobtitle'] ) .  "\n\n";
		$msg .= "Contact: " . scrub ( $_POST['name'] ) .  "\n";
		$msg .= "Department: " . scrub ( $_POST['department'] ) .  "\n";
		$msg .= "Phone: " . scrub ( $_POST['phone'] ) .  "\n";
		$msg .= "Email: " . scrub ( $_POST['email'] ) .  "\n";
		$msg .= "Post Phone?: " . scrub ( $_POST['postphone'] ) .  "\n";
		$msg .= "Post Email?: " . scrub ( $_POST['postemail'] ) .  "\n";
		$msg .= "Start Date: " . scrub ( $_POST['startdate'] ) .  "\n";
		$msg .= "Hours/Week: " . scrub ( $_POST['hoursweek'] ) .  "\n";
		$msg .= "Work Hours: " . scrub ( $_POST['workhours'] ) .  "\n";
		$msg .= "Wage: " . scrub ( $_POST['wage'] ) .  "\n";
		$msg .= "Days: " . trim($workdays) . "\n";
		$errors = array();
		if(!is_jobnumber($_POST['jobnumber'])) {
			$errors[] = "Job Number must be 6 digits long";
		}
		if(strlen($_POST['jobtitle']) == 0) {
			$errors[] = "Job Title";
		}
		if(strlen($_POST['startdate']) == 0) {
			$errors[] = "Start Date";
		}
		if(strlen($_POST['hoursweek']) == 0) {
			$errors[] = "Hours/Week";
		}
		if(strlen($_POST['workhours']) == 0) {
			$errors[] = "Work Hours";
		}
		if(strlen($_POST['wage']) == 0) {
			$errors[] = "Wage";
		}
		if(strlen(trim($workdays)) == 0) {
			$errors[] = "Days";
		}
		if(strlen($_POST['name']) == 0) {
			$errors[] = "Name";
		}
		if(strlen($_POST['department']) == 0) {
			$errors[] = "Department";
		}
		if(strlen($_POST['phone']) == 0) {
			$errors[] = "Phone";
		}
		if(strlen($_POST['postphone']) == 0) {
			$errors[] = "Post Phone?";
		}
		if(strlen($_POST['email']) == 0) {
			$errors[] = "Email";
		}
		if(strlen($_POST['postemail']) == 0) {
			$errors[] = "Post Email?";
		}
		if(count($errors) == 0) {
			
			// Required by security scanner before db/mail commands
			// require_once('ExitIfSecurityScanner.php');
			if ( mail($recipient, $subject, $msg, $header)) {
				$success = true;
				$showForm = false;
			} else {
				$submitErr = true;
			}
		} else {
			$fieldErr = true;
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>RIT - Student Employment Office - On-Campus Job Posting Form</title>
	</head>
	<body>
		<div id="maincontent">
			<a name="pagecontent"></a>
			<h1>On-Campus Job Posting Form</h1>
	<?php if($showForm) { ?>
			<p>
				The On-Campus Job Posting Form can only be used to post existing jobs that you have on-file with the SEO.
				If this is a <b>NEW</b> position, you will need to submit an <a href="?/employers/resources/">SEO Job Description Form</a>.
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
				Thank you. Your job posting has been submitted to the SEO for processing, and will be viewable online within
				24 hours.
			</p>
			<h3>Job Information</h3>
			<blockquote>
				<p>
					<b>Job Number:</b> <?php echo scrub ( $_POST['jobnumber'] ); ?><br />
					<b>Job Title:</b> <?php echo scrub ( $_POST['jobtitle'] ); ?><br />
					<b>Start Date:</b> <?php echo scrub ( $_POST['startdate'] ); ?><br />
					<b>Hours/Week:</b> <?php echo scrub ( $_POST['hoursweek'] ); ?><br />
					<b>Work Hours:</b> <?php echo scrub ( $_POST['workhours'] ); ?><br />
					<b>Wage:</b> <?php echo scrub ( $_POST['wage'] ); ?><br />
					<b>Days:</b> <?php echo trim($workdays); ?>
				</p>
			</blockquote>
			<h3>Contact Information</h3>
			<blockquote>
				<p>
					<b>Name:</b> <?php echo scrub ( $_POST['name'] ); ?><br />
					<b>Department:</b> <?php echo scrub ( $_POST['department'] ); ?><br />
					<b>Phone:</b> <?php echo scrub ( $_POST['phone'] ); ?><br />
					<b>Post Phone?:</b> <?php echo scrub ( $_POST['postphone'] ); ?><br />
					<b>Email:</b> <?php echo scrub ( $_POST['email'] ); ?><br />
					<b>Post Email?:</b> <?php echo scrub ( $_POST['postemail'] ); ?>
				</p>
			</blockquote>
	<?php } else if($fieldErr) { ?>
			<div class="errorbox">
				<h2><span class="error">Form NOT Submitted!</span></h2>
				<p>
					The following field(s) appear to be blank or contain incorrect data.
				</p>
				<blockquote>
					<p>
				<?php
					for($i = 0; $i < count($errors); $i++) {
						echo $errors[$i];
						if($i != count($errors) - 1) {
							echo "<br />";
						}
					}
				?>
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
			<form method="post" action="?/postings/oncampus/post/">
				<fieldset>
					<legend>Job Information</legend>
					<div>
						<label for="jobnumber">Job Number*:</label>
						<input type="text" name="jobnumber" id="jobnumber" size="25" maxlength="6" value="<?php echo populate('jobnumber'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="jobtitle">Job Title*:</label>
						<input type="text" name="jobtitle" id="jobtitle" size="25" maxlength="50" value="<?php echo populate('jobtitle'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="startdate">Start Date*:</label>
						<input type="text" name="startdate" id="startdate" size="25" maxlength="50" value="<?php echo populate('startdate'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="hoursweek">Hours/Week*:</label>
						<input type="text" name="hoursweek" id="hoursweek" size="25" maxlength="50" value="<?php echo populate('hoursweek'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="workhours">Work Hours*:</label>
						<input type="text" name="workhours" id="workhours" size="25" maxlength="50" value="<?php echo populate('workhours'); ?>" />
					</div>
					<div>
						<label for="wage">Wage*:</label>
						<input type="text" name="wage" id="wage" size="25" maxlength="50" value="<?php echo populate('wage'); ?>" />
					</div>
					<div class="cr">
						<p>Days*:</p>
						<label for="sunday">
							<input class="radiobutton" type="checkbox" name="sunday" id="sunday" value="Sunday" />
							Sunday
						</label>
						<label for="monday">
							<input class="radiobutton" type="checkbox" name="monday" id="monday" value="Monday" />
							Monday
						</label>
						<label for="tuesday">
							<input class="radiobutton" type="checkbox" name="tuesday" id="tuesday" value="Tuesday" />
							Tuesday
						</label>
						<label for="wednesday">
							<input class="radiobutton" type="checkbox" name="wednesday" id="wednesday" value="Wednesday" />
							Wednesday
						</label>
						<label for="thursday">
							<input class="radiobutton" type="checkbox" name="thursday" id="thursday" value="Thursday" />
							Thursday
						</label>
						<label for="friday">
							<input class="radiobutton" type="checkbox" name="friday" id="friday" value="Friday" />
							Friday
						</label>
						<label for="saturday">
							<input class="radiobutton" type="checkbox" name="saturday" id="saturday" value="Saturday" />
							Saturday
						</label>
					</div>
				</fieldset>
				<fieldset>
					<legend>Contact Information</legend>
					<div>
						<label for="name">Name*:</label>
						<input type="text" name="name" id="name" size="25" maxlength="50" value="<?php echo populate('name'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="department">Department*:</label>
						<input type="text" name="department" id="department" size="25" maxlength="50" value="<?php echo populate('department'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="phone">Phone*:</label>
						<input type="text" name="phone" id="phone" size="25" maxlength="50" value="<?php echo populate('phone'); ?>" />
					</div>
					<br class="remove" />
					<div class="cr">
						<p>Post Phone?*:</p>
						<label>
							<input class="radiobutton" type="radio" name="postphone" value="Yes" checked="checked" />
							Yes
						</label>
						<label>
							<input class="radiobutton" type="radio" name="postphone" value="No" />
							No
						</label>
					</div>
					<div>
						<label for="email">Email*:</label>
						<input type="text" name="email" id="email" size="25" maxlength="50" value="<?php echo populate('email'); ?>" />
					</div>
					<br class="remove" />
					<div class="cr">
						<p>Post Email?*:</p>
						<label>
							<input class="radiobutton" type="radio" name="postemail" value="Yes" checked="checked" />
							Yes
						</label>
						<label>
							<input class="radiobutton" type="radio" name="postemail" value="No" />
							No
						</label>
					</div>
				</fieldset>
				<br />
				<div>
					<input class="submitbutton" type="submit" name="submit" value="Submit" />
				</div>
			</form>
	<?php } ?>
			<div id="clearer">&nbsp;</div>
		</div>
	</body>
</html>
