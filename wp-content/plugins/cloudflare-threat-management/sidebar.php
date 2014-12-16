<td style="vertical-align:top;min-width: 300px;max-width: 500px;padding-left: 15px;">
 					<table class="widefat">
						<thead>
							<th>QUICK TIPS & LINKS</th>
						</thead>
						<tr>
							<td>
								<a href="http://thepluginfactory.co/?so=cftm_tpf_logo" target="_blank" title="The Plugin Factory">
									<img src="<?php echo plugins_url( '/images/ThePluginFactoryLogo.png', __FILE__ ) ?>" style="width:100%;max-width:420px;margin: 0 auto;display: block;" />
								</a>
								<br>
								Notice: <b>CloudFlare Threat Management</b> is not associated with the company behind CloudFlare® in any way. To find out more, please read section 3 of the <a href="https://www.cloudflare.com/terms" target="_blank" title="CloudFlare terms of use">CloudFlare terms of use</a>.
								<br>
								<br>
								Tips
								<ul style="margin-left: 30px;list-style-type: disc;color: #A8A8A8;">
									<li style="color:initial"><b>IMPORTANT</b>: All banning, unbanning, and whitelisting done here affects your entire CloudFlare account. This means that if you ban a specific IP address, it will be banned across every domain name registered in your CloudFlare account. <b>Use with caution</b>.</li>
									<li style="color:initial">Press <b>Control-S</b> to save your current settings<br/>
										<span class="smallgray">Tested & working on Chrome 28, Firefox 19, & IE10</span></li>
									<li style="color:initial">Your current IP address is whitelisted during every run</li>
								</ul>
								
								The Plugin Factory Links
								<ul style="margin-left: 30px;list-style-type: disc;color: #A8A8A8;">
									<li><a href='http://thepluginfactory.co/community/forum/plugin-specific/cloudflare-threat-management/?so=cftm' target='_blank' title='CloudFlare Threat Management Plugin Support Forums'>CloudFlare Threat Management Plugin Support</a></li>
									<li><a href='http://thepluginfactory.co/donate' target='_blank' title='The Plugin Factory Donations'>Donate</a></li>
								</ul>

								The Plugin Factory Plugins
								<ul style="margin-left: 30px;list-style-type: disc;color: #A8A8A8;">
									<li><a href='http://thepluginfactory.co/warehouse/gard/?so=cftm' target='_blank' title='Google AdSense for Responsive Design'>GARD</a><br/>
										<span class="smallgray">Google AdSense for Responsive Design - Place responsive AdSense in your content via a the shortcode [GARD].</span></li>
									<li><a href='http://thepluginfactory.co/warehouse/gard-pro/?so=cftm' target='_blank' title='Google AdSense for Responsive Wordpress Themes'>GARD Pro</a><br/>
										<span class="smallgray">Google AdSense for Responsive Design Pro - GARD Pro auto inserts responsive AdSense througout your content, as well as offering a responsive AdSense widgets & more!</span></li>
								</ul>
							</td>
						</tr>
 					</table>

 					<br/>

 					<table class="widefat">
						<thead>
							<th>USING BLACK/CLEAR/WHITE LISTS</th>
						</thead>
						<tr>
							<td>
								IP addresses you want to manually add to any list need to be formatted a specific way.
								<br/><br/>Each IP address should be on it's own line, followed by an optional comment on the same line.
								<br/><br/>
								<label for="sample_good">
									<b>Sample of a good list</b>
								</label><br/>
								<textarea disabled="disabled" name="sample_good" cols="50" rows="10" style="padding:5px;" >0.0.0.0 This is a sample IP and comment
0.0.0.1
0.0.0.2 This is also good! It has puncuation and can span multiple lines.
0.0.0.3 Home
0.0.0.4 Office</textarea><br/><br/>

								<label for="sample_good">
									<b>Sample of a bad list</b>
								</label><br/>
								<textarea disabled="disabled" name="sample_good" cols="50" rows="10" style="padding:5px;" >0.0.0.0.0 This is a bad IP as it has 5 sections.
0.0.0.0This is a bad IP because there is no space before the comment
0.0.0.X This is a bad IP addresses. Ranges are not avilable.</textarea><br/>

							</td>
						</tr>
 					</table>

				</td>