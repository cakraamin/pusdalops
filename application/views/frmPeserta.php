<div class="topcolumn">
            <div class="logo"></div>                                
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
                                <form id="validation" action="<?=base_url()?>peserta/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                      
                                      <?                                      
                                      foreach($kueri as $dt_kueri)
                                      {                                        
                                        ?>
                                        <div class="section">
                                         <label>Program Studi <?=$dt_kueri['nama_prodi']?></label>   
                                         <div>
                                            <input type="text" name="peserta_<?=$dt_kueri['id_detail_prodi']?>" id="peserta_<?=$dt_kueri['id_detail_prodi']?>"  class="small" value="<? if(isset($dt_kueri['peserta'])){ echo $dt_kueri['peserta']; } ?>" placeholder="Jumlah Peserta"/>
                                        </div>
                                        <div>                                      
                                            <input type="text" name="lulus_<?=$dt_kueri['id_detail_prodi']?>" id="lulus_<?=$dt_kueri['id_detail_prodi']?>"  class="small" value="<? if(isset($dt_kueri['lulus'])){ echo $dt_kueri['lulus']; } ?>" placeholder="Jumlah Lulus"/>
                                        </div>
                                          <input type="hidden" name="kode[]" id="jumlah"  class="small" value="<? if(isset($dt_kueri['id_detail_prodi'])){ echo $dt_kueri['id_detail_prodi']; } ?>"/>
                                      </div>                                                                             
                                        <?
                                      }
                                      ?>                                      
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