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
                                      <?                                           
                                      $no = 0;                                        
                                      foreach($kueri as $dt_kueri)
                                      {
                                        $indeks = 0;                                    
                                        $no++;                   
                                        ?>
                                        <div class="section">
                                         <label><u><?=$dt_kueri['nama_fasilitas']?></u></label>
                                          <?                                          
                                          $kolom = $this->arey->getCoba($id);                                                                      
                                          if(is_array($kolom))
                                          {
                                            echo "<br/><br/>";
                                            foreach ($kolom as $dt_kolom) 
                                            {                                              
                                                if(is_array($dt_kolom))
                                                {
                                                    if(array_key_exists("0", $dt_kolom))
                                                    {
                                                        foreach ($dt_kolom as $key => $value) 
                                                        {
                                                            if(is_array($value))
                                                            {
                                                              foreach ($value as $key => $val) 
                                                              {
                                                                if($key == 0)
                                                                {
                                                                    echo "<label>".$this->arey->getCobas($val)."</label>";
                                                                    ?><div></div><br/><br/><?
                                                                }
                                                                else
                                                                {
                                                                    $indeks++;
                                                                    echo "<label>&nbsp;&nbsp;&nbsp;&nbsp;".$this->arey->getCobas($val)."</label>";                                                            
                                                                    ?><div><input type="text" name="jumlah<?=$no?>[]" id="jumlah"  class="small" value="<? if(isset($dt_kueri['detil'][$indeks])){ echo $dt_kueri['detil'][$indeks]; } ?>"/></div><?
                                                                }
                                                              }
                                                            }
                                                            else
                                                            {
                                                              if($key == 0)
                                                              {
                                                                  echo "<label>".$this->arey->getCobas($value)."</label>";
                                                                  ?><div></div><br/><br/><?
                                                              }
                                                              else
                                                              {
                                                                  $indeks++;
                                                                  echo "<label>&nbsp;&nbsp;&nbsp;&nbsp;".$this->arey->getCobas($value)."</label>";                                                            
                                                                  ?><div><input type="text" name="jumlah<?=$no?>[]" id="jumlah"  class="small" value="<? if(isset($dt_kueri['detil'][$indeks])){ echo $dt_kueri['detil'][$indeks]; } ?>"/></div><?
                                                              }
                                                            }                                                          
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    $indeks++;
                                                    echo "<label>".$this->arey->getCobas($dt_kolom)."</label>";                                                    
                                                    ?><div><input type="text" name="jumlah<?=$no?>[]" id="jumlah"  class="small"  value="<? if(isset($dt_kueri['detil'][$indeks])){ echo $dt_kueri['detil'][$indeks]; } ?>"/></div><?
                                                }
                                            }
                                          }
                                          else
                                          {  
                                            $indeks++;                                                                                                
                                            ?><div><input type="text" name="jumlah<?=$no?>[]" id="jumlah"  class="small" value="<? if(isset($dt_kueri['detil'][$indeks])){ echo $dt_kueri['detil'][$indeks]; } ?>"/></div><?
                                          }
                                          ?>                                         
                                          <div>
                                        </div>
                                        </div>
                                        <input type="hidden" name="kode<?=$no?>" id="jumlah"  class="small" value="<? if(isset($dt_kueri['id_detail_fasilitas'])){ echo $dt_kueri['id_detail_fasilitas']; } ?>"/>
                                        <?
                                      }
                                      ?>           
                                      <input type="hidden" name="nilai" id="nilai"  class="small" value="<?=$no?>"/>
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