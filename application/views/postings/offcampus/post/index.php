<?php
/**
 * Copyright (c) Rochester Institute of Technology, All Rights Reserved.
 *
 * $URL: svn+ssh://shell01off01.rit.edu/home/w-seo/svnrepo/edu.rit.seo/branches/old-1.0/www/employers/offcampus/postjob.php $
 * $Id: postjob.php 3 2009-03-20 19:42:55Z sto9228 $
 * $Author: sto9228 $
 * $Date: 2009-03-20 15:42:55 -0400 (Fri, 20 Mar 2009) $
 * $Revision: 3 $
 */

require_once( 'SiteConfigVars.php' );
require_once( 'cgi/scrub.php' );

function populate($field_name) {
	if (isset($_POST[$field_name])) {
		return scrub($_POST[$field_name]);
	}
}
	$errors = array();
	$showForm = true;
	$success = false;
	$fieldErr = false;
	$submitErr = false;
	if(isset($_POST['submit']) && strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
		
		unset($_POST['submit']);

		$header = "From: SEO Website ".getConfigValue('formEmail')."\n";
		$header .= "Reply-To: " . scrub ( $_POST['email'] ) .  "\n";
		$header .= "Return-Path: " . scrub ( $_POST['email'] ) .  "\n";
		$recipient = getConfigValue('formEmail');
		$subject = "Off-Campus Job Posting Form - POST A JOB";
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
		$msg .= "Job Category: " . scrub ( $_POST['jobcategory'] ) .  "\n\n";
		$msg .= "Company: " . scrub ( $_POST['company'] ) .  "\n";
		$msg .= "Address/Location: " . scrub ( $_POST['location'] ) .  "\n";
		$msg .= "City: " . scrub ( $_POST['city'] ) .  "\n";
		$msg .= "State: " . scrub ( $_POST['state'] ) .  "\n";
		$msg .= "Zip: " . scrub ( $_POST['zip'] ) .  "\n";
		$msg .= "Phone: " . scrub ( $_POST['phone'] ) .  "\n";
		$msg .= "Fax: " . scrub ( $_POST['fax'] ) .  "\n";
		$msg .= "Email: " . scrub ( $_POST['email'] ) .  "\n\n";
		$msg .= "Job Title: " . scrub ( $_POST['position'] ) .  "\n";
		$msg .= "Wage: " . scrub ( $_POST['wage'] ) .  "\n";
		$msg .= "Work Hours: " . scrub ( $_POST['workhours'] ) .  "\n";
		$msg .= "Hours/Week: " . scrub ( $_POST['hoursweek'] ) .  "\n";
		$msg .= "Days: " . trim($workdays) . "\n\n";
		$msg .= "Start Date: " . scrub ( $_POST['startdate'] ) .  "\n";
		$msg .= "Contact: " . scrub ( $_POST['name'] ) .  "\n\n";
		$msg .= "Position Summary:\n";
		$msg .= $_POST['summary'] . "\n\n";
		$msg .= "Position Requirements:\n";
		$msg .= $_POST['requirements'] . "\n";
		
		if(strlen($_POST['company']) == 0) {
			$errors[] = "Company";
		}
		if(strlen($_POST['location']) == 0) {
			$errors[] = "Address/Location";
		}
		if(strlen($_POST['name']) == 0) {
			$errors[] = "Name";
		}
		if(strlen($_POST['email']) == 0) {
			$errors[] = "Email";
		}
		if(strlen($_POST['position']) == 0) {
			$errors[] = "Position";
		}
		if(strlen($_POST['startdate']) == 0) {
			$errors[] = "Start Date";
		}
		if(strlen($_POST['hoursweek']) == 0) {
			$errors[] = "Hours/Week";
		}
		if(strlen($_POST['wage']) == 0) {
			$errors[] = "Wage";
		}
		else if(!preg_match('#[0-9]#',$_POST['wage'])) {
			$errors[] = "Wage - Please enter an hourly rate or lump sum amount.";
		}
		if(strlen($_POST['jobcategory']) == 0) {
			$errors[] = "Job Category";
		}
		if(strlen($_POST['summary']) == 0) {
			$errors[] = "Position Summary";
		}
		if(strlen($_POST['requirements']) == 0) {
			$errors[] = "Position Requirements";
		}

		if($_SERVER["REMOTE_ADDR"] != '129.21.22.145'){

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

		}else if(count($errors) == 0) {

			$success = true;
			$showForm = false;

		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>RIT - Student Employment Office - Off-Campus Job Posting Form</title>
	</head>
	<body>
		<div id="maincontent">
			<a name="pagecontent"></a>
			<h1>Off-Campus Job Posting Form</h1>
	<?php if($showForm) { ?>
			<p>
				Before submitting, please ensure that all required fields have been filled.
			</p>
			<p>
				Once the form is submitted, the job posting will be viewable online within 24 hours. All off-campus
				job postings will be removed from the SEO website 30 days after being posted. If the position is filled
				before 30 days, please <a href="?/home/contact/">contact the SEO</a> so that the job posting can
				be removed.
			</p>
			<h2>Notice to ALL Off-Campus Employers</h2>
			<p>
				This form is only to be used to post <b>part-time and summer employment opportunities</b> for RIT
				students. For information on how to list full-time career or co-op job opportunities, please contact
				the <a href="http://www.rit.edu/~964www/">Co-op and Career Services Office</a>.
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
				24 hours. Please print this page for your records.
			</p>
			<h3>Company Information</h3>
			<blockquote>
				<p>
					<b>Company:</b> <?php echo scrub ( $_POST['company'] ); ?><br />
					<b>Address/Location:</b> <?php echo scrub ( $_POST['location'] ); ?><br />
					<b>City:</b> <?php echo scrub ( $_POST['city'] ); ?><br />
					<b>State:</b> <?php echo scrub ( $_POST['state'] ); ?><br />
					<b>Zip:</b> <?php echo scrub ( $_POST['zip'] ); ?>
				</p>
			</blockquote>
			<h3>Contact Information</h3>
			<blockquote>
				<p>
					<b>Name:</b> <?php echo scrub ( $_POST['name'] ); ?><br />
					<b>Phone:</b> <?php echo scrub ( $_POST['phone'] ); ?><br />
					<b>Fax:</b> <?php echo scrub ( $_POST['fax'] ); ?><br />
					<b>Email:</b> <?php echo scrub ( $_POST['email'] ); ?>
				</p>
			</blockquote>
			<h3>Job Information</h3>
			<blockquote>
				<p>
					<b>Position:</b> <?php echo scrub ( $_POST['position'] ); ?><br />
					<b>Start Date:</b> <?php echo scrub ( $_POST['startdate'] ); ?><br />
					<b>Hours/Week:</b> <?php echo scrub ( $_POST['hoursweek'] ); ?><br />
					<b>Work Hours:</b> <?php echo scrub ( $_POST['workhours'] ); ?><br />
					<b>Wage:</b> <?php echo scrub ( $_POST['wage'] ); ?><br />
					<b>Days:</b> <?php echo trim($workdays); ?><br />
					<b>Job Category:</b> <?php echo scrub ( $_POST['jobcategory'] ); ?><br />
					<b>Position Summary:</b><br /><?php echo scrub ( $_POST['summary'] ); ?><br />
					<b>Position Requirements:</b><br /><?php echo scrub ( $_POST['requirements'] ); ?>
				</p>
			</blockquote>
	<?php } else if($fieldErr) { ?>
			<div class="errorbox">
				<h2><span class="error">Form NOT Submitted!</span></h2>
				<p>
					The following field(s) appear to be blank or contain incorrect data:
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
			<form method="post" action="?/postings/offcampus/post/">
				<fieldset>
					<legend>Company Information</legend>
					<div>
						<label for="company">Company*:</label>
						<input type="text" name="company" id="company" size="25" maxlength="50" value="<?php echo populate('company'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="address1">Address/Location*:</label>
						<input type="text" name="location" id="location" size="25" maxlength="50" value="<?php echo populate('location'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="city">City:</label>
						<input type="text" name="city" id="city" size="25" maxlength="50" value="<?php echo populate('city'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="state">State:</label>
						<input type="text" name="state" id="state" size="25" maxlength="50" value="<?php echo populate('state'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="zip">Zip:</label>
						<input type="text" name="zip" id="zip" size="25" maxlength="50" value="<?php echo populate('zip'); ?>" />
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
						<label for="phone">Phone:</label>
						<input type="text" name="phone" id="phone" size="25" maxlength="50" value="<?php echo populate('phone'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="fax">Fax:</label>
						<input type="text" name="fax" id="fax" size="25" maxlength="50" value="<?php echo populate('fax'); ?>" />
					</div>
					<br class="remove" />
					<div>
						<label for="email">Email*:</label>
						<input type="text" name="email" id="email" size="25" maxlength="50" value="<?php echo populate('email'); ?>" />
					</div>
				</fieldset>
				<fieldset>
					<legend>Job Information</legend>
					<div>
						<label for="position">Position*:</label>
						<input type="text" name="position" id="position" size="25" maxlength="50" value="<?php echo populate('position'); ?>" />
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
						<label for="workhours">Work Hours:</label>
						<input type="text" name="workhours" id="workhours" size="25" maxlength="50" value="<?php echo populate('workhours'); ?>" />
					</div>
					<div>
						<label for="wage">Wage*:</label>
						<input type="text" name="wage" id="wage" size="25" maxlength="50" value="<?php echo populate('wage'); ?>" />
					</div>
					<div class="cr">
						<p>Days:</p>
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
					<div class="cr">
						<p>Job Category*:</p>
						<select name="jobcategory" id="jobcategory">
							<option>Clerical</option>
							<option>Community Service</option>
							<option>Computer/Technical</option>
							<option>Food Service</option>
							<option>Holiday</option>
							<option>Maintenance</option>
							<option>Miscellaneous</option>
							<option>Personal Services</option>
							<option>Sales</option>
							<option>Summer</option>
							<option>Telemarketing</option>
						</select>
					</div>
					<div>
						<label for="summary">Position Summary*:</label>
						<textarea name="summary" id="summary" cols="50" rows="7"><?php echo populate('summary'); ?></textarea>
					</div>
					<div>
						<label for="requirements">Position Requirements*:</label>
						<textarea name="requirements" id="requirements" cols="50" rows="7"><?php echo populate('requirements'); ?></textarea>
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
