
<?php
    function echo_memory_usage() {
        $mem_usage = memory_get_usage(true);
       
        if ($mem_usage < 1024)
            echo $mem_usage." bytes";
        elseif ($mem_usage < 1048576)
            echo round($mem_usage/1024,2)." kilobytes";
        else
            echo round($mem_usage/1048576,2)." megabytes";
           
        echo "<br/>";
    }
echo_memory_usage();
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="/css/layout.css" />
  <link href="/css/style.css" rel="stylesheet" type="text/css" />
 
       <script type="text/javascript" src="../js/jquery_1.5-jquery_ui.min.js"></script>
         <script type="text/javascript" src="../js/scriptbreaker-multiple-accordion-1.js"></script>
          
<!-- Design for nicer paging -->
	
</head>

<body>
<div id="Loginwrapper">
<div id="Logincontent">
<div id="Login_body">

<!-- Form Title Starts Here -->
<div class="form_title">
<img src="img/signIn-top.png" height="54" alt="SignIn" />
</div>
<!-- Form Title Ends Here -->

<!-- Form Starts Here -->
<div class="form_box">

<form id="loginform" name="loginform" method="post" action="">
<table class="formLayout">
<tr>
<td class="form-left">
<table>
<tr><td align="left"><input type="text" value="Demo" /></td></tr>
<tr><td align="left"><input type="text" value="***" /></td></tr>
<tr><td class="form-td">Forgot Password? &nbsp;&nbsp;<a href="#">Click here to Restore</a></td></tr>
</td></tr>
</table>

</td>
<td class="form-right" valign="top">
<!--<p ><span class="big">You can Login with your Social account</span></p>
<div><input type="button" value=""  class="facebookbtn"/></div>
<div><input type="button" value=""  class="twitterbtn" /></div>
<div><input type="button" value=""  class="googlebtn" /></div>-->
<div style="margin:0 auto; position:relative; top:50px; text-align:center;"><img src="img/logo.png" /></div>
<table></table>
</td>
</tr>

</table>
</form>
<table><tr><td>
<div class="left"><?php echo $this->Form->Create('Admin',array('action'=>'manage_users'));?>
	 <?php echo $this->Form->button('',array('class'=>'loginbtn'));
	           echo $this->Form->end();?></h2></div></td>
		   <td valign="top">
		   <div class="left" style="padding:20px 0px 0px 20px;"><input type="checkbox"/> Remember me</div>
		   </td>
		   </tr>
		   </table>
<div class="Message">Dont Registered? <a href="#">Register Now !</a></div>

</div>
<div class="form_title">
<img src="img/signIn-bottom.png"  height="13" alt="SignIn" />
</div>
<!-- Form Ends Here -->


</div>

</div>
</div>


</body>
</html>
