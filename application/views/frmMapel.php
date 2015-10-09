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
                                <form id="validation" action="<?=base_url()?>mapel/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                      
                                      <?                                      
                                      foreach($kueri as $dt_kueri)
                                      {                                        
                                        ?>
                                        <div class="section numericonly">
                                         <label><?=$this->arey->getJabatan($dt_kueri['nama_mapel'],1)?></label>   
                                         <div>
                                            <input type="text" name="nilai_<?=$dt_kueri['id_detail_mapel']?>" id="nilai_<?=$dt_kueri['id_detail_mapel']?>"  class="small" value="<? if(isset($dt_kueri['nilai'])){ echo $dt_kueri['nilai']; } ?>"/>
                                        </div>
                                          <input type="hidden" name="kode[]" id="jumlah"  class="small" value="<? if(isset($dt_kueri['id_detail_mapel'])){ echo $dt_kueri['id_detail_mapel']; } ?>"/>
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