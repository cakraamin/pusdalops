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
                                <form id="validation" action="<?=base_url()?>fasilitas/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                                                            
                                        <div class="section numericonly">
                                         <label>Luas Tanah</label>                                                                                      
                                          <div>
                                              <input type="text" placeholder="Luas Tanah"  name="luas" id="luas"  class="validate[required] small" value="<? if(isset($kueri->luas_tanah)){ echo $kueri->luas_tanah; } ?>"/>
                                          </div>                                                                                    
                                      </div>
                                      <div class="section numericonly">
                                         <label>Luas Pagar Tanah</label>
                                          <div>
                                              <input type="text" placeholder="Luas Pagar Tanah"  name="pagar" id="pagar"  class="validate[required] small" value="<? if(isset($kueri->pagar_tanah)){ echo $kueri->pagar_tanah; } ?>"/>
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