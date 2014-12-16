=== CloudFlare Threat Management ===
Contributors: The Digital Hippies,The Plugin Factory
Donate link: http://thepluginfactory.co/donate
Tags: CloudFlare, Ban Users, Ban Management, WordFence, Brute Force, Brute Force Prevention, Hack, Security, Blacklist, Threat Control
Requires at least: 3.0.1
Tested up to: 3.5.2
Stable tag: 0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CloudFlare Threat Management allows you to manage all banning, unbanning, and clearing of IP addresses across your entire CloudFlare account.

== Description ==

CloudFlare Threat Management allows you to manage all banning, unbanning, and clearing of IP addresses at a CloudFlare level. CloudFlare Threat Management also intergrates with popular WordPress security plugins such as [WordFence](http://wordpress.org/plugins/wordfence/).

Set up is easy. Enter the email which you use to login to [CloudFlare.com](https://www.cloudflare.com/login) & your [API key found here](https://www.cloudflare.com/my-account). Once you save that information into CloudFlare Threat Management, you'll be able to specify a list of IP address to blacklist (ban), whitelist (never ban) and clear (remove from CloudFlare completely).

It's **important to note** that any changes you do while using CloudFlare Threat Management populate **across your entire CloudFlare account**. This means that if you have 50 domains registered under your CloudFlare account, and you ban a single IP address, that address is banned across all 50 domains. This is extremely helpful if you know the IP addresses are malicious and that you never want them to access your websites.

**WordFence**  
CloudFlare Threat Management plays well with other plugins such as WordFence. For example, you can at your leisure, ban all currently locked out IP addresses from WordFence, or even ban all IP addresses which have ever been locked out via WordFence. This means that if you got hit with a brute force attack with bots trying to login to your admin control panel, you can in one click, ban all the IP addresses which were locked out by WordFence.  

The advantage of this is two fold:

* First, WordFence only allows locking a user out for a maximum of 60 days, whereas a CloudFlare ban is permanent.
* Second, by doing it this way, you take a large load off of your server. If you are getting hit by dozens (or hundreds!) of bots per second, and you successfully ban these bots, they will never even hit your server. They will try, but get stopped by CloudFlare, thereby putting 0 additional load on your server.

Support: [The Digital Hippies Official Wordpress Plugin Support Forums](http://thedigitalhippies.com/pluginsupport "The Digital Hippies WordPress Plugin Support Forums")  
Notice: Our plugin <b>CloudFlare Threat Management</b> is not associated with the company behind CloudFlare® in any way. To find out more, please read section 3 of the [CloudFlare terms of use](https://www.cloudflare.com/terms "CloudFlare terms of use").


== Installation ==

1. Extract and upload the contents of 'cloudflare-threat-management.zip' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings -> CloudFlare Threat Management and enter your CloudFlare credentials.
4. Configure IP addresses to ban, save the lists, and click "RUN CLOUDFLARE THREAT MANAGEMENT"

== Frequently Asked Questions ==

= What happens if I blacklist myself? =

We put algorithms in pace to prevent banning of your current logged in IP. Your current IP is added to the whitelist at the end of every run. In the even that you do somehow lock yourself out, please visit your CloudFlare Threat control page for the domain you are locked out of, and manually add your IP address and click "Trust";

= Can I put notes next to manually added IP addresses? =

Yes. Each address you manually add is to be placed on it's own line. You can add a comment on the same line as the IP address, just be sure to put a space before your comment.   
Example:  
0.0.0.0 This is a comment  
0.0.0.1 This is also comment!  
0.0.0.2 More Comments! Periods are OK too.  

= The security plugin I use isn't listed in CloudFlare Threat Management, can you add it? =

Yes. In most cases, if the IP address list is stored in the WordPress database, then we can use the list. To request that we add support for your security plugin, please post at [The Digital Hippies Official WordPress Plugin Support Forums](http://thedigitalhippies.com/pluginsupport "The Digital Hippies WordPress Plugin Support Forums").

== Screenshots ==

1. Admin Options Page. Enter your the email address you use to manage your CloudFlare account, along with your [API key found here](https://www.cloudflare.com/my-account). (screenshot-1.png)

== Changelog ==

= 0.5 =
* Initial release.

== Upgrade Notice ==

= 0.5 =
Initial release. No upgrade needed.