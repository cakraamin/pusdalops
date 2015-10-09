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
                                <form id="validation" action="<?=base_url()?>kuesioner/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                      
                                      <?                                           
                                      foreach($kueri as $dt_kueri)
                                      {
                                        if($dt_kueri['option'] == 1)
                                        {
                                            $value = $dt_kueri['value'];
                                            $val = (isset($dt_kueri['value']))?$dt_kueri['value']:"";
                                        }
                                        else
                                        {
                                            $selek = (isset($dt_kueri['value']) OR $dt_kueri['value'] > 0)?"checked='checked'":"";
                                            $selek1 = (isset($dt_kueri['value']) OR $dt_kueri['value'] > 0)?"":"checked='checked'";
                                            $val = "";
                                        }                                        
                                        ?>
                                        <br/><label><?=$dt_kueri['text_ket_kuesioner']?></label>
                                        <div class="section numericonly">                                         
                                         <div>
                                              <?
                                              if($dt_kueri['jawaban'] == 2)
                                              {
                                                $opt = 1;
                                                ?><input type="text" name="cek_<?=$dt_kueri['id_detail_kuesioner']?>" id="cek_<?=$dt_kueri['id_detail_kuesioner']?>"  class="small" value="<?=$val?>"/><?
                                              }
                                              else
                                              {
                                                $opt = 2;
                                                ?>
                                                <div>
                                                    <input type="radio" name="cek_<?=$dt_kueri['id_detail_kuesioner']?>" id="radio-1-<?=$dt_kueri['id_detail_kuesioner']?>" value="1"  class="ck" <?=$selek?>/>
                                                    <label for="radio-1-<?=$dt_kueri['id_detail_kuesioner']?>">Ada</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="cek_<?=$dt_kueri['id_detail_kuesioner']?>" id="radio-2-<?=$dt_kueri['id_detail_kuesioner']?>" value="0"  class="ck" <?=$selek1?>/>
                                                    <label for="radio-2-<?=$dt_kueri['id_detail_kuesioner']?>" >Tidak ada</label>
                                                </div>
                                                <?
                                              }
                                              ?>                                              
                                              <input type="hidden" name="input_<?=$dt_kueri['id_detail_kuesioner']?>" id="input_<?=$dt_kueri['id_detail_kuesioner']?>"  class="small" value="<?=$opt?>"/>
                                          </div>
                                          <input type="hidden" name="kode[]" id="jumlah"  class="small" value="<? if(isset($dt_kueri['id_detail_kuesioner'])){ echo $dt_kueri['id_detail_kuesioner']; } ?>"/>
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