<div class="topcolumn">
            <div class="logo"></div>
                            &nbsp;     
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                  <?=$this->message->display();?>
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray spreadsheet"></span>Rekap Laporan</span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                                          
                              <div class="load_page">                        
                                 
                                <div class="formEl_b">  
                                <form id="validation" action="<?=base_url()?>laporan/submit_rekap" method="POST"> 
                                <fieldset >
                                <legend>Rekap <span class="small s_color">( laporan )</span></legend>                                                                                                             
                                      <div class="section">
                                          <label>Tanggal Mulai <small>Pilih Tanggal</small></label>   
                                          <div><input type="text"  id="birthday" class=" birthday  small " name="awal"  /></div>
                                      </div> 
                                      <div class="section">
                                          <label>Tanggal Akhir <small>Pilih Tanggal</small></label>   
                                          <div><input type="text"  id="birthdays" class=" birthday  small " name="akhir"  /></div>
                                      </div>                   
                                       <div class="section">                                            
                                            <label>Jenis Laporan <small>Pilih Salah Satu</small></label>   
                                            <div>
                                            <?=form_dropdown('skpd', $skpd, 'large');?>                                                        
                                      </div>
                                      </div>
                                      <div class="section">                                            
                                            <label>Jenis Tampilan <small>Pilih Salah Satu</small></label>   
                                            <div>
                                            <select name="jenis">
                                                <option value="prev">Preview</option>
                                                <option value="xls">Excel</option>
                                            </select>
                                      </div>
                                      </div>
                                      <div class="section last">
                                      <div>
                                        <a class="uibutton submit_form" >Generate Report</a>
                                     </div>
                                     </div>
                                </fieldset>
                                </form>
                                </div>                                                                                                                                  
                  </div>                  
                  <div class="clear"/></div>                  
                  </div>
                  </div>