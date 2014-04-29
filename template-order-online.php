<?php
/*
Template Name: Order Online Page
*/

//error_reporting(E_ALL);
//ini_set('display_errors', isset($_GET['debug']) && $_GET['debug'] == 'testmode');

global $form;
$organization = 'Synergy Telecom';
$website = 'SynergyTele.com/support/request-a-quote';
$subject = 'VoIP System Quote Request';
$toLiveEmail = 'charlie@synergytele.com';
$toTestEmail = 'daniel@bexarcreative.com';
$to = isset($_GET['debug']) && $_GET['debug'] == 'testmode' ? $toTestEmail : $toLiveEmail;
$requireds = array(
	'Business_Name', 'Email_Address', 'Customer_Name', 'Phone_Number',
	'Address', 'City', 'State', 'Zip_Code',
);
$honey_pot_field = 'Name';
$non_product_fields = array(
	'Business_Name', 'Email_Address', 'Customer_Name', 'Phone_Number',
	'Address', 'City', 'State', 'Zip_Code',
	'Support_Feature', 'Software_Addon', $honey_pot_field,
);
$valid_extensions = array('jpg','jpeg','doc','docx','pdf','gif','png');
$missing = false;
$missings = array();
$spam = false;

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

	// Check for uploads
	$attachments = array();
	if(!empty($_FILES))
	{
		foreach($_FILES as $file)
		{
			$name = explode('.', strtolower($file['name']));
			$extension = end($name);
			if(in_array($extension, $valid_extensions))
			{
				$tmp_path = WP_CONTENT_DIR.'/uploads/'.md5(uniqid()).'.'.$extension;
				if(move_uploaded_file($file['tmp_name'], $tmp_path))
				{
					$attachments[] = $tmp_path;
				}
			}
		}
	}

	// Check honey pot for spammers
	if(isset($form[$honey_pot_field]) && !empty($form[$honey_pot_field]))
	{
		$spam = true;
	}

	if(!$missing && !$spam)
	{
		// Send quote email
		$msg = '<html>';
		$msg .= '<head>';
		$msg .= '<title>'.$subject.'</title>';
		$msg .= '<style type="text/css">th{ background: #eee; font-weight: bold;text-align:left;} th,td{ padding: 5px;}</style>';
		$msg .= '</head>';
		$msg .= '<body>';
		$msg .= '<p>A new quote has been requested on '.$website.'. Below are the details of this request:</p>';
		$msg .= '<table width="100%">';

		$msg .= '<tr>';
		$msg .= '<th>Business Name</th>';
		$msg .= '<td>'.$form['Business_Name'].'</td>';
		$msg .= '<th>Email Address</th>';
		$msg .= '<td>'.$form['Email_Address'].'</td>';
		$msg .= '</tr>';

		$msg .= '<tr>';
		$msg .= '<th>Customer Name</th>';
		$msg .= '<td>'.$form['Customer_Name'].'</td>';
		$msg .= '<th>Phone Number</th>';
		$msg .= '<td>'.$form['Phone_Number'].'</td>';
		$msg .= '</tr>';

		$msg .= '<tr>';
		$msg .= '<th style="vertical-align:top;">Address</th>';
		$msg .= '<td colspan="3">'.$form['Address'].'<br>'.$form['City'].', '.$form['State'].' '.$form['Zip_Code'].'</td>';
		$msg .= '</tr>';

		$msg .= '<tr>';
		$msg .= '<th width="25%" style="vertical-align:top;">Support Features</th>';
		$msg .= '<td width="25%"><ul><li>'.implode('</li><li>',$form['Support_Feature']).'</li></ul></td>';
		$msg .= '<th width="25%" style="vertical-align:top;">Software Addons</th>';
		$msg .= '<td width="25%"><ul><li>'.implode('</li><li>',$form['Software_Addon']).'</li></ul></td>';
		$msg .= '</tr>';

		$msg .= '<tr>';
		$i = 0;
		foreach($form as $k => $v)
		{
			if(!in_array($k, $non_product_fields)):
				$i++;
				
				$msg .= '<th width="25%">'.str_replace('_',' ', $k).'</th>';
				$msg .= '<td width="25%">'.$v.'</td>';
				
				if($i % 2 == 0):
					$msg .= '</tr><tr>';
				endif;
			endif;
		}
		$msg .= '</tr>';

		$msg .= '</table>';
		$msg .= '<br><br>';
		$msg .= '</body>';
		$msg .= '</html>';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'To: "'.$organization.'" <'.$to.'>' . "\r\n";
		$headers .= 'From: "'.$form['Customer_Name'].'" <'.$form['Email_Address'].'>' . "\r\n";

		function set_mail_content_type() {
			return 'text/html';
		}

		add_filter( 'wp_mail_content_type', 'set_mail_content_type' );
		wp_mail($to, $subject, $msg, $headers, $attachments);
		remove_filter( 'wp_mail_content_type', 'set_mail_content_type' );

		if(!empty($attachments))
		{
			foreach($attachments as $file)
			{
				@unlink($file);
			}
		}
		
		header('Location: /support/thank-you');
		exit();
	}
}

