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
<div id="kolome">
  <h2>Data Kebencanaan</h2>
  <script type="text/javascript">
function waktus(){
  var nilai = $('#waktune').val();
  if(nilai == 1){
    $('#thn').show();
    $('#bln').hide();
    $('#dtl').hide();
  }else if(nilai == 2){
    $('#thn').show();
    $('#bln').show();
    $('#dtl').hide();
  }else{
    $('#thn').hide();
    $('#bln').hide();
    $('#dtl').show();
  }
}
function jeniss(){
  var nilai = $('#jenise').val();
  if(nilai == 1){
    $('.waktuo').show();
    $('#jenisa').hide();
    $('.lokas').hide();
    $('#bln').hide();
    $('#dtl').hide();
  }else if(nilai == 2){
    $('.waktuo').hide();
    $('#jenisa').show();
    $('.lokas').hide();
    $('#bln').hide();
    $('#dtl').hide();
  }else if(nilai == 3){
    $('.waktuo').hide();
    $('#jenisa').hide();
    $('.lokas').show();
    $('#bln').hide();
    $('#dtl').hide();
    $('#kelurahans').hide();
  }else{
    $('.waktuo').show();
    $('#jenisa').show();
    $('.lokas').show();
    $('#bln').hide();
    $('#dtl').hide();
    $('#kelurahans').hide();
  }
}
function ubLokasi(){
  var nilai = $('#lokasines').val();
  if(nilai == 1){
    $('#kecamatans').show()
    $('#kelurahans').hide()
  }else{
    $('#kecamatans').hide()
    $('#kelurahans').show()
  }
}
</script>
<form action="<?=base_url()?>home/submit" method="POST" enctype="multipart/form-data" id="validation" >          
                  <?php echo $this->message->display(); ?>                   
                                      <div>
                                              <input class=" medium" type="text" name="kuncine" value="<? if(isset($kuncine)){ echo $kuncine; } ?>">
                                      </div><br/>
                                      <div>
                                              <?                                              
                                              $selekjenis = (isset($jenise))?$jenise:"";
                                              $jpjen = " onChange='jeniss()' id='jenise' ";                                                        
                                              echo form_dropdown('laporan', $jlaporan, $selekjenis, $jpjen);                                              
                                              ?> 
                                      </div>
                                      <div <? if($jenise != 2 && $jenise != 4){ echo 'style="display:none"'; } ?> id="jenisa"><br/>
                                              <?
                                              $selekBencanane = (isset($bencanane))?$bencanane:"";
                                              echo form_dropdown('jenis', $jenis_ben,$selekBencanane);
                                              ?> 
                                      </div>
                                      <!--<div <? if($jenise != 3 && $jenise != 4){ echo 'style="display:none"'; } ?> id="lokasine"><br/>
                                              <?
                                              $selekLokasi = (isset($lokasine))?$lokasine:"";
                                              $jplok = "data-placeholder='Lokasi Kebencanaan...' class='chzn-select'";
                                              echo form_dropdown('lokasi',$lokasi,$selekLokasi,$jplok);
                                              ?> 
                                      </div>-->                                      
                                      <div  class="lokas" <? if($jenise != 3 && $jenise != 4){ echo 'style="display:none"'; } ?>><br/>
                                              <?
                                              $selekLok = (isset($lokasine))?$lokasine:"";
                                              $jlok = " class=' large' onChange='ubLokasi()' id='lokasines'";
                                              echo form_dropdown('lokasi',$loks,$selekLok,$jlok);
                                              ?>                                                                                                   
                                      </div>
                                      <div  id="kecamatans" class="lokas" <? if($jenise != 3 && $jenise != 4 || $lokasine != 1){ echo 'style="display:none"'; } ?>><br/>
                                              <?
                                              $selekKec = (isset($val))?$val:"";
                                              $jkec = " class=' large'";
                                              echo form_dropdown('kecamatan',$kecamatan,$selekKec,$jkec);
                                              ?>                                                                                                   
                                      </div>
                                      <div  id="kelurahans" class="lokas" <? if($jenise != 3 && $jenise != 4 || $lokasine != 2){ echo 'style="display:none"'; } ?>><br/>
                                              <?
                                              $selekKelurah = (isset($val))?$val:"";
                                              $jkelurah = " data-placeholder='Lokasi Kebencanaan...' class='chzn-select'";
                                              echo form_dropdown('kelurahan',$kelurahan,$selekKelurah,$jkelurah);
                                              ?>                                                                                                   
                                      </div>
                                      <div  <? if($jenise != 1 && $jenise != 4){ echo 'style="display:none"'; } ?> class="waktuo"><br/>
                                              <?
                                              $selekWaktu = (isset($waktune))?$waktune:"";
                                              $jpwak = " onChange='waktus()' id='waktune' ";
                                              echo form_dropdown('waktu',$waktu,$selekWaktu,$jpwak);
                                              ?>                                                                                                   
                                      </div>                                      
                                      <div  <? if($jenise != 1 && $jenise != 4 || $waktune != 1){ echo 'style="display:none"'; } ?> class="waktuo" id="thn"><br/>
                                              <?
                                              $selekTahun = (isset($tahune))?$tahune:"";
                                              echo form_dropdown('tahun',$tahun,$selekTahun);                                              
                                              ?> 
                                      </div>
                                      <div class="waktuo" id="bln" <? if($jenise != 1 && $jenise != 4 || $waktune != 2){ echo 'style="display:none"'; } ?>><br/>
                                              <?
                                              $selekBulan = (isset($bulane))?$bulane:"";
                                              echo form_dropdown('bulan',$bulan,$selekBulan);
                                              ?>
                                      </div>
                                      <div class="waktuo" id="dtl" <? if($jenise != 1 && $jenise != 4 || $waktune != 3){ echo 'style="display:none"'; } ?>><br/>
                                              <input type="text"  id="datepick" class="datepicker" readonly="readonly" name="tanggal" value="<? if($tanggale != "00-00-0000"){ echo $tanggale; } ?>"/>
                                      </div><br/>
                                      <a class="uibutton submit_form" >Generate</a>&nbsp;<a class="uibutton" href="<?=base_url()?>home/generate/<?=$jenise?>/<?=$bencanane?>/<?=$lokasine?>/<?=$waktune?>/<?=$tahune?>/<?=$bulane?>/<?=$tanggale?>">Export Excel</a>
                      <div class="rekord">Jumlah Record <span><?=$totalPage?></span></div>
                      <table class="display bencana " id="static">
                                <thead>
                                  <tr class="atas">
                                    <th width="35" >NO</th>
                                    <th width="120" align="left">Bencana</th>
                                    <th>Tanggal</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>                                    
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Meninggal</th>
                                    <th>Hilang</th>
                                    <th>Luka Berat</th>
                                    <th>Luka Ringan</th>
                                    <th>Pengungsi</th>
                                    <th>Menderita</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?
                                  $no = 1;
                                  foreach($kueri as $dt_kueri)
                                  {
                                    ?>
                                    <tr>
                                      <?
                                      $kuncine = ($kuncine == "")?"kosong":$kuncine;
                                      ?>
                                      <td align="center" width="35"><?=$no?></td>
                                      <td align="left"><span class="tip"><a href="<?=base_url()?>home/get_detail/<?=$dt_kueri['id']?>/<?=$kuncine?>/<?=$jenise?>/<?=$bencanane?>/<?=$lokasine?>/<?=$val?>/<?=$waktune?>/<?=$tahune?>/<?=$bulane?>/<?=$tanggale?>/<?=$sort_by?>/<?=$sort_order?>/<?=$page?>" title="<?=$dt_kueri['keterangan']?>"><?=$dt_kueri['bencana']?></a></span></td>
                                      <td align="left"><?=ganti_tanggal($dt_kueri['tanggal'])?></td>
                                      <td align="left"><?=$dt_kueri['kecamatan']?></td>
                                      <td align="left"><?=$dt_kueri['kelurahan']?></td>
                                      <td align="left"><?=$dt_kueri['dusun']?></td>
                                      <td align="left"><?=word_limiter($dt_kueri['keterangan'],5)?></td>
                                      <td align="center"><?=$dt_kueri['meninggal']?></td>
                                      <td align="center"><?=$dt_kueri['hilang']?></td>
                                      <td align="center"><?=$dt_kueri['berat']?></td>
                                      <td align="center"><?=$dt_kueri['ringan']?></td>
                                      <td align="center"><?=$dt_kueri['pengungsi']?></td>
                                      <td align="center"><?=$dt_kueri['menderita']?></td>
                                    </tr>
                                    <?
                                    $no++;
                                  }
                                  ?>                                  
                                </tbody>
                              </table>                                          
                  <div class="clear"/></div>                  
                  <?=$paging?>                  
                  </form>
</div>
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