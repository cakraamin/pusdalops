<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/fingers/css/jquery.autocomplete.css"/>
<script type="text/javascript" src="<?=base_url()?>assets/template/fingers/js/jquery.autocomplete.js"></script>        
<script type="text/javascript">
$(function () {
    'use strict';    
    $('#autocomplete').autocomplete({
        serviceUrl: '<?=base_url()?>kebencanaan/getLokasi',
        onSelect: function (suggestion) {                      
          $('#lokasine').val(suggestion.data);                    
        },
        onSearchComplete: function (query, suggestions) {         
                
        }
    });
});
</script>
<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>kebencanaan/daftar" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
                            </ul>     
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                  <?=$this->message->display();?>
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray user"></span><?=$ket?></span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                      
                    <div class="tab_container" >
                          <div id="tab1" class="tab_content"> 
                              <div class="load_page">                                                         
                                <div class="formEl_b">  
                                <form id="validation" action="<?=base_url()?>kebencanaan/<?=$link?>" method="POST" enctype="multipart/form-data"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                                                                                             
                                      <div class="section">
                                      <label> Jenis Bencana </label>
                                      <div>
                                              <?                                              
                                              $selektgl = (isset($kueri->id_jenis_bencana))?$kueri->id_jenis_bencana:"";
                                              $jptgl = "data-placeholder='Jenis Bencana...' class='large' onChange='getBencana()' id='jenis'";
                                              echo form_dropdown('jenis', $jenis_ben, $selektgl,$jptgl);                                              
                                              ?> 
                                      </div>                                                                            
                                      </div>    
                                      <div class="section">
                                          <label>Tanggal Kejadian</label>
                                          <?
                                          if(isset($kueri->tanggal_bencana))
                                          { 
                                            $tanggal = $kueri->tanggal_bencana;
                                            $pecah = explode("-", $tanggal);
                                            $tanggal = $pecah[2]."-".$pecah[1]."-".$pecah[0];
                                          }
                                          else
                                          {
                                            $tanggal = "";
                                          }
                                          ?>
                                          <div><input type="text"  id="datepick" class="datepicker" readonly="readonly" name="tanggal_bencana" value="<?=$tanggal?>"/></div>
                                          <label>Waktu Kejadian</label>
                                          <?
                                          if(isset($kueri->waktu_bencana))
                                          { 
                                            $waktu = $kueri->waktu_bencana;
                                            $pecah1 = explode(":", $waktu);
                                            $waktu = $pecah1[0].":".$pecah1[1];
                                          }
                                          else
                                          {
                                            $waktu = "";
                                          }
                                          ?>
                                          <div><input type="text" id="timepicker"  readonly="readonly" name="waktu_bencana" value="<?=$waktu?>" /></div>
                                      </div>                                      
                                      <div class="section">                                    
                                      <label> Dusun </label>
                                      <div>                                              
                                              <input type="text" name="dusun" class=" medium" value="<? if(isset($kueri->nama_dusun)){ echo $kueri->nama_dusun; } ?>" id="autocomplete"/>
                                              <input type="hidden" name="lokasine" id="lokasine" value="<? if(isset($kueri->id_dusun)){ echo $kueri->id_dusun; } ?>">
                                      </div>
                                      <label> RT </label>
                                      <div>                                              
                                              <input type="text" name="rt_lokasi" class=" small" value="<? if(isset($kueri->rt_lokasi)){ echo $kueri->rt_lokasi; } ?>"  />
                                      </div>
                                      <label class="lok" style="display:none;"> Lokasi Kebencanaan </label>
                                      <div class="lok" style="display:none;">
                                              <?
                                              $seleklok = (isset($kueri->id_kecamatan))?$kueri->id_kecamatan:"";
                                              $jplok = "data-placeholder='Lokasi Kebencanaan...' class='chzn-select' id='kelurahan'";
                                              echo form_dropdown('lokasi', $lokasi, $seleklok,$jplok);
                                              ?>                                      
                                      </div>                                      
                                      </div>                                        
                                      <div class="section">
                                      <label> Letak Geografis </label>
                                          <div>
                                          <input type="text"  class=" small" name="long" value="<? if(isset($kueri->long_lokasi)){ echo $kueri->long_lokasi; } ?>" />
                                          <span class="f_help">Koordinat Bencana (Long X)</span>
                                          </div>
                                          <div>
                                          <input type="text"  class=" small" name="lat" value="<? if(isset($kueri->lat_lokasi)){ echo $kueri->lat_lokasi; } ?>" />
                                          <span class="f_help">Koordinat Bencana (Lat Y)</span>
                                          </div>
                                      </div>                                        
                                      <div class="section" >
                                          <label> Penyebab </label>   
                                          <div> <input type="text" name="sebab" class=" full" value="<? if(isset($kueri->sebab_bencana)){ echo $kueri->sebab_bencana; } ?>"  /></div>
                                      </div>                                    
                                      <div class="section" >
                                          <label> Deskripsi Bencana </label>   
                                          <div > <textarea name="editor" id="editor"  class="editor"  cols="" rows="1"><? if(isset($kueri->deskripsi_bencana)){ echo $kueri->deskripsi_bencana; } ?></textarea></div> 
                                      </div>
                                      <div class="section" >
                                          <label> Kondisi Cuaca </label>   
                                          <div> <input type="text" name="kondisi" class=" large" value="<? if(isset($kueri->kondisi_bencana)){ echo $kueri->kondisi_bencana; } ?>"  /></div>
                                      </div>
                                      <div class="section" >
                                          <label> Cakupan Bencana </label>   
                                          <div> <input type="text" name="cakup_bencana" class=" full" value="<? if(isset($kueri->cakup_bencana)){ echo $kueri->cakup_bencana; } ?>"  /></div>
                                      </div>
                                      <div class="section" >
                                          <label> Sumber Informasi </label>   
                                          <div> <input type="text" name="sumber_informasi" class=" large" value="<? if(isset($kueri->sumber_informasi)){ echo $kueri->sumber_informasi; } ?>"  /></div>
                                      </div>
                                      <div class="section ">
                                      <label> File Data Korban dan Kerusakan </label>   
                                      <div> 
                                          <input type="file" class="fileupload" name="userfile" />
                                          <br/><br/><a href="<?=base_url()?>kebencanaan/download">Sample File Import</a>
                                          <input type="hidden" name="excel" value="<? if(isset($kueri->excel_bencana)){ echo $kueri->excel_bencana; } ?>"/>
                                          <?php
                                          if(isset($kueri->excel_bencana) && $kueri->excel_bencana == 1 && $kueri->name_excel != "")
                                          {
                                          	echo "<br/><a href='".base_url()."kebencanaan/download_import/".$kueri->id_bencana."'>Downoad File Import</a>";
                                          }
                                          ?>
                                      </div>
                                      </div>
                                      <div class="section ">
                                          <label> Meninggal </label>
                                          <div> <input type="text" name="meninggal" class=" small" value="<? if(isset($kueri->meninggal)){ echo $kueri->meninggal; } ?>"  /></div>
                                          <label> Hilang </label>
                                          <div> <input type="text" name="hilang" class=" small" value="<? if(isset($kueri->hilang)){ echo $kueri->hilang; } ?>"  /></div>
                                          <label> Luka Ringan </label>
                                          <div> <input type="text" name="ringan" class=" small" value="<? if(isset($kueri->ringan)){ echo $kueri->ringan; } ?>"  /></div>
                                          <label> Luka Berat </label>
                                          <div> <input type="text" name="berat" class=" small" value="<? if(isset($kueri->berat)){ echo $kueri->berat; } ?>"  /></div>
                                          <label> Pengungsi </label>
                                          <div> <input type="text" name="pengungsi" class=" small" value="<? if(isset($kueri->pengungsi)){ echo $kueri->pengungsi; } ?>"  /></div>
                                          <label> Menderita </label>
                                          <div> <input type="text" name="menderita" class=" small" value="<? if(isset($kueri->menderita)){ echo $kueri->menderita; } ?>"  /></div>
                                          <label> Kerusakan </label>
                                          <div> <input type="text" name="rusak" class=" small" value="<? if(isset($kueri->rusak)){ echo $kueri->rusak; } ?>"  /></div>
                                      </div>                                      
                                      <div class="section last">
                                      <div>
                                        <a class="uibutton submit_form" >Simpan</a><a class="uibutton special"   onClick="ResetForm()" title="Reset  Form"   >Reset Form</a>
                                     </div>
                                     </div>                                     
                                </fieldset>
                                </form>
                                </div>
                              </div>  
                          </div><!--tab1-->                                                                                                      
                  </div>                  
                  <div class="clear"/></div>                  
                  </div>
                  </div>