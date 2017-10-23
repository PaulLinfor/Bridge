<!-- DOCTYPE -->
<!DOCTYPE html>
<?php
$videos = array( //2D Array of videos of the form (id,title,field,author,date uploaded,views,likes), will most likely be changed later
  array(001,"Title 1","Computer Science","Bob","October 12th, 2017",500,10),
  array(002,"Title 2","Mechanical Engineering","Mary","October 2nd,2017",250,5),
  array(003,"Title 3","Civil Engineering","Tom","October 11th,2017",50,1),
  array(004,"Title 4","Network Security","Walter","October 17th,2017",75,23),
  array(005,"Title 5","Civil Engineering","Jim","October 17th,2017",125,6),
  array(006,"Title 6","Civil Engineering","Rebecca","October 12th,2017",323,31),
  array(007,"Title 7","Civil Engineering","Dylan","October 7th,2017",255,21),
  array(008,"Title 8","Civil Engineering","Fred","October 5th,2017",456,32),
  array(009,"Title 9","Civil Engineering","George","October 3rd,2017",678,32),
  array(010,"Title 10","Civil Engineering","Jerry","October 17th,2017",111,12),
  array(010,"Title 11","Civil Engineering","Kate","October 22th,2017",522,25),
  array(010,"Title 12","Civil Engineering","Michael","August 11th,2017",343,22)
);
?>
<html lang="en">
  <head>
    <title>Bridge: Home</title>
    <meta charset="utf-8">
    <!-- Viewport Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>
    <h1> <!--Heading, includes Logo, Profile button, and other menu buttons -->
      Bridge
      <img src="images/defaultavatar.png" height = "40" width = "40" id = "hPic" class="rounded float-right" data-toggle = "modal" data-target="#Profile"><br />
    <button type="button" class="btn blue btn-sm">Internships</button>
    <button type="button" class="btn blue btn-sm">Fab Five</button>
    <button type="button" id = "aButton" class="btn blue btn-sm" data-toggle = "modal" data-target = "#aSet">Admin</button>
    <img src="images/settingsicon.png" height = "40" width = "40" id = "oPic" class="rounded float-right" data-toggle = "modal" data-target="#Settings">
  </h1>
  <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" id= "column"> <!-- Container for cards -->
	<div class="container" id ="videoList">
    <div class="card mx-auto" style="width: 20rem;">
            <img class="card-img-top" src="..." alt="Thumbnail">
            <div class="card-block">
              <h4 class="card-title"><?php echo $videos[i][1]; ?></h4>
              <div class="card-footer text-muted">
              <h4>By: <?php echo $videos[i][3]; ?></h4>
              <h4>Uploaded <?php echo $videos[i][4]; ?></h4>
              <h4><?php echo $videos[i][5]; ?> Views</h4>
              <h4><?php echo $videos[i][6]; ?> Likes</h4>
              </div>
              </div>
              </div>
	</div>
  </div>
<!-- Profile page,Edit Profile page and Settings page, activated and swapped by buttons -->
  <div class="modal fade" id="Profile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" id = "pHeader">
          <img src="images/defaultavatar.png" id = "pPic" class="img-thumbnail">
          <div class="modal-body">
            <h2 id="pName">Bob Walter</h2>
            <p id="pAffil">Intel Corporation</p>
            <p id="pRole">Senior Software Engineer</p>
      </div>
      </div>
      <div class="modal-body">
        <div id = "Bio">Static profile info here</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="rPB">Report</button>
        <button type="button" class="btn blue" id="ePB" data-toggle ="modal" data-target = "#eProfile">Edit Profile</button>
      </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="eProfile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" id = "pHeader">
            <img src="images/defaultavatar.png" id = "pPic" class="img-thumbnail">
            <div class="modal-body">
              <h2 id="pName">Bob</h2>
              <p id="pAffil">Intel Corporation</p>
              <p id="pRole">Senior Software Engineer</p>
            </div>
          </div>
        <div class="modal-body">
          <input class="text input-lg" id ="newProfile"></input>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn blue" id ="sPB" data-dismiss="modal" data-toggle ="modal" data-target = "#Profile">Save</button>
        </div>
      </div>
      </div>
      </div>

      <div class="modal fade" id="Settings" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <div class="modal-footer">
              <button type="button" class="btn blue" data-dismiss="modal" data-toggle ="modal" data-target = "eProfile">Change Field</button><br />
              <button type="button" class="btn blue" id="logOutB" data-dismiss="modal">Log Out</button>
          </div>
          </div>
        </div>
        </div>
        </div>

        <div class="modal fade" id="aSet" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <div class="modal-footer" id = "aBody">
                <button type="button" class="btn blue" data-dismiss="modal">View All Accounts</button><br />
                <button type="button" class="btn blue" data-dismiss="modal">Manage Flagged Content</button>
            </div>
            </div>
          </div>
          </div>
          </div>
	<style>
	h1{
		background-color: #1A7CBC;
    height: 90px;
	}
	body{
		background-color: #82CBFB;
	}
  .newProfile{
    height:500px;
    width: 500px;
  }
  .row{
    margin-bottom: 10px;
    margin-left: 10px;
  }
  .aBody{
    padding-bottom:5px;
    text-align: center;
  }
  .Settings{
      margin-bottom:5px;
  }
  .sBody{
    background-color: #FF33E3;
  }
  .Settings:active{

  }
  .pAffil:default{
    text-decoration-color: #FF33E3;

  }
  .modal-footer .btn{
     margin-top: 15px;
   }
  .blue{
    background-color:#5B5B5B;
  }
  .card{
    margin-bottom: 15px;
  }
	</style>

		<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

		<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

		<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!--JQuery used for AJAX (communication between PHP and Javascript) -->
<script> //Javascript for the page here
$(document).ready(function () {
    $('#ePB').click(function onchange() { //fill in edit field with original bio, in case only minor edits are needed
          $('#newProfile').val($('#Bio').html());
      });

    $('#sPB').click(function onchange() { //replace old profile with new one, primitive
          $('#Bio').html($('#newProfile').val());
      });
    $('#logOutB').click(function onchange() { //replace old profile with new one, primitive
          window.location.href = '/Bridge/index.html';
      });
    //$.get("php/home.php", {action:"cards"})
	//.done(function(data){
		//	$('#videoList').append(data);
		//	});

		});

</script>

  </body>
</html>