// ===============================
// Start of Form
// ===============================

while (have_posts()) : the_post();
	the_content();
	wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
endwhile;
?>

<form action="<?php echo the_permalink() ?>" method="POST" enctype="multipart/form-data">
	<div style="display:none;">
		<input type="text" name="<?=$honey_pot_field?>">
	</div>

	<?php if($missing): ?>
	<div class="alert alert-danger">
		Looks like you forgot to fill out some of the required fields. Please make sure we have your
		<?php echo implode(', ', $missings); ?>.
	</div>
	<?php endif; ?>

	<div class="group">
		<div class="group-heading">
			<h2 class="group-title">Choose Your VoIP Phone(s)</h2>
		</div>
		<div class="group-body">
			<div class="row">
				<?php showProducts(array(
					'orderby' => 'post_date',
					'post_type' => 'product',
					'tax_query' => array(
						array(
							'taxonomy' => 'product-type',
							'terms' => array(8)
						)
					)
				)); ?>
			</div>
		</div>
	</div>
	<div class="group">
		<div class="group-heading">
			<h2 class="group-title">Choose your Conference Phone(s)</h2>
		</div>
		<div class="group-body">
			<div class="row">
				<?php showProducts(array(
					'orderby' => 'post_date',
					'post_type' => 'product',
					'tax_query' => array(
						array(
							'taxonomy' => 'product-type',
							'terms' => array(76)
						)
					)
				)); ?>
			</div>
		</div>
	</div>	
	<div class="group">
		<div class="group-heading">
			<h2 class="group-title">Choose your Video Conferencing Hardware</h2>
		</div>
		<div class="group-body">
			<div class="row">
				<?php showProducts(array(
					'orderby' => 'post_date',
					'post_type' => 'product',
					'tax_query' => array(
						array(
							'taxonomy' => 'product-type',
							'terms' => array(75)
						)
					)
				)); ?>
			</div>
		</div>
	</div>
	<div class="group">
		<div class="group-heading">
			<h2 class="group-title">Choose your Accessories</h2>
		</div>
		<div class="group-body">
			<div class="row">
				<?php showProducts(array(
					'orderby' => 'post_date',
					'post_type' => 'product',
					'tax_query' => array(
						array(
							'taxonomy' => 'product-type',
							'terms' => array(70, 71)
						)
					)
				)); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="group col-xs-12 col-sm-12 col-md-6">
			<div class="group-heading">
				<h2 class="group-title">Choose Your Support Features</h2>
			</div>
			<div class="group-body">
				<p style="margin-bottom:20px;">Check off any of the suport features that you might need to operate your VoIP system:</p>
				<?php
				$features = array(
					'I want access to training videos',
					'I want on-site training for my company',
					'I want 24/7 trouble-ticket support',
					'I want phone-level technical support',
					'I want on-site technical support',
					'I want the latest software upgrades',
					'I need better broadband service',
					'I want to be notified of service and product updates',
					'I want professional voice recordings',
				);
				foreach($features as $feature): ?>
				<div class="form-group">
					<div class="checkbox">
					  <label>
					    <input name="Support Feature[]" type="checkbox" value="<?=$feature?>" <?php if(isset($form['Support_Feature']) && in_array($feature, $form['Support_Feature'])){ echo 'checked="checked"'; } ?>>
					    <?=$feature?>
					  </label>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
			<br>
			<div class="group-heading">
				<h2 class="group-title">Choose Your Software Addons</h2>
			</div>
			<div class="group-body">
				<p style="margin-bottom:20px;">Check off any of the software addons that you might be interested in having available to your VoIP system:</p>
				<?php
				$addons = array(
					'I want to make VoIP calls from my computer',
					'I want to setup a call-center',
					'I want to have an auto-attendant',
					'I want to do video conferencing',
					'I want to have an E-Fax',
				);
				foreach($addons as $addon): ?>
				<div class="form-group">
					<div class="checkbox">
					  <label>
					    <input name="Software Addon[]" type="checkbox" value="<?=$addon?>"<?php if(isset($form['Software_Addon']) && in_array($addon, $form['Software_Addon'])){ echo 'checked="checked"'; } ?>>
					    <?=$addon?>
					  </label>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="group col-xs-12 col-sm-12 col-md-6">
			<div class="group-heading">
				<h2 class="group-title">Tell Us About Your Company</h2>
			</div>
			<div class="group-body">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">Company Name</label>
					    <input name="Business Name" type="text" class="form-control" value="<?=isset($form['Business_Name']) ? $form['Business_Name'] : null?>">
					</div>
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">Your Name</label>
					    <input name="Customer Name" type="text" class="form-control" value="<?=isset($form['Customer_Name']) ? $form['Customer_Name'] : null?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">Phone Number</label>
					    <input name="Phone Number" type="text" class="form-control" value="<?=isset($form['Phone_Number']) ? $form['Phone_Number'] : null?>">
					</div>
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">Email Address</label>
					    <input name="Email Address" type="text" class="form-control" value="<?=isset($form['Email_Address']) ? $form['Email_Address'] : null?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">Address</label>
					    <input name="Address" type="text" class="form-control" value="<?=isset($form['Address']) ? $form['Address'] : null?>">
					</div>
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">City</label>
					    <input name="City" type="text" class="form-control" value="<?=isset($form['City']) ? $form['City'] : null?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">State</label>
					    <select name="State" class="form-control"><option value=""></option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="District of Columbia">District of Columbia</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas" selected="selected">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option><option value="Virginia">Virginia</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option><option value="Armed Forces Americas">Armed Forces Americas</option><option value="Armed Forces Europe">Armed Forces Europe</option><option value="Armed Forces Pacific">Armed Forces Pacific</option></select>
					</div>
					<div class="form-group col-xs-12 col-sm-6">
					    <label class="control-label">Zip Code</label>
					    <input name="Zip Code" type="text" class="form-control" value="<?=isset($form['Zip_Code']) ? $form['Zip_Code'] : null?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12">
					    <div class="well">
						    <label class="control-label">Upload a copy of your current phone bill</label>
						    <input name="Phone Bill" type="file">
						</div>
					</div>
				</div>
				<p class="text-center">
					<input type="submit" class="btn btn-lg btn-danger" value="Request Quote">
				</p>
			</div>
		</div>
	</div>
