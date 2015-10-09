<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>masters/prodi" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
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
                                      <label> Nama Program Studi  <small>Nama</small></label>
                                      <div>
                                      <input type="text"  name="nama" id="nama"  class="medium" value="<? if(isset($kueri['nama_prodi'])){ echo $kueri['nama_prodi']; } ?>"/>
                                      <span class="f_help"> Isikan Nama Program Studi. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Kode Program Studi  <small>Kode</small></label>
                                      <div>
                                      <input type="text"  name="kode" id="kode"  class="medium" value="<? if(isset($kueri['kode_prodi'])){ echo $kueri['kode_prodi']; } ?>"/>
                                      <span class="f_help"> Isikan Kode Mata Pelajaran. </span> 
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