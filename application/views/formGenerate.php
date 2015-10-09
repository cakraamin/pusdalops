<script type="text/javascript">
function waktus(){
  var nilai = $('#waktune').val();
  if(nilai == 1){
    $('#thn').show();
    $('#bln').hide();
    $('#dtl').hide();
  }else if(nilai == 2){
    $('#thn').show();
    $('#bln').show();
    $('#dtl').hide();
  }else{
    $('#thn').hide();
    $('#bln').hide();
    $('#dtl').show();
  }
}
function jeniss(){
  var nilai = $('#jenise').val();
  if(nilai == 1){
    $('.waktuo').show();
    $('#jenisa').hide();
    $('#lokasine').hide();
  }else if(nilai == 2){
    $('.waktuo').hide();
    $('#jenisa').show();
    $('#lokasine').hide();
  }else if(nilai == 3){
    $('.waktuo').hide();
    $('#jenisa').hide();
    $('#lokasine').show();
  }else{
    $('.waktuo').show();
    $('#jenisa').show();
    $('#lokasine').show();
    $('#bln').hide();
    $('#dtl').hide();
  }
}
</script>
<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>kebencanaan/daftar" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
                            </ul>     
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
                                <form id="validation" action="<?=base_url()?>laporan/<?=$link?>" method="POST" enctype="multipart/form-data"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                                                                                             
                                      <div class="section">
                                      <label> Jenis Laporan </label>
                                      <div>
                                              <?                                    
                                              $jpjen = " onChange='jeniss()' id='jenise' ";                                                        
                                              echo form_dropdown('laporan', $jlaporan, '', $jpjen);
                                              ?> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section" style="display:none" id="jenisa">
                                      <label> Jenis Bencana </label>
                                      <div>
                                              <?                                                                                            
                                              echo form_dropdown('jenis', $jenis_ben);
                                              ?> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section" style="display:none" id="lokasine">
                                      <label> Lokasi Bencana </label>
                                      <div>
                                              <?                                                                                            
                                              $jplok = "data-placeholder='Lokasi Kebencanaan...' class='chzn-select'";
                                              echo form_dropdown('lokasi', $lokasi, '',$jplok);
                                              ?> 
                                      </div>                                                                            
                                      </div>                                      
                                      <div class="section waktuo">
                                      <label> Waktu Bencana </label>
                                      <div>
                                              <?
                                              $jpwak = " onChange='waktus()' id='waktune' ";
                                              echo form_dropdown('waktu', $waktu, '',$jpwak);
                                              ?> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section waktuo" id="thn">
                                      <label> Tahun </label>
                                      <div>
                                              <?                                                                                                                                          
                                              echo form_dropdown('tahun', $tahun);
                                              ?> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section waktuo" id="bln" style="display:none;">
                                      <label> Bulan </label>
                                      <div>
                                              <?                                                                                                                                          
                                              echo form_dropdown('bulan', $bulan);
                                              ?> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section waktuo" id="dtl" style="display:none;">
                                      <label> Tanggal </label>
                                      <div>
                                              <input type="text"  id="datepick" class="datepicker" readonly="readonly" name="tanggal"/>
                                      </div>                                                                            
                                      </div>
                                      <div class="section last">
                                      <div>
                                        <a class="uibutton submit_form" >Generate</a>
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