</form>


<?php

/**
 * Query products and show an incrementer and photo for each
 *
 * @param array $args for WP_Query
 * @return null
 *
 */
function showProducts($args)
{
	global $form;
	$products = new WP_Query($args);
	if ( $products->have_posts() ):
		while ( $products->have_posts() ):
				$products->the_post();?>
			<div class="product col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="panel">
					<div class="panel-body">
					  <a href="<?=get_permalink()?>" target="_blank">
					    <?=get_the_post_thumbnail(get_the_ID(), 'panel-image'); ?>
					    <div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon'); ?>"></i></div>
					  </a>
					</div>
				</div>
				<h3><a href="<?=get_permalink()?>" target="_blank"><?php the_title(); ?></a></h3>
				<div class="input-group">
					<span class="input-group-btn">
				    	<button class="counter-minus btn btn-default" type="button" style="font-size:23px;"><i class="fa fa-fw fa-minus-circle"></i></button>
				    </span>
					<input type="text" class="counter form-control input-lg" style="text-align:center;" name="<?php the_title(); ?>" value="<?=isset($form[str_replace(' ', '_', get_the_title())]) ? $form[str_replace(' ', '_', get_the_title())] : 0?>">
					<span class="input-group-btn">
				    	<button class="counter-plus btn btn-default" type="button" style="font-size:23px;"><i class="fa fa-fw fa-plus-circle"></i></button>
				    </span>
				</div>
			</div>
		<?php
		endwhile;
	endif;
	wp_reset_postdata();
}

?>