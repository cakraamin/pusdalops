<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>masters/kuesioner" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
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
                                      <label> Tingkat Kelas  <small>Tingkat</small></label>
                                      <div>
                                              <?
                                              $jst = "class='small'";
                                              $selekt = (isset($kueri['id_tingkat']) AND count($kueri['id_tingkat'])>0)?$kueri['id_tingkat']:"";
                                              echo form_dropdown('tingkat', $tingkat, $selekt,$jst);
                                              ?>
                                      <span class="f_help"> Pilih tingkat kelas. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Nilai Awal  <small>Awal</small></label>
                                      <div>
                                      <input type="text"  name="awal" id="awal"  class="medium" value="<? if(isset($kueri['batas_awal'])){ echo $kueri['batas_awal']; } ?>"/>
                                      <span class="f_help"> Isikan Nilai awal. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Operasi  <small>Operasi</small></label>
                                      <div>
                                              <?
                                              $jso = "class='medium'";
                                              $seleko = (isset($kueri['operasi_umur']) AND count($kueri['operasi_umur'])>0)?$kueri['operasi_umur']:"";
                                              echo form_dropdown('operasi', $operasi, $seleko,$jso);
                                              ?>
                                      <span class="f_help"> Pilih Operasi Umur. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Nilai Akhir  <small>Akhir</small></label>
                                      <div>
                                      <input type="text"  name="akhir" id="akhir"  class="medium" value="<? if(isset($kueri['batas_akhir'])){ echo $kueri['batas_akhir']; } ?>"/>
                                      <span class="f_help"> Isikan Nilai akhir. </span> 
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