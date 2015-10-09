<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>masters/mapel" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
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
                                      <label> Nama Mapel  <small>Nama</small></label>
                                      <div>
                                      <!--<input type="text"  name="nama" id="nama"  class="medium" value="<? if(isset($kueri['nama_mapel'])){ echo $kueri['nama_mapel']; } ?>"/>-->
                                              <? 
                                              $jsm = "  class=' large'";                                            
                                              $selekm = (isset($kueri['nama_mapel']) AND count($kueri['detil'])>0)?$kueri['nama_mapel']:"";
                                              echo form_dropdown('nama', $mapel, $selekm,$jsm);
                                              ?>
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