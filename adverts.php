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
<form name="form" id="form" method="POST">
  <input type="hidden" name="money" value="10"/>
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
        videoId: 'HHfOejlvVsY',
        playerVars: {'controls' : 0,'disablekb' : 1, 'enablejsapi' : 1}, //'controls' : 0, 
        events: {'onStateChange': onPlayerStateChange}
    }); // create the <iframe> (and YouTube player)
}

function onPlayerStateChange(event) { 
    if(event.data === 0) {
    	var firstScriptTag = document.getElementById('player');
      var form = document.getElementById("form");
      form.submit();
      alert("you earn $10")
      //<php? 
        //$money = 10;
        //$relFree = $mysqli->query("Select * from relations_free where userId='".$_SESSION['uid']."'")->fetch_assoc();
        //$mysqli->query("update user_money set cash=cash+$money where userId='".$relFree['userId']."'");
        //$mysqli->query("update user_money set cash=cash+($money*$persentForParent) where userId='".$relFree['parentId']."'");
        //$mysqli->query("update user_money set cash=cash+($money*$persentForGrandParent) where userId='".$relFree['grandParentId']."'");
      //?>
    	//firstScriptTag.style.display = 'none';

	//$('#player').replaceWith('<img src="https://www.google.com/images/srpr/logo4w.png">');
//        hideVideo();
    }
}

function hideVideo() {
    var img_url = 'https://www.google.com/images/srpr/logo4w.png';
    $('#player').replaceWith('<img src="'+img_url+'">');
};
</script>

