<?php
	include("connection.php");
	include("constants.php");

	if (isset($_POST['money'])) {
		$money = $_POST['money'];
		$relFree = $mysqli->query("Select * from relations_free where userId='".$_SESSION['uid']."'")->fetch_assoc();
		$mysqli->query("update user_money set cash=cash+$money where userId='".$relFree['userId']."'");
		$mysqli->query("update user_money set cash=cash+($money*$persentForParent) where userId='".$relFree['parentId']."'");
		$mysqli->query("update user_money set cash=cash+($money*$persentForGrandParent) where userId='".$relFree['grandParentId']."'");
	}
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=695374143814932";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
	

</script>
<form>
	<div class="fb-like" data-href="http://i.imgur.com/zDOmQvK.jpg" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
</form>

<div id="player"></div>
<script>
// Load API asynchronously.
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '390',
        width: '640',
        videoId: 'Ahg6qcgoay4',
        playerVars: {'disablekb' : 1, 'enablejsapi' : 1}, //'controls' : 0, 
        events: {'onStateChange': onPlayerStateChange}
    }); // create the <iframe> (and YouTube player)
}

function onPlayerStateChange(event) { 
    if(event.data === 0) {
    	alert(event.data);
    	var firstScriptTag = document.getElementsByTagName('player')[0];
    	firstScriptTag.style.display = 'none';

	//$('#player').replaceWith('<img src="https://www.google.com/images/srpr/logo4w.png">');
//        hideVideo();
    }
}

function hideVideo() {
    var img_url = 'https://www.google.com/images/srpr/logo4w.png';
    $('#player').replaceWith('<img src="'+img_url+'">');
};
</script>

