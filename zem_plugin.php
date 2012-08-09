<?php

// This is a PLUGIN TEMPLATE.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Uncomment and edit this line to override:
$plugin['name'] = 'Spread.ly';
$plugin['version'] = '1.0';
$plugin['author'] = 'Matthias Pfefferle and Fran Garcia';
$plugin['author_uri'] = 'http://spreadly.com';
$plugin['description'] = 'This plugins shows the Spread.ly button';

// Plugin types:
// 0 = regular plugin; loaded on the public web side only
// 1 = admin plugin; loaded on both the public and admin side
// 2 = library; loaded only when include_plugin() or require_plugin() is called
$plugin['type'] = 1;


@include_once('zem_tpl.php');

if (0) {
?>
# --- BEGIN PLUGIN HELP ---

<strong>TXP Spread.ly</strong><br><br>

This plugins shows a like/deal button for the Spread.ly service.<br><br>

The instructions are very easy and you just to put a tag into the desired form or page in your Textpattern installation. The tag is &lt;txp:spreadly/&gt; and it accepts some optional parameters:<br/><br/>
<ul>
<li><em>url</em>: the URL to like/deal. If you don't use this parameter, the current article URL will be send by default.
<li><em>social</em>: the "social" parameter decides if there are profile images of your friends below the button (only if your friends have liked this URL before).</li>
<li><em>title</em>: the title of the sent page. The article title is sent by default.</li>
<li><em>description</em>: a short summary.</li>
<li><em>photo</em>: URL of an image from your post. </li>
</ul>
<br/>
A useful example could be the next one:

&lt;txp:spreadly social="1" photo="http://spreadly.com/img/spreadlyicon.jpg" /&gt;
# --- END PLUGIN HELP ---
<?php
}

# --- BEGIN PLUGIN CODE ---


// ---- Add a new tab to the Extensions tab / "postmaster"
if (@txpinterface == 'admin') {
	global $txpcfg;
}


// ---- POSTMASTER "WRITE" TAB FUNCTION ------------------------------------

function spreadly($atts="") {
	global $thisarticle;

		extract(lAtts(array(
			"url"=>permlinkurl($thisarticle),
			"title"=>$thisarticle['title'],
		  "social"=>0,
			"description"=>"",
			"photo"=>""
		),$atts));

	if ($social==0)
		$height = "24";
	else
		$height = "60";

	$output = '<iframe src="http://button.spread.ly/?url='.urlencode($url).'&social='.urlencode($social).'&title='.urlencode($title).'&description='.urlencode($description).'&photo='.urlencode($photo).'" style="overflow:hidden; width: 420px; height: '.$height.'px; padding: 0;" frameborder="0" scrolling="no" marginheight="0" allowTransparency="true"></iframe>';

	return $output;
}



# --- END PLUGIN CODE ---

?>
