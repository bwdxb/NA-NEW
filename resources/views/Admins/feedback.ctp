<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <?php echo $this->Html->charset(); ?>
  <title>
  <?php __('Maximus'); ?>
  <?php echo $title_for_layout; ?>
  </title>
  <?php echo $this->Html->css('layout'); ?>
  <style>
  ul.check li{ background:url(../img/checkf.png) bottom left no-repeat;list-style:none; font-size:13px; color:#D62635 !important; padding:10px 0px 0px 25px; font-weight:bold; margin-left:10px;}
   ul.check li a:link, ul.check li a:active, ul.check li a:visited{ color:#2482DA !important; text-decoration:none;}
  </style>
</head>
<body >
	<div class="container">
		<div id="content">
          <div id="wrapper">
             <div class="innerContent">
                <div class="topLink" style="padding-top:30px;">
                </div>
                <div class="nav">
                <div id="logo"><img src="<?php echo BaseURL;?>uploads/logo/<?php echo $site_logo; ?>" width="257" height="71" ></div>
                
                <div class="right"><img src="<?php echo BaseURL;?>uploads/logo/<?php echo $maximus_logo; ?>" width="157" height="39" /></div>
                </div>
                </div>
                
                <div  id="Layoutcontainer">
                  <div id="rightpanel" style="width:1022px !important;">
                    <div class="MindFormFull" style="width:1000px !important;">
                        <div  class="stylized">
                     		<h1> Feedback</h1>
                            <?php
                            foreach($workshop as $name)
							{
							?>
                            <ul class="check"><li><a href="<?php echo BaseURL ?>survey/surveys/response/<?php echo $name['surveys']['id']?>/type=workshop"><?php echo $name['surveys']['name']; ?></a></li></ul>
                            <div style="clear:both;"></div>
                            
                            <?php } ?>
                            
                            <div  class="buttonalign">
                            </div>
                     </div>
                  </div>    
            </div>     
     </div>
            </div>
		</div>
	</div>
    <div id="Mindfooter">
  <div class="FooterText">
  <div class="copyright">Copy right @ <?php echo date('Y') ;?> -ARK Infosolutions Pvt Ltd.</div>
<div class="clear">
  </div>
  	</div>
  </div>	
</body>
</html>