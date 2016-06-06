<?php  
	$path_za_share = "http://www.vucicomer.rs";
	$naslov_za_share = "Vučićomer";
?>

<div class="social">
		<div class="facebook">
			<div class="fb-like fb_iframe_widget" data-href="<?php echo $path_za_share; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;href=<?php echo $path_za_share; ?>&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=false">
            <span style="vertical-align: bottom; width: 120px; height: 20px;">
            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo $path_za_share; ?>%2F&layout=button&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></span></div>
		</div>
		<!-- /.facebook -->

		<div class="twitter">
			<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
		<!-- /.twitter -->
	</div>
	<!-- /.social -->