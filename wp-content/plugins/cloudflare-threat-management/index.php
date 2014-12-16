<?php
/*
    Plugin Name: CloudFlare Threat Management
	Plugin URI: http://thepluginfactory.co/warehouse/cloudflare-threat-management/
	Description: Manages the banning and whitelisting of IP address on CloudFlare for your website.
	Version: 0.6
	Author: The Plugin Factory
	Author URI: http://thepluginfactory.co/
*/

if(is_admin()) {
	# Setting up variables for future use
		$plugin_id = 'cftm-plugin-options';
		$plugin_title = 'CloudFlare Threat Management';
		$settings = array(
							'cftm_email',		// cloudflare email
							'cftm_api',		// cloudflare api

							'cftm_wordfenceban_locked_out',	// sets whether or not to ban from WordFence locked out users
							'cftm_wordfenceban_full_list',		// sets whether or not to ban from WordFence locked out users
							'cftm_wordfenceban_current',		// WordFence IP addresses that need to be banned
							'cftm_wordfenceban_log',			// WordFence IP addresses that have been banned 

							'cftm_blacklist',		// custom user blacklist
							'cftm_blacklist_log',	// custom user blacklist log

							'cftm_clearlist',		// custom user clearlist log
							'cftm_clearlist_log',	// custom user clearlist

							'cftm_whitelist',		// custom user whitelist
							'cftm_whitelist_log',	// custom user whitelist log

							'cftm_uninstall'	// delete all options on uninstallation
					);

		$adminip = $_SERVER['REMOTE_ADDR'];
		if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
			$adminip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
		}

		# FUNCTIONS
			# MISC FUNCTIONS

				function _echo($content, $name = '', $pre = FALSE) {
					if (is_array($content)) {
						echo "<pre><b>$name</b> ";
							print_r($content);
						echo "</pre>";
					} elseif ($pre == TRUE) {
						echo "<pre>";
						echo $content;
						echo "</pre>";
					} else  {
						echo "<table>";
						echo "<tr><td>$name</td><td>$content</td></tr>";
						echo "</table>";
					}
				}

				function _list( $list, $log = FALSE ){
					if($log) {
						return $list_log = get_option('cftm_'.$list.'list_log');
					} else {
						return get_option('cftm_'.$list.'list');
					}
				}

			# CHECK IF WORDFENCE INSTALLED AND ACTIVATED
				function _wordfence() {
					$wordfence = FALSE;
					if (file_exists(dirname(dirname(__FILE__)).'/wordfence/wordfence.php')) {
						if(!function_exists(is_plugin_active)) { include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }
						if( is_plugin_active('wordfence/wordfence.php')) { 
							$wordfence = TRUE;
						}
					}
					return $wordfence; // returns true if wordfence is installed and activated
				}

			# REGISTER OPTIONS
				function register() {
					global $settings;
					global $plugin_id;
					global $plugin_title;
					foreach ($settings as $value) {
						register_setting($plugin_id.'_options', $value);
					}
				}
				add_action('admin_init','register');

			# DELETE OPTIONS ON DEACTIVATION IF REQUESTED
				function cftm_on_deactivate() {
					# source http://dannyvankooten.com/199/remove-your-wp-plugins-stored-data/
				    if ( 1 == get_option('cftm_uninstall') ) {
						global $settings;
						foreach ($settings as $value) {
							delete_option($value);
						}
					}
				}
				register_deactivation_hook(__FILE__, 'cftm_on_deactivate');

			# FUNCTION TO CONNECT TO CLOUDFLARE AND RUN COMMAND
				function _cloudflare($ip, $action = 'ban') {
					$valid = filter_var($ip, FILTER_VALIDATE_IP);
					if($valid){
						$api_key = get_option('cftm_api'); // cloudflare API
						$email = get_option('cftm_email'); // cloudflare email address
						$cloudflare = 'https://www.cloudflare.com/api_json.html?a='.$action.'&tkn='.$api_key.'&email='.$email.'&key='.$ip;
						$ch = curl_init($cloudflare);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$server_output = curl_exec($ch);
						$result = json_decode($server_output, true);
						$status = $result["result"];
						$ip = $result["response"]["result"]["ip"];
					} else {
						$status = 'Invalid IP Address';
					}
					return array($status,$ip);
				}

			# SET UP THE OPTIONS PAGE
				function cftm_options_page() { 
					if (!current_user_can('manage_options')) {
						wp_die( __('You do not have sufficient permissions to access this page!') );
					}

					global $settings;
					global $plugin_id;
					global $plugin_title;

					include(dirname(__FILE__) . '/options.php');
				}

				function cftm_menu() {

					global $settings;
					global $plugin_id;
					global $plugin_title;

					$page_title = $plugin_title;
					$menu_title = $plugin_title;
					$capability = 'manage_options';
					$menu_slug = 'cftm';
					$function = 'cftm_options_page' ; 
					add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
				}
				add_action( 'admin_menu', 'cftm_menu' );

			# RUNS THE SPECIFIED LIST THROUGH CLOUDFLARE
				function _runlist($list_name){
					global $adminip; # set adminip for whitelisting.
					
					$list = get_option('cftm_'.$list_name);
					if(!empty($list)) {

						$list = explode("\n",$list);

						foreach($list as $list) {
							$line = explode(' ',$list);
							$ip = trim($line['0']);
							$comment = trim($line['1']);
							$valid = filter_var($ip, FILTER_VALIDATE_IP);
							if($valid) {
								$process_list[] = $ip;
								# echo "IP = $ip and NOTE = $comment <br/>";
							} else {
								global $invalid;
								$invalid[] = $ip;
							}
						}

					}

					if(!is_array($process_list)) { $process_list = array();}


					if($list_name == 'blacklist') {$action = 'ban';}

					if($list_name == 'clearlist') {$action = 'nul';}

					if($list_name == 'whitelist') {$action = 'wl';
						if(!in_array($adminip, $process_list)) {
							$process_list[] = $adminip;	
						}					
					}

					if (count($process_list) >= 1400) {
						
						echo '<table class="widefat" style="width:500px;margin-top: 0;">
							<thead>
							   <tr>
								 <th colspan="2">'.ucfirst($list_name).'ed IP Addresses</th>
							   </tr>
							</thead>
							<tbody>';

						echo "<tr><td colspan=2>Your list is too long. Cloudflare only accepts 1400 addresses on their lists. Please trim down your list and resubmit it.</td></tr>";
				
						echo "</tbody></table>";


					} else if(!empty($process_list) && strlen($process_list["0"]) !== 0) {
						foreach ($process_list as $ip) {
							$result = _cloudflare($ip, $action); // returns array(status,ip)
							$status = $result['0'];
							$ip = $result['1'];							
							$listed[$status][] = $ip;
						}

						echo '<table class="widefat" style="width:500px;margin-top: 0;">
							<thead>
							   <tr>
								 <th colspan="2">'.ucfirst($list_name).'ed IP Addresses</th>
							   </tr>
							</thead>
							<tbody>';
						
						foreach ($listed as $status => $ip) {
							if($status == 'success') {
								foreach ($ip as $ip) {
									echo "<tr><td style='width: 150px;'>".$ip."</td><td>Response from CloudFlare: ".$status."</td></tr>";
								}
							} else {
								foreach ($ip as $ip) {
									echo "<tr><td style='width: 150px;'>".$ip."</td><td>Response from CloudFlare: FAILED - ".$status."</td></tr>";
								}

							}
						}
						echo "</tbody></table>";
					}

				}

			# RUN CLOUDFLARE THREAT MANAGEMENT - ACTUAL FUNCTION TO RETRIEVE LOCKED IP'S AND BLOCK THEM WITH CLOUDFLARE
				function _cftm() {
					global $wpdb;
					global $adminip;

					# GET IP ADDRESSES OF CURRENTLY LOCKED OUT USERS FROM WORDFENCE

						if( _wordfence() && get_option('cftm_wordfenceban_locked_out') == "1" ){
							# gets the full list of locked out addresses from WordFence
							$iplist = $wpdb->get_results( 'SELECT IP FROM '.$wpdb->prefix.'wfLockedOut' );
							if(!empty($iplist)) {
								# if the list isn't empty, then add the addresses to an array $wordfence_ips_to_ban
								foreach ($iplist as $value) {
									$wordfence_ips_to_ban[] = long2ip($value->IP);									
								}
							} else {
								# if the list is empty, make an empty array
								$wordfence_ips_to_ban = array();
							}

							# load the previously banned addresses
							$ban_log = get_option( 'cftm_wordfenceban_log' );
							if(empty($ban_log)) { $ban_log = array(); }
							elseif(!empty($ban_log) && !is_array($ban_log)) { $ban_log = str_getcsv($ban_log); }
							$ban_log = array_unique($ban_log);


							$i = 0;
							foreach ($wordfence_ips_to_ban as $ip) {
								if(	$ip !== $adminip && is_array($ban_log) && !in_array($ip, $ban_log)) {
									$result[] = _cloudflare($ip);
									$status = $result[$i]['0'];
									$ip = $result[$i]['1'];
									$results[$status][] = $ip;
								} elseif(is_array($ban_log) && in_array( $ip , $ban_log)) {
									$wordfence_skipped[] = $ip;
								}
								$i++;
							}

							if(empty($results)) { $results = array(); }

							echo '	<table class="widefat" style="width:500px;margin-top: 15px;">
										<thead>
											<tr>
											<th colspan="2">WordFence <b>current</b> locked out IP addresses</th>
											</tr>
										</thead>
										<tbody>';

							if (empty($results)) {
								echo "<tr><td colspan='2'>No new IP addreses to ban from WordFence.</td></tr>";
							} else {
								foreach ($results as $status => $ip) {
									if($status == 'success') {
										foreach ($ip as $ip) {
											echo "<tr><td style='width: 150px;'>".$ip."</td><td>Response from CloudFlare: ".$status."</td></tr>";
										}
									} else {
										foreach ($ip as $ip) {
											echo "<tr><td style='width: 150px;'>".$ip."</td><td>Response from CloudFlare: FAILED - ".$status."</td></tr>";
										}

									}
								}
							}
							echo "</tbody></table>";

							if(		!empty($ban_log) && !empty($results)) {
								$ban_log = array_merge($ban_log,$results['success']);
								$ban_log = array_unique($ban_log);
								$ban_log = array_diff($ban_log, array(''));
								asort($ban_log);
								$ban_log = implode(',', $ban_log);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} elseif(!empty($ban_log) && empty($results)) {						
								asort($ban_log);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} elseif(empty($ban_log) && !empty($results)) {
								$ban_log = asort($results['success']);
								$ban_log = implode(',', $ban_log);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} elseif(empty($ban_log) && empty($results)) {
								$ban_log = array('');
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} else {
								asort($ban_log);
								$ban_log = implode(',', $results['success']);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							}

						} elseif( _wordfence() && get_option('cftm_wordfenceban_locked_out') !== "1") {
							echo '<table class="widefat" style="width:500px;margin-top: 15px;">
										<thead>
											<tr>
											<th colspan="2">WordFence <b>current</b> locked out IP addresses</th>
											</tr>
										</thead>
										<tbody>';
							echo "<tr><td colspan='2'>WordFence installed, but no <b>current</b> locked out IP addresses marked to be banned.<br/><br/>Please click the checkbox next to '<b>Ban all currently locked out IP addresses</b>' to ban all locked out users.</td></tr>";
							echo "</tbody></table>";
						}

					unset($results);
					unset($wordfence_ips_to_ban);
					unset($iplist);
					unset($ban_log);

					# GET IP ADDRESSES OF PREVIOUSLY LOCKED OUT USERS FROM WORDFENCE

						if( _wordfence() && get_option('cftm_wordfenceban_full_list') == "1" ){
							# gets the full list of locked out addresses from WordFence
							$iplist = $wpdb->get_results( 'SELECT IP FROM '.$wpdb->prefix.'wfLocs' );
							if(!empty($iplist)) {
								# if the list isn't empty, then add the addresses to an array $wordfence_ips_to_ban
								foreach ($iplist as $value) {
									$wordfence_ips_to_ban[] = long2ip($value->IP);									
								}
							} else {
								# if the list is empty, make an empty array
								$wordfence_ips_to_ban = array();
							}
							
							# load the previously banned addresses
							$ban_log = get_option( 'cftm_wordfenceban_log' );

							if(empty($ban_log)) { $ban_log = array(); }
							elseif(!empty($ban_log) && !is_array($ban_log)) { $ban_log = str_getcsv($ban_log); }

							$ban_log = array_diff($ban_log, array("$adminip"));
							$ban_log = array_unique($ban_log);

							$i = 0;
							foreach ($wordfence_ips_to_ban as $ip) {
								if(	$ip !== $adminip && is_array($ban_log) && !in_array($ip, $ban_log)) {
									$result = _cloudflare($ip);
									$status = $result['0'];
									$ip = $result['1'];
									$results[$status][] = $ip;
								} elseif(is_array($ban_log) && in_array( $ip , $ban_log)) {
									$wordfence_skipped[] = $ip;
								}
								$i++;
							}

							if(empty($results)) { $results = array(); }

							echo '	<table class="widefat" style="width:500px;margin-top: 15px;">
										<thead>
											<tr>
											<th colspan="2">WordFence <b>previously</b> locked out IP addresses</th>
											</tr>
										</thead>
										<tbody>';

							if (empty($results)) {
								echo "<tr><td colspan='2'>No new IP addreses to ban from WordFence.</td></tr>";
							} else {
								foreach ($results as $status => $ip) {
									if($status == 'success') {
										foreach ($ip as $ip) {
											echo "<tr><td style='width: 150px;'>".$ip."</td><td>Response from CloudFlare: ".$status."</td></tr>";
										}
									} else {
										foreach ($ip as $ip) {
											echo "<tr><td style='width: 150px;'>".$ip."</td><td>Response from CloudFlare: FAILED - ".$status."</td></tr>";
										}

									}
								}
							}
							echo "</tbody></table>";

							if(		!empty($ban_log) && !empty($results)) {
								$ban_log = array_merge($ban_log,$results['success']);
								$ban_log = array_unique($ban_log);
								$ban_log = array_diff($ban_log, array(''));
								asort($ban_log);
								$ban_log = implode(',', $ban_log);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} elseif(!empty($ban_log) && empty($results)) {						
								asort($ban_log);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} elseif(empty($ban_log) && !empty($results)) {
								$ban_log = asort($results['success']);
								$ban_log = implode(',', $ban_log);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} elseif(empty($ban_log) && empty($results)) {
								$ban_log = array('');
								update_option( 'cftm_wordfenceban_log', $ban_log );
							} else {
								asort($ban_log);
								$ban_log = implode(',', $results['success']);
								update_option( 'cftm_wordfenceban_log', $ban_log );
							}


						} elseif( _wordfence() && get_option('cftm_wordfenceban_full_list') !== "1") {
							echo '<table class="widefat" style="width:500px;margin-top: 15px;">
										<thead>
											<tr>
											<th colspan="2">WordFence <b>previously</b> locked out IP addresses</th>
											</tr>
										</thead>
										<tbody>';
							echo "<tr><td colspan='2'>WordFence installed, but no <b>previously</b> locked out IP addresses marked to be banned.<br/><br/>Please click the checkbox next to '<b>Ban all previously locked out IP addresses</b>' to ban all locked out users.</td></tr>";
							echo "</tbody></table>";
						}

					_runlist('blacklist');
					_runlist('clearlist');
					_runlist('whitelist');
						
					global $invalid;
					if(!empty($invalid) && strlen($invalid["0"]) !== 0) {

						echo '<table class="widefat" style="width:500px;margin-top: 15px;">
							<thead>
							   <tr>
								 <th colspan="2">Errors</th>
							   </tr>
							</thead>
							<tbody>';

						foreach ($invalid as $ip) {
							$count = strlen($ip) - strlen(str_replace(str_split('.'), '', $ip)); 
							$error = '';
							if($count !== 3) {$error = "Incorrect decimal places to be an IP address.<br/>$count found when an IP address should have 3.";}
							if($count == 3 && !is_int($ip))  {$error = "No space before comment, or text in IP address";}
							echo "<tr><td style='width: 150px;'>$ip</td><td>$error</td></tr>";
						}
						echo "</tbody></table>";
					}

					if (!empty($wordfence_skipped)) {

						echo '<table class="widefat" style="width:500px;margin-top: 15px;">
							<thead>
								<tr>
									<th colspan="2">Skipped: Previously Banned WordFence IP Addresses <a style="float:right;" class="button-secondary skippedhidesource hidebutton" href="#">SHOW SKIPPED</a></th>
								</tr>
							</thead>
							<tbody>';

						foreach ($wordfence_skipped as $ip) {	
							echo "<tr class='hidden skippedhide'><td style='width: 150px;'>".$ip."</td><td>Skipped due to being already banned.</td></tr>";
						}
						echo "</tbody></table>";
						
					}

				}



	# Add settings link on dashboard plugins page
	################################
		function cftm_plugin_settings_link($links) {
			$settings_link = '<a href="admin.php?page=cftm">Settings</a>'; 
			array_unshift($links, $settings_link); 
			return $links; 
		}

		$plugin = plugin_basename(__FILE__); 
		add_filter("plugin_action_links_$plugin", 'cftm_plugin_settings_link' );
}