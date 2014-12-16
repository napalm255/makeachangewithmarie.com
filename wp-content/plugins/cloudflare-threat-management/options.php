<?php
global $adminip;

if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' && isset($_GET['list']) ) {
	header("Location: options-general.php?page=cftm&settings-updated=true");
}

if(isset($_GET['remove']) && isset($_GET['list'])) {
	$removeip = $_GET['remove'];
	$list = 'cftm_'.$_GET['list'];
	$listcontents = get_option($list);
	if(!is_array($listcontents)) { $listcontents = str_getcsv($listcontents); }

	$newlistcontents = array_diff($listcontents, array($removeip));

	update_option($list, $newlistcontents);

	$message =  "Removed $removeip from ".$list."."	;
}

if(isset($_GET['clearlist']) && isset($_GET['list'])) {
	$list = 'cftm_'.$_GET['list'];
	delete_option($list);
	$message =  "Cleared list ".$list.".";
}

$filledout = FALSE;

if (strlen(get_option('cftm_email')) >= 5 && strlen(get_option('cftm_api')) > 30) {
	$filledout = TRUE;
}

?>
<style type="text/css">
	.hiddenfields {display:none;}
	.smallgray {font-size: 11px;color: #757575;}

	.wp-core-ui .button-red.hover, .wp-core-ui .button-red:hover, .wp-core-ui .button-red.focus, .wp-core-ui .button-red:focus {
		background-color: #B72727;
		background-image: -webkit-gradient(linear,left top,left bottom,from(#D22E2E),to(#9B2121));
		background-image: -webkit-linear-gradient(top,#D22E2E,#9B2121);
		background-image: -moz-linear-gradient(top,#D22E2E,#9B2121);
		background-image: -ms-linear-gradient(top,#D22E2E,#9B2121);
		background-image: -o-linear-gradient(top,#D22E2E,#9B2121);
		background-image: linear-gradient(to bottom,#D22E2E,#9B2121);
		border-color: #7F1B1B;
		-webkit-box-shadow: inset 0 1px 0 rgba(230, 120, 120, 0.6);
		box-shadow: inset 0 1px 0 rgba(230, 120, 120, 0.6);
		color: #fff;
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);
	}

	.wp-core-ui .button-red {
		background-color: #9B2121;
		background-image: -webkit-gradient(linear,left top,left bottom,from(#C52A2A),to(#9B2121));
		background-image: -webkit-linear-gradient(top,#C52A2A,#9B2121);
		background-image: -moz-linear-gradient(top,#C52A2A,#9B2121);
		background-image: -ms-linear-gradient(top,#C52A2A,#9B2121);
		background-image: -o-linear-gradient(top,#C52A2A,#9B2121);
		background-image: linear-gradient(to bottom,#C52A2A,#9B2121);
		border-color: #9B2121;
		border-bottom-color: #8D1E1E;
		-webkit-box-shadow: inset 0 1px 0 rgba(230, 120, 120, 0.5);
		box-shadow: inset 0 1px 0 rgba(230, 120, 120, 0.5);
		color: #fff;
		text-decoration: none;
		text-shadow: 0 1px 0 rgba(0,0,0,0.1);
	}
	.wp-core-ui .button-green.hover, .wp-core-ui .button-green:hover, .wp-core-ui .button-green.focus, .wp-core-ui .button-green:focus {
		background-color: #38B727;
		background-image: -webkit-gradient(linear,left top,left bottom,from(#42D22E),to(#269B21));
		background-image: -webkit-linear-gradient(top,#42D22E,#269B21);
		background-image: -moz-linear-gradient(top,#42D22E,#269B21);
		background-image: -ms-linear-gradient(top,#42D22E,#269B21);
		background-image: -o-linear-gradient(top,#42D22E,#269B21);
		background-image: linear-gradient(to bottom,#42D22E,#269B21);
		border-color: #1B7F1B;
		-webkit-box-shadow: inset 0 1px 0 rgba(124, 230, 120, 0.6);
		box-shadow: inset 0 1px 0 rgba(124, 230, 120, 0.6);
		color: #fff;
		text-shadow: 0 -1px 0 rgba(0,0,0,0.3);
	}

	.wp-core-ui .button-green {
		background-color: #219B21;
		background-image: -webkit-gradient(linear,left top,left bottom,from(#2AC52A),to(#219B26));
		background-image: -webkit-linear-gradient(top,#2AC52A,#219B26);
		background-image: -moz-linear-gradient(top,#2AC52A,#219B26);
		background-image: -ms-linear-gradient(top,#2AC52A,#219B26);
		background-image: -o-linear-gradient(top,#2AC52A,#219B26);
		background-image: linear-gradient(to bottom,#2AC52A,#219B26);
		border-color: #269B21;
		border-bottom-color: #228D1E;
		-webkit-box-shadow: inset 0 1px 0 rgba(120, 230, 129, 0.5);
		box-shadow: inset 0 1px 0 rgba(120, 230, 120, 0.5);
		color: #fff;
		text-decoration: none;
		text-shadow: 0 1px 0 rgba(0,0,0,0.1);
	}

	.wp-core-ui .button-green[disabled], .wp-core-ui .button-green:disabled, .wp-core-ui .button-green-disabled {
		color: #94E7AF!important;
		background: #29BA46!important;
		border-color: #1B7F23!important;
		-webkit-box-shadow: none!important;
		box-shadow: none!important;
		text-shadow: 0 -1px 0 rgba(0,0,0,0.1)!important;
		cursor: default;
	}

	.widefat .form-table td {
		margin-bottom: 9px;
		padding: 0;
		line-height: 20px;
		font-size: 12px;
		border: none;
	}

	input {			
		transition:width 1s;
		-webkit-transition:width 1s;
	}


</style>
<div class="wrap">
	<?php screen_icon('plugins'); ?>
	
	<form method="post" action="options.php" id="<?php echo $plugin_id; ?>_options_form" name="<?php echo $plugin_id; ?>_options_form">
	
	<?php settings_fields($plugin_id.'_options'); ?>
	
	<h2><?php echo $plugin_title; ?> &raquo; Settings</h2>
	<?
		if(isset($message)) {
			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>'.$message.'</strong></p></div>';
		}
		?>

		<table>
			<tr>
				<td style="vertical-align:top;min-width: 420px;max-width: 665px;">
					<table class="widefat">
						<thead>
							<tr>
								<th colspan="2"><input type="submit" id="submit1" name="submit" value="Save Settings" class="button-secondary" /></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="vertical-align:top;min-width: 160px;">
									<label for="cftm_email">
										Cloudflare Registered Email:
									</label>
								</td>
								<td style="vertical-align:top;text-align:right;">
									<input type="text" id="cftm_email" name="cftm_email" value="<?php echo get_option('cftm_email'); ?>" style="padding:5px;" />
								</td>
							</tr>

							<tr>
								<td style="vertical-align:top;">
									<label for="cftm_api">
										Cloudflare API Key:
									</label>
								</td>
								<td  style="vertical-align:top;text-align:right;">
									<input type="text" id="cftm_api" name="cftm_api" value="<?php echo get_option('cftm_api'); ?>" style="padding:5px;width:140px;" />
								</td>
							</tr>

							<tr>
								<td style="vertical-align:top;">
									<label for="cftm_clearlist">
										IP Blacklist:
										<br/><span class="smallgray">Ban the following IP addresses from accesing your websites.</span>
									</label>
								</td>
								<td  style="vertical-align:top;text-align:right;">
									<textarea name="cftm_blacklist" cols="47" rows="5" style="padding:5px;" ><?php echo get_option('cftm_blacklist'); ?></textarea><br/>
									<span class='smallgray' style='text-align:right;display:block'>
										One IP per line, comments allowed.<br>
										See samples to the right.<br>
									</span>								</td>
							</tr>

							<tr>
								<td style="vertical-align:top;">
									<label for="cftm_clearlist">
										IP Clearlist:
										<br/><span class="smallgray">Removes the IP addresses from any whitelist/blacklist they may be on.</span>
									</label>
								</td>
								<td  style="vertical-align:top;text-align:right;">
									<textarea name="cftm_clearlist" cols="47" rows="5" style="padding:5px;" ><?php echo get_option('cftm_clearlist'); ?></textarea><br/>
									<span class='smallgray' style='text-align:right;display:block'>
										One IP per line, comments allowed.<br>
										See samples to the right.<br>
									</span>
								</td>
							</tr>
						
							<tr>
								<td style="vertical-align:top;">
									<label for="cftm_whitelist">
										IP Whitelist:
										<br/><span class="smallgray">Allow these IP addresses to access your websites.
										<br/>Your current IP is always whitelisted.</span>
									</label>
								</td>
								<td  style="vertical-align:top;text-align:right;">
									<textarea name="cftm_whitelist" cols="47" rows="5" style="padding:5px;" ><?php echo get_option('cftm_whitelist'); ?></textarea><br/>
									<span class='smallgray' style='text-align:right;display:block'>
										One IP per line, comments allowed.<br>
										See samples to the right.<br>
									</span>
								</td>
							</tr>

						 <? if(_wordfence()) { 
							$run = "0";

							$prevbanned = get_option('cftm_wordfenceban_log');
							if(!is_array($prevbanned) && strlen($prevbanned) !== 0) { // It's a string and not empty
								$prevbanned = str_getcsv($prevbanned); // csv to array
								$prevbannedsave = implode(',',$prevbanned); // array to csv
								$run = "1";
							}

							elseif(!is_array($prevbanned) && strlen($prevbanned) == 0) { // It's a string and empty	
								delete_option($list);						
								$prevbanned = ''; // csv to array
								$prevbannedsave = ''; // array to csv
								$run = "2";
							}

							elseif(is_array($prevbanned) && !empty($prevbanned) ) { // It's an array and not empty							
								$prevbannedsave = implode(',',$prevbanned); // array to csv
								$run = "3"; // all good, removed an IP, settings not yet saved
							}

							elseif(is_array($prevbanned) && empty($prevbanned) ) { // It's an array and empty							
								$prevbannedsave = implode(',',$prevbanned); // array to csv
								$run = "4";
							}
							
						 ?>
						 	<tr>
								<td style="vertical-align:top;">
									<label for="cftm_wordfenceban_locked_out">
										WordFence Detected <br/><span style="color:orange">BETA FEATURE</span><br/>(<a href='http://thepluginfactory.co/community/forum/plugin-specific/cloudflare-threat-management/' target='_blank' title='CloudFlare Threat Management Plugin Support Forums'>report a bug</a>)
									</label>
								</td>
								<td  style="vertical-align:top;text-align:left;">
									<input name="cftm_wordfenceban_locked_out" type="checkbox" style="padding:5px;" value="1" <? if(get_option('cftm_wordfenceban_locked_out') == "1") {echo "checked";} ?> />  Ban all <b>currently</b> locked out IP addresses<br/>
									<input name="cftm_wordfenceban_full_list" type="checkbox" style="padding:5px;" value="1" <? if(get_option('cftm_wordfenceban_full_list') == "1") {echo "checked";} ?> />  Ban all <b>previously</b> locked out IP addresses
									<input name="cftm_wordfenceban_log"  value="<? echo $prevbannedsave; ?>" id="cftm_wordfenceban_log" name="cftm_wordfenceban_log"  type="text" style="display:none" />
									<? 
										if(is_array($prevbanned) && !empty($prevbanned) && !isset($_GET['runnow'])) {
											echo '<a class="smallgray togglesource" href="#"" style="width: 265px;display: block;text-align:left;font-weight:bold">Show Previously Banned</a>
											<table class="togglehide hidden form-table" style="width: 265px;margin-bottom: 10px;">';
											echo "<tr><td><b>Clear entire list.<br/>(Does not unban<br/>previously banned IP's)</b></td><td width='100px'>(<a href='options-general.php?page=cftm&clearlist&list=wordfenceban_log'>Clear List Now</a>)</td></tr>";
											foreach ($prevbanned as $value) {
												echo "<tr><td>$value</td><td>(<a href='options-general.php?page=cftm&remove=".$value."&list=wordfenceban_log'>Remove</a>)</td></tr>";
											}
											echo '</table>';
										} elseif(isset($_GET['runnow'])) {
											echo "<span class='smallgray' style='width: 265px; display:block;'>Clear results to see list of banned IP addresses.";
											echo "</span>";
										} else {
											echo "<span class='togglehide hidden smallgray' style='width: 265px; display:block;'>No previous IP addresses banned from WordFence.";
											echo "</span>";
										}
									?>
								</td>
							</tr>
						 <? } // wordfence ?>

						</tbody>
						<tfoot>
							<tr>
								<th colspan="2"><input type="submit" id="submit2" name="submit" value="Save Settings" class="button-secondary" />
								<?php if($filledout && isset($_GET['runnow'])) { ?>
									<a style="float:right;"  id="runnow" class="button-primary button-red" href="options-general.php?page=cftm">CLEAR RESULTS</a>
								<? } elseif($filledout && !isset($_GET['runnow'])) { ?>
									<a style="float:right;" id="runnow" class="button-primary button-primary" href="options-general.php?page=cftm&runnow">RUN CLOUDFLARE THREAT MANAGEMENT NOW</a>
								<? } ?>
								</th>
							</tr>
						</tfoot>
					</table>
					<?
					if(isset($_GET['runnow'])) {
						_cftm();
					} 
					?>
				</td>
				<?php include('sidebar.php'); ?>
			</tr>
		</table>
	</form>	
</div>
<script type="text/javascript">
	jQuery(function ($) {
		$('.skippedhidesource').click(
			function() {
			hidden = $('.skippedhide');
			hidden.toggle();
		    
		    if ($(this).html() == 'SHOW SKIPPED') {
		        $(this).html('HIDE SKIPPED');
		    } else {
		        $(this).html('SHOW SKIPPED');
		    }

		    return false;
		});

		$("#cftm_api").focus(
			function() {
				$(this).css( "width", "265px" );
		});

		$("#cftm_api").blur(
			function() {
				$(this).css( "width", "140px" );
		});


		$("#cftm_email").focus(
			function() {
				$(this).css( "width", "265px" );
		});

		$("#cftm_email").blur(
			function() {
				$(this).css( "width", "140px" );
		});


		$('.button-green').click(
			function() {

		    if ($(this).html() == 'RUN CLOUDFLARE THREAT MANAGEMENT NOW') {
		        $(this).html('RUNNING... PLEASE BE PATIENT');
				$(this).attr('disabled', 'disabled');
		    }

		    return true;
		});

		$('.togglesource').click(
			function() {
				$(this).siblings(".togglehide").toggle();

				if ($(this).html() == 'Show Previously Banned') {
				    $(this).html('Hide Previously Banned');
				} else if($(this).html() == 'Hide Previously Banned') {
				    $(this).html('Show Previously Banned');
				} else if($(this).html() == 'Show Permanently Whitelisted') {
				    $(this).html('Hide Permanently Whitelisted');
				} else if($(this).html() == 'Hide Permanently Whitelisted') {
				    $(this).html('Show Permanently Whitelisted');
				} else if($(this).html() == 'Show Permanently Blacklisted') {
				    $(this).html('Hide Permanently Blacklisted');
				} else if($(this).html() == 'Hide Permanently Blacklisted') {
				    $(this).html('Show Permanently Blacklisted');
				} else if($(this).html() == 'Show Permanently Clearlisted') {
				    $(this).html('Hide Permanently Clearlisted');
				} else if($(this).html() == 'Hide Permanently Clearlisted') {
				    $(this).html('Show Permanently Clearlisted');
				}

		    	return false;
		});
		

	// MONITORS FORM FOR CHANGES

		function togglebuttons() {

			if ($("#runnow").html() == 'RUN CLOUDFLARE THREAT MANAGEMENT NOW') {
				$("#runnow").removeClass( "button-primary" );
				$("#runnow").addClass( "button-secondary" );
			    $("#runnow").html('PLEASE SAVE SETTINGS BEFORE RUNNING');
			}
			

			$("#submit1").addClass( "button-primary" );
			$("#submit2").addClass( "button-primary" );
			$("#runnow").removeClass( "button-primary" );
			$("#runnow").addClass( "button-secondary" );
			$("#runnow").attr('disabled', 'disabled');
			$('#runnow').bind("click", function(){
			    return false;
			});




		}
		$('#<?php echo $plugin_id; ?>_options_form :input').on({
		    keyup: function() { togglebuttons() },
		    change: function(){ togglebuttons() },
		    blur: function()  { togglebuttons() },
		    focus: function() {togglebuttons();}
 		});

		$(document).keydown(function(event) {
			//19 for Mac Command+S
			if (!( String.fromCharCode(event.which).toLowerCase() == 's' && event.ctrlKey) && !(event.which == 19)) return true;
			$("#submit2").click();
			event.preventDefault();
			return false;
		});


	<?
		if(isset($_GET['runnow'])) {
			echo '
		$("input[type=text]").attr("disabled", "disabled");
		$("input[type=text]").css( "opacity", ".5" );

		$("input[type=checkbox]").attr("disabled", "disabled");
		$("input[type=checkbox]").css( "opacity", ".5" );

		$("input[name=submit]").attr("disabled", "disabled");
		$("input[name=submit]").css( "opacity", ".5" );


		$("textarea").attr("disabled", "disabled");
		$("textarea").css( "opacity", ".5" );';
		}

	?>



	});
</script>