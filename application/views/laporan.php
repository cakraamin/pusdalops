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
<form action="<?=base_url()?>laporan/submit" method="POST" enctype="multipart/form-data" id="validation" >
<div class="topcolumn">
            <div class="logo"></div>            
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                  <?php echo $this->message->display(); ?>
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray spreadsheet"></span>Rekap Laporan</span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                                                            
                                      <div>
                                              <input class=" medium" type="text" name="kuncine" value="<?php if(isset($kuncine)){ echo $kuncine; } ?>">
                                      </div><br/>
                                      <div>
                                              <?php                                              
                                              $selekjenis = (isset($jenise))?$jenise:"";
                                              $jpjen = " onChange='jeniss()' id='jenise' ";                                                        
                                              echo form_dropdown('laporan', $jlaporan, $selekjenis, $jpjen);                                              
                                              ?> 
                                      </div>
                                      <div <?php if($jenise != 2 && $jenise != 4){ echo 'style="display:none"'; } ?> id="jenisa"><br/>
                                              <?php
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
                                      <div  class="lokas" <?php if($jenise != 3 && $jenise != 4){ echo 'style="display:none"'; } ?>><br/>
                                              <?php
                                              $selekLok = (isset($lokasine))?$lokasine:"";
                                              $jlok = " class=' large' onChange='ubLokasi()' id='lokasines'";
                                              echo form_dropdown('lokasi',$loks,$selekLok,$jlok);
                                              ?>                                                                                                   
                                      </div>
                                      <div  id="kecamatans" class="lokas" <?php if($jenise != 3 && $jenise != 4 || $lokasine != 1){ echo 'style="display:none"'; } ?>><br/>
                                              <?php
                                              $selekKec = (isset($val))?$val:"";
                                              $jkec = " class=' large'";
                                              echo form_dropdown('kecamatan',$kecamatan,$selekKec,$jkec);
                                              ?>                                                                                                   
                                      </div>
                                      <div  id="kelurahans" class="lokas" <?php if($jenise != 3 && $jenise != 4 || $lokasine != 2){ echo 'style="display:none"'; } ?>><br/>
                                              <?php
                                              $selekKelurah = (isset($val))?$val:"";
                                              $jkelurah = " data-placeholder='Lokasi Kebencanaan...' class='chzn-select'";
                                              echo form_dropdown('kelurahan',$kelurahan,$selekKelurah,$jkelurah);
                                              ?>                                                                                                   
                                      </div>
                                      <div  <?php if($jenise != 1 && $jenise != 4){ echo 'style="display:none"'; } ?> class="waktuo"><br/>
                                              <?php
                                              $selekWaktu = (isset($waktune))?$waktune:"";
                                              $jpwak = " onChange='waktus()' id='waktune' ";
                                              echo form_dropdown('waktu',$waktu,$selekWaktu,$jpwak);
                                              ?>                                                                                                   
                                      </div>                                      
                                      <div  <?php if($jenise != 1 && $jenise != 4 || $waktune != 1){ echo 'style="display:none"'; } ?> class="waktuo" id="thn"><br/>
                                              <?php
                                              $selekTahun = (isset($tahune))?$tahune:"";
                                              echo form_dropdown('tahun',$tahun,$selekTahun);                                              
                                              ?> 
                                      </div>
                                      <div class="waktuo" id="bln" <?php if($jenise != 1 && $jenise != 4 || $waktune != 2){ echo 'style="display:none"'; } ?>><br/>
                                              <?php
                                              $selekBulan = (isset($bulane))?$bulane:"";
                                              echo form_dropdown('bulan',$bulan,$selekBulan);
                                              ?>
                                      </div>
                                      <div class="waktuo" id="dtl" <?php if($jenise != 1 && $jenise != 4 || $waktune != 3){ echo 'style="display:none"'; } ?>><br/>
                                              <input type="text"  id="datepick" class="datepicker" readonly="readonly" name="tanggal" value="<?php if($tanggale != "00-00-0000"){ echo $tanggale; } ?>"/>
                                      </div><br/>
                                      <a class="uibutton submit_form" >Generate</a>&nbsp;<a class="uibutton" href="<?=base_url()?>laporan/generate/<?=$jenise?>/<?=$bencanane?>/<?=$lokasine?>/<?=$waktune?>/<?=$tahune?>/<?=$bulane?>/<?=$tanggale?>">Export Excel</a>
                      <div class="rekord">Jumlah Record <span><?=$totalPage?></span></div>
                      <table class="display bencana " id="static">
                                <thead>
                                  <tr>
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
                                  <?php
                                  $no = 1;
                                  foreach($kueri as $dt_kueri)
                                  {
                                    ?>
                                    <tr>
                                      <?php
                                      $kuncine = ($kuncine == "")?"kosong":$kuncine;
                                      ?>
                                      <td  width="35"><?=$no?></td>
                                      <td  align="left"><span class="tip"><a href="<?=base_url()?>laporan/get_detail/<?=$dt_kueri['id']?>/<?=$kuncine?>/<?=$jenise?>/<?=$bencanane?>/<?=$lokasine?>/<?=$val?>/<?=$waktune?>/<?=$tahune?>/<?=$bulane?>/<?=$tanggale?>/<?=$sort_by?>/<?=$sort_order?>/<?=$page?>" title="<?=$dt_kueri['keterangan']?>"><?=$dt_kueri['bencana']?></a></span></td>
                                      <td  align="left"><?=ganti_tanggal($dt_kueri['tanggal'])?></td>
                                      <td  align="left"><?=$dt_kueri['kecamatan']?></td>
                                      <td  align="left"><?=$dt_kueri['kelurahan']?></td>
                                      <td  align="left"><?=$dt_kueri['dusun']?></td>
                                      <td  align="left"><?=word_limiter($dt_kueri['keterangan'],5)?></td>
                                      <td ><?=$dt_kueri['meninggal']?></td>
                                      <td ><?=$dt_kueri['hilang']?></td>
                                      <td ><?=$dt_kueri['berat']?></td>
                                      <td ><?=$dt_kueri['ringan']?></td>
                                      <td ><?=$dt_kueri['pengungsi']?></td>
                                      <td ><?=$dt_kueri['menderita']?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                  }
                                  ?>                                  
                                </tbody>
                              </table>                                          
                  <div class="clear"/></div>                  
                  <?=$paging?>
                  </div>
                  </div>
                  </form>                  
