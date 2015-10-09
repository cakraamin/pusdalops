<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
<title>Aplikasi Pendataan Dinas Pendidikan Rembang - Ionlinesoft</title>
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<link href="<?=base_url()?>assets/template/fingers/css/zice.style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/template/fingers/css/icon.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/template/fingers/components/reveal/reveal.css" rel="stylesheet" type="text/css" />
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
#jendelainfo{position:absolute;z-index:1000;top:100;
left:400;background-color:yellow;display:none;}
</style>
<!-- Link JScript-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/js/jquery-1.4.3.min.js"></script>   
<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/js/site.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/components/reveal/jquery.reveal.js"></script>   
<script type="text/javascript">
//google maps GIS 1.1.b by desrizal
//dibuat tanggal 8 Jan 2011
var peta;
var pertama = 0;
//var jenis = "restoran";
var judulx = new Array();
var desx = new Array();
var i;
var url;
var gambar_tanda;
function peta_awal(){
    var rembang = new google.maps.LatLng(-6.708609147163017, 111.33379555307329);
    var petaoption = {
        zoom: 14,
        center: rembang,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        };
    peta = new google.maps.Map(document.getElementById("petaku"),petaoption);    
    ambildatabase('<?=$this->session->userdata("id_school");?>');
}
function set_icon(jenisnya){
    switch(jenisnya){
        case "restoran":
            gambar_tanda = '<?=base_url()?>assets/template/fingers/images/icon/peta/embassy.png';
            break;
        case "airport":
            gambar_tanda = '<?=base_url()?>assets/template/fingers/images/icon/peta/embassy.png';
            break;
        case  "sekolah":
            gambar_tanda = '<?=base_url()?>assets/template/fingers/images/icon/peta/embassy.png';
            break;
    }
}

function setjenis(jns){
    jenis = jns;
}

function setinfo(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {    
        $('#myModal').html('<h1>'+judulx[nomor]+'</h1><p>'+desx[nomor]+'</p><a class="close-reveal-modal">&#215;</a>');     
        $("#kliks").click();
    });
}

function ambildatabase(id){
    $.ajax({
        url: site+"peta/getPeta/5",
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                judulx[i] = msg.wilayah.petak[i].judul;
                desx[i] = msg.wilayah.petak[i].deskripsi;

                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: gambar_tanda
                });
                setinfo(tanda,i);

            }
        }
    });
}
$(document).ready(function(){
   peta_awal();
});
</script>
</head>
<body >        
    <a href="#" data-reveal-id="myModal" data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal" id="kliks" style="display:none;">Click for a modal</a>
  <div id="petaku" style="width:800px; height:600px">ini peta</div>
  <div id="myModal" class="reveal-modal">
            <h1>Reveal Modal Goodness</h1>
            <p>This is a default modal in all its glory, but any of the styles here can easily be changed in the CSS.</p>
            <a class="close-reveal-modal">&#215;</a>
        </div>
<!--Login div-->
<div class="clear"></div>
<div id="versionBar" >
  <div class="copyright" > &copy; Copyright 2012  All Rights Reserved <span class="tip"><a  href="http://www.ionlinesoft.com" title="Zice Admin" >Ionlinesoft</a> </span><span><b>[<a class="login" href="<?=base_url()?>home/login">Login</a>]</b></span> </div>
  <!-- // copyright-->
</div>
</body>
</html>