<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>masters/fasilitas" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
                            </ul>      
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                        
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray user"></span><?=$ket?></span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                      
                    <div class="tab_container" >

                          <div id="tab1" class="tab_content"> 
                              <div class="load_page">                        
                                 
                                <div class="formEl_b">  
                                <form id="validation" action="<?=base_url()?>masters/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>
                                      <?
                                      /*$coba = $this->arey->getCoba('1');
                                      echo "<ol>";
                                      foreach($coba as $dt_coba)
                                      {
                                          if(is_array($dt_coba))
                                          {
                                              foreach ($dt_coba as $key => $value) 
                                              {
                                                  if($key == 0)
                                                  {
                                                      echo "<li>".$this->arey->getCobas($value)."</li>";
                                                  }
                                                  else
                                                  {
                                                      echo "<li> - ".$this->arey->getCobas($value)."</li>";
                                                  }                                                  
                                              }
                                          }
                                          else
                                          {
                                              echo "<li>".$this->arey->getCobas($dt_coba)."</li>";
                                          }
                                      }
                                      echo "</ol>";*/
                                      ?>
                                      <div class="section">
                                      <label> Jenis Fasilitas  <small>Jenis</small></label>
                                      <div>
                                              <?                                              
                                              $selekj = (isset($kueri['detil']) AND count($kueri['detil'])>0)?$kueri['detil']:"";
                                              echo form_dropdown('jenis', $jeniss, $selekj);
                                              ?>
                                      <span class="f_help"> Pilih jenjang sekolah. </span> 
                                      </div>                                                                            
                                      </div>
                                      <!--<div class="section">
                                      <label> Kategori Fasilitas  <small>Kategori</small></label>
                                      <div>
                                              <?
                                              $jsk = "  class='chzn-select' multiple ";
                                              $selekk = (isset($kueri['detil']) AND count($kueri['detil'])>0)?$kueri['detil']:"";
                                              echo form_dropdown('kategori[]', $kategori, $selekk,$jsk);
                                              ?>
                                      <span class="f_help"> Pilih jenjang sekolah. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Subs Kategori Fasilitas  <small>Subs Kategori</small></label>
                                      <div>
                                              <?
                                              $jssk = "  class='chzn-select' multiple ";
                                              $seleksk = (isset($kueri['detil']) AND count($kueri['detil'])>0)?$kueri['detil']:"";
                                              echo form_dropdown('subs[]', $subs, $seleksk,$jssk);
                                              ?>
                                      <span class="f_help"> Pilih jenjang sekolah. </span> 
                                      </div>                                                                            
                                      </div>-->
                                      <div class="section">
                                      <label> Nama Fasilitas  <small>Nama</small></label>
                                      <div>
                                      <input type="text"  name="nama" id="nama"  class="validate[required] large" value="<? if(isset($kueri['nama_fasilitas'])){ echo $kueri['nama_fasilitas']; } ?>"/>
                                      <span class="f_help"> Isikan Nama Fasilitas. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Jumlah Minimal  <small>Jumlah</small></label>
                                      <div>
                                      <input type="text"  name="jumlah" id="jumlah"  class="validate[required] medium" value="<? if(isset($kueri['jumlah_min_fasilitas'])){ echo $kueri['jumlah_min_fasilitas']; } ?>"/>
                                      <span class="f_help"> Isikan Jumlah Minimal Fasilitas. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Jenjang Sekolah  <small>Jenjang</small></label>
                                      <div>
                                              <?
                                              $js = "  class='chzn-select' multiple ";
                                              $selek = (isset($kueri['detil']) AND count($kueri['detil'])>0)?$kueri['detil']:"";
                                              echo form_dropdown('jenjang[]', $jenjang, $selek,$js);
                                              ?>
                                      <span class="f_help"> Pilih jenjang sekolah. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Penggunaan <small>Penggunaan</small></label>
                                      <div>
                                      <div>
                                          <? $selekk = (isset($kueri['jum_penggunaan']) && $kueri['jum_penggunaan'] == 1)?'checked="checked"':''; ?>
                                          <input type="checkbox" name="penggunaan" id="checkNormal"  value="1" class="ck" <?=$selekk?>/>
                                          <label for="checkNormal">Penggunaan</label>
                                      </div>
                                      <span class="f_help"> Centang Bila Membutuhkan. </span> 
                                      </div>                                                                            
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