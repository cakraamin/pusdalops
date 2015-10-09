<div class="topcolumn">
            <div class="logo"></div>
                            &nbsp;     
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                        
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray spreadsheet"></span>Rekap Laporan</span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                      
                    <div id="wizard" class="swMain">
        <ul>
          <li><a href="#step-1">
                <label class="stepNumber">1</label>
                <span class="stepDesc">Step 1<br />
                   <small>Jenis Report</small>
                </span>
            </a></li>
          <li><a href="#step-2">
                <label class="stepNumber">2</label>
                <span class="stepDesc">Step 2<br />
                   <small>Generate Report</small>
                </span>
            </a></li>            
        </ul>
        <div id="step-1">
          <div class="load_page">                                                         
          <p>
      <form method="POST" action="action.php">
                                    <div class="section last">
                                    <label>Tanggal Abasensi <small>Pilih Tanggal</small></label>   
                                    <div>
                                    <input type="text"  id="birthday" class=" birthday  medium " name="birthday"  />
                                    <span class="f_help">Seilahkan diisikan dengan tanggal absensi yang diinginkan</span> 
                                    </div>                                    
                  </div>
                  <div class="section last">
                                    <label>Jenis Laporan <small>Pilih Salah Satu</small></label>   
                                    <div>
                                    <?=form_dropdown('skpd', $skpd, 'large');?>
                                    <span class="f_help">Silahkan dipilih nama SKPD yang diinginkan</span> 
                                    </div>                                   
                  </div>
                  </form>

            </p>
                              </div>
      </div>
        <div id="step-2">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      <form>
                  <div class="section ">
                                    <label> Full name<small>Text custom</small></label>   
                                    <div> 
                                    <input type="text" class="validate[required] large" name="f_required" id="f_required">
                                    </div>
                                    </div>
                  
                  <div class="section ">
                                    <label>gender<small>Text custom</small></label>   
                                    <div> 
                                      <div>
                                          <input type="radio" name="opinions" id="radio-1" value="1"  class="ck"/>
                                          <label for="radio-1">Male</label>
                                      </div>
                                      <div>
                                          <input type="radio" name="opinions" id="radio-2" value="1"  class="ck"  checked="checked"/>
                                          <label for="radio-2" >Female</label>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="section last">
                                    <label> Email<small>Text custom</small></label>   
                                    <div> 
                                    <input type="text" class="validate[required,custom[email]]  large" name="e_required" id="e_required">
                                    </div>
                                    </div>
                  </form>
            </p>              
      </div>                                  
      </div>
      <div class="clear"></div>                  
                  </div>
                  </div>