<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

<title>Aplikasi Kebencanaan - Cakra</title>

        <!--[if lt IE 9]>

          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

        <![endif]-->

<link href="<?=base_url()?>assets/template/fingers/css/zice.style.css" rel="stylesheet" type="text/css" />

<link href="<?=base_url()?>assets/template/fingers/css/icon.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/fingers/components/tipsy/tipsy.css" media="all"/>

<style type="text/css">

html {

	background-image: none;

}

#versionBar {

	background-color:#212121;

	position:fixed;

	width:100%;

	height:35px;

	bottom:0;

	left:0;

	text-align:center;

	line-height:35px;

}

.copyright{

	text-align:center; font-size:10px; color:#CCC;

}

.copyright a{

	color:#A31F1A; text-decoration:none

}    

.copyright a.login{

    color:#FFF; text-decoration:none

}

</style>

</head>

<body >

         

<div id="alertMessage" class="error"></div>

<div id="successLogin"></div>

<div class="text_success"><img src="<?=base_url()?>assets/template/fingers/images/loadder/loader_green.gif"  alt="cakraAdmin" /><span>Please wait</span></div>



<div id="login" >

  <div class="ribbon"></div>

  <div class="inner">

  <div  class="logo" ><img src="<?=base_url()?>assets/template/fingers/images/logo/logo_login.png" alt="cakraAdmin" /></div>

  <div class="userbox"></div>

  <div class="formLogin">

   <form name="formLogin"  id="formLogin" action="#">

          <div class="tip">

          <input name="username" type="text"  id="username_id"  title="Username" class="inputs"   />

          </div>

          <div class="tip">

          <input name="password" type="password" id="password"   title="Password" class="inputs"  />

          </div>          

          <div style="float:right;padding:2px 0px ;">

              <div> 

                <ul class="uibutton-group">

                   <li><a class="uibutton normal" href="#"  id="but_login" >Login</a></li>				

               </ul>

              </div>

            </div>

</div>



    </form>

  </div>

</div>

  <div class="clear"></div>

  <div class="shadow"></div>

</div>



<!--Login div-->

<div class="clear"></div>

<div id="versionBar" >

  <div class="copyright" > &copy; Copyright 2012  All Rights Reserved <span class="tip"><a  href="http://www.cakra.web.id" title="Cakra Aminuddin" >Cakra</a> </span></div>

  <!-- // copyright-->

</div>

<!-- Link JScript-->

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/js/jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/js/site.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/components/effect/jquery-jrumble.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/components/ui/jquery.ui.min.js"></script>     

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/components/tipsy/jquery.tipsy.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/components/checkboxes/iphone.check.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/js/jquery.form.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/js/login.js"></script>

</body>

</html>