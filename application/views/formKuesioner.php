<script type="text/javascript">
$( document ).ready(function() {
    $( "#jumPembilang" ).change(function() {
      $('#detail_pembilang').html('');
      var isi = $(this).val();
      for (var i=1;i<=isi;i++){ 
        var hasil = '';
        var pilih = $('#checkNormal').attr( "checked" );
        var j = i-1;
        hasil += '<label> Pembilang '+i+' </label><div ><textarea name="keterangan[]" cols="50" rows="2"></textarea><input type="hidden" name="stat'+j+'" value="1"/>';
        if(isi == i && pilih == 'checked'){
            hasil += '<input type="hidden" name="stat'+i+'" value="2"/>';
        }
        hasil += '</div>';
        $('#detail_pembilang').append(hasil);
      }
    });
    $( ".plh" ).change(function() {
      var isi = $(this).val();
      if(isi == 2){
        $('#kets').html('<input type="text"  name="keter" id="keter"  class=" medium"/>');
      }else{
        $('#kets').html('');
      }
    });
    $( "#checkNormal" ).change(function() {
      var isi = $(this).attr( "checked" );
      if(isi == 'checked'){
        $('#penyebuts').show();
      }else{
        $('#penyebuts').hide();
      }
    });
});
</script>
<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>masters/kuesioner" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
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
                                      <label> Jenis Kuesioner  <small>Jenis</small></label>
                                      <div>
                                              <?                                            
                                              $seleks = (isset($kueri['detil']) AND count($kueri['detil'])>0)?$kueri['detil']:"";
                                              echo form_dropdown('jenis', $jeniss, $seleks);
                                              ?>
                                      <span class="f_help"> Pilih jenjang sekolah. </span> 
                                      </div>                                                                            
                                      </div>
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
                                           <label> Kuesioner  <small>Teks Kuesioner</small></label>   
                                          <div > <textarea name="kuesioner" cols="50" rows="2">
                                            <?
                                            if(isset($kueri['text_kuesioner'])){ echo $kueri['text_kuesioner']; }
                                            ?>
                                          </textarea></div>
                                       </div>
                                      <div class="section">
                                        <label> Pembilang Kuesioner  <small>Pembilang</small></label>   
                                        <div >
                                              <?      
                                              $jp = 'class="small" id="jumPembilang"';
                                              $selekp = (isset($kueri['detil']) AND count($kueri['detil'])>0)?$kueri['detil']:"";
                                              echo form_dropdown('pembilang', $pembilang, $selekp,$jp);
                                              ?>
                                        </div>
                                        <div id="detail_pembilang"></div>
                                      </div>
                                      <div class="section">
                                        <label> Penyebut  </label>   
                                        <div>
                                          <input id="checkNormal" class="ck" type="checkbox" value="1" name="pilihan" checked="checked">
                                          <label class="checker" for="checkNormal">Gunakan</label>                                          
                                        </div>                                                                                                                    
                                      </div>
                                      <div class="section" id="penyebuts">
                                        <label> Penyebut Kuesioner  <small>Penyebut</small></label>   
                                        <div >
                                              <textarea name="keterangan[]" cols="50" rows="2">
                                                <?
                                                if(isset($kueri['text_kuesioner'])){ echo $kueri['text_kuesioner']; }
                                                ?>
                                              </textarea>
                                        </div>                                        
                                        <label> Pilihan Penyebut  </label>   
                                          <div>
                                              <input type="radio" name="provider" id="radiop-1" value="1"  class="ck plh" checked="checked"/>
                                              <label for="radiop-1">Jumlah Sekolah</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="provider" id="radiop-2" value="2"  class="ck plh"/>
                                              <label for="radiop-2" >Lainnya</label>
                                          </div>  
                                          <div id="kets">                                              
                                          </div>                                            
                                      </div>
                                      <div class="section">                                      
                                        <label> Pilihan Jawab  </label>   
                                          <div>
                                              <input type="radio" name="jawaban" id="jawaban-1" value="1"  class="ck" checked="checked"/>
                                              <label for="jawaban-1">Ya dan Tidak</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="jawaban" id="jawaban-2" value="2"  class="ck"/>
                                              <label for="jawaban-2" >Kolom Jumlah</label>
                                          </div>  
                                          <div id="kets">                                              
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