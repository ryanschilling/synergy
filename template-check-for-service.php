<?php
/*
Template Name: Check for Service Page
*/

while (have_posts()) : the_post();
	the_content();
	wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
endwhile;

//error_reporting(E_ALL);
//ini_set('display_errors', isset($_GET['debug']) && $_GET['debug'] == 'testmode');

global $form;
$requireds = array('Phone_Number');
$honey_pot_field = 'Name';
$missing = false;
$missings = array();
$spam = false;
$error = false;

// ===============================
// Start of Form Processing
// ===============================
if(!empty($_POST))
{
	// Check all required fields
	$form = sanitize($_POST);
	foreach($requireds as $field)
	{
		if(empty($form[$field]))
		{
			$missing = true;
			$missings[] = str_replace('_', ' ', $field);
		}
	}

	// Make sure the length of the phone number is right
	$phone = preg_replace('/[^0-9]/', '', $form['Phone_Number']);
	if(strlen($phone) < 6)
	{
		$error = true;
	}

	// Check honey pot for spammers
	if(isset($form[$honey_pot_field]) && !empty($form[$honey_pot_field]))
	{
		$spam = true;
	}

	if(!$error && !$missing && !$spam)
	{
		$error = true;
		$npa = substr($phone, 0, 3);
		$nxx = str_pad(substr($phone, 3, 3), 3, '0');
		$number = str_pad(substr($phone, 6, 4), 4, '0');
		$sql = 'SELECT * FROM `coverage_numbers` WHERE `npa`="'.mysql_real_escape_string($npa).'" AND `nxx`="'.mysql_real_escape_string($nxx).'"';
		$areas = $wpdb->get_results( $sql , ARRAY_A );
		if(!empty($areas))
		{
			foreach($areas as $area)
			{
				$sql = 'SELECT * FROM `coverage` WHERE `state`="'.$area['state'].'" AND `city`="'.$area['city'].'"';
				$coverages = $wpdb->get_results( $sql , ARRAY_A );
				foreach($coverages as $coverage)
				{
					if($coverage['a'] == 1 || $coverage['b'] == 1 || $coverage['c'] == 1 || $coverage['d'] == 1)
					{
						$error = false;
						break;
					}
				}

				if(!$error)
				{
					break;
				}
			}
		}
		?>
		<br>
		<div class="row">
			<div class="form-group col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 has-<?=$error ? 'error' : 'success'?>">
				<div class="well">
					<?php if($error): ?>
					<div class="alert alert-danger">
						Sorry! Looks like we do not provide service for VoIP in your area of <?=$coverage['state']?>. Please call <a href="tel:+12104388647">(210) GET-VOIP</a> to see if we provide service in a nearby area.
					</div>
					<?php else: ?>
					<div class="alert alert-success">
						Congratulations! Looks like we can service your area of <?=$coverage['state']?>. Please call <a href="tel:+12104388647">(210) GET-VOIP</a> or <a href="<?=get_permalink(119)?>">order online</a> to get started with VoIP.
					</div>
					<?php endif; ?>

				    <label class="control-label">Phone Number</label>
				    <input name="Phone Number" type="text" class="disabled input-lg form-control" value="<?=$npa.'-'.$nxx.'-'.$number?>" disabled>
				    <br>
				    <?php if($error): ?>
				    	<a href="<?=get_permalink(111)?>" class="btn btn-lg btn-danger btn-block"><i class='fa fa-fw fa-chevron-left'></i> Try Another Number</a>
				    <?php else: ?>
						<a href="<?=get_permalink(119)?>" class="btn btn-lg btn-primary btn-block">Order Online <i class='fa fa-fw fa-chevron-right'></i></a>
				    <?php endif; ?>
				</div>
			</div>
		</div>

	<?php
		$error = false;
	}
}

// ===============================
// Start of Form
// ===============================


if($error || $missing || $spam || empty($_POST))
{
	?>
	<br>
	<form action="<?php echo the_permalink() ?>" method="POST">
		<div style="display:none;">
			<input type="text" name="<?=$honey_pot_field?>">
		</div>

		<div class="row">
			<div class="form-group col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="well">
					<?php if($error): ?>
					<div class="alert alert-danger">
						Looks like you did not provide a valid 9-digit phone number with area code.
					</div>
					<?php endif; ?>
					<?php if($missing): ?>
					<div class="alert alert-danger">
						Looks like you forgot to fill out some of the required fields. Please make sure we have your
						<?php echo implode(', ', $missings); ?>.
					</div>
					<?php endif; ?>

				    <label class="control-label">Phone Number</label>
				    <input name="Phone Number" type="text" class="input-lg form-control" value="">
				    <br>
				    <input type="submit" class="btn btn-lg btn-block btn-primary" value="Check for Service">
				</div>
			</div>
		</div>
	</form>
<?php
}
?>