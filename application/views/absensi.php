<div class="topcolumn">
            <div class="logo"></div>
                            &nbsp;     
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>    
                    <?=$this->message->display();?>
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray stats_bars"></span>Perijinan Absensi</span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                                          
                    <div class="load_page">                        
                                 
                                <div class="formEl_b">  
                                <form id="validation" action="<?=base_url()?>perijinan/submit_absensi" method="POST"> 
                                <fieldset >
                                <legend>Perijinan <span class="small s_color">( Absensi )</span></legend>                                                                                                             
                                      <div class="section">
                                          <label>Scanning <small>Pilih Jenis</small></label>   
                                          <div>
                                            <?
                                              $jt = 'class="jenis"';
                                              echo form_dropdown('jenis', $absen, '',$jt);
                                              ?>
                                          </div>
                                      </div>                   
                                      <div class="section">                                            
                                            <label>Nama Pegawai <small>Pilih Satu/Beberapa</small></label>   
                                            <div>
                                            <?
                                              $js = 'class="chzn-select " multiple tabindex="4"';
                                              echo form_dropdown('nama[]', $pegawai, '',$js);
                                              ?>
                                      </div>
                                      </div>
                                      <div class="section">
                                          <label>Tanggal Mulai <small>Pilih Tanggal</small></label>   
                                          <div><input type="text"  id="birthday" class=" birthday  small " name="awal"  /></div>
                                      </div> 
                                      <div class="section">
                                          <label>Tanggal Akhir <small>Pilih Tanggal</small></label>   
                                          <div><input type="text"  id="birthdays" class=" birthday  small " name="akhir"  /></div>
                                      </div>  
                                      <div class="section">                                            
                                            <label>Alasan <small>Diisikan alasan scanning</small></label>   
                                            <div>
                                            <textarea name="alasan" cols="40" rows="5"></textarea>
                                      </div>
                                      </div>
                                      <div class="section last">
                                      <div>
                                        <a class="uibutton submit_form" >Absensi</a>
                                     </div>
                                     </div>                                     
                                </fieldset>
                                </form>
                                </div>        
                  <div class="clear"/></div>                  
                  </div>
                  </div>