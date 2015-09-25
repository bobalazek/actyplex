<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '<?php echo FACEBOOK_APPLICATION_ID ?>',
			channelUrl : '<?php echo BASE_URL ?>channel', 
			status     : true,
			cookie     : true,
			xfbml      : true
		});
		
		FB.getLoginStatus( function(response) {
			if( userId != 0 && response.status != 'connected' ) location.reload();
		});
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>