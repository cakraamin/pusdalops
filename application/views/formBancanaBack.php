<script type="text/javascript">
$( document ).ready(function() {
    $(".clik").click(function(){
      var nilai = $(this).html();
      nilai = nilai.trim();
      var kode = $(this).attr("id")+"-r";
      var valu = $(this).attr("id");
      var inputs = '<input type="text" name="inputs'+valu+'" class="nilais" value="'+nilai+'" id="'+kode+'"/>';
      if($('#'+kode).length == 0){
        $(this).html(inputs);
        $('#'+kode).focus();
      }      
    });
    $(".cliks").click(function(){
      var nilai = $(this).html();
      nilai = nilai.trim();
      var kode = $(this).attr("id")+"-k";
      var valu = $(this).attr("id");
      var inputs = '<input type="text" name="inpute'+valu+'" class="nilaie" value="'+nilai+'" id="'+kode+'"/>';
      if($('#'+kode).length == 0){
        $(this).html(inputs);
        $('#'+kode).focus();
      }      
    });
});
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
                                <form id="validation" action="<?=base_url()?>kebencanaan/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                                                                                             
                                      <div class="section">
                                      <label> Jenis Bencana </label>
                                      <div>
                                              <?                                              
                                              $selektgl = (isset($kueri->id_jenis_bencana))?$kueri->id_jenis_bencana:"";
                                              $jptgl = "data-placeholder='Jenis Bencana...' class='large' onChange='getBencana()' id='jenis'";
                                              echo form_dropdown('jenis', $jenis_ben, $selektgl,$jptgl);                                              
                                              ?> 
                                      </div>                                                                            
                                      </div>    
                                      <div class="section">
                                          <label>Tanggal Kejadian</label>                                          
                                          <div><input type="text" id="datepicker" readonly="readonly" name="tanggal_bencana" value="<? if(isset($kueri->tanggal_bencana)){ echo $kueri->tanggal_bencana; } ?>" /></div>
                                          <label>Waktu Kejadian</label>
                                          <div><input type="text" id="timepicker" readonly="readonly" name="waktu_becana" value="<? if(isset($kueri->waktu_becana)){ echo $kueri->waktu_becana; } ?>" /></div>
                                      </div>                                      
                                      <div class="section">
                                      <label> Lokasi Kebencanaan </label>
                                      <div>
                                              <?
                                              $seleklok = (isset($kueri->id_lokasi))?$kueri->id_lokasi:"";
                                              $jplok = "data-placeholder='Lokasi Kebencanaan...' class='chzn-select'";
                                              echo form_dropdown('lokasi', $lokasi, $seleklok,$jplok);
                                              ?>                                      
                                      </div>
                                      <label> Dusun </label>
                                      <div>                                              
                                              <input type="text" name="dusun_lokasi" class=" medium" value="<? if(isset($kueri->dusun_lokasi)){ echo $kueri->dusun_lokasi; } ?>"  />
                                      </div>
                                      <label> RT </label>
                                      <div>                                              
                                              <input type="text" name="rt_lokasi" class=" small" value="<? if(isset($kueri->rt_lokasi)){ echo $kueri->rt_lokasi; } ?>"  />
                                      </div>
                                      </div>                                        
                                      <div class="section">
                                      <label> Letak Geografis </label>
                                          <div>
                                          <input type="text"  class=" small" name="long" value="<? if(isset($kueri->long_lokasi)){ echo $kueri->long_lokasi; } ?>" />
                                          <span class="f_help">Koordinat Bencana (Long X)</span>
                                          </div>
                                          <div>
                                          <input type="text"  class=" small" name="lat" value="<? if(isset($kueri->lat_lokasi)){ echo $kueri->lat_lokasi; } ?>" />
                                          <span class="f_help">Koordinat Bencana (Lat Y)</span>
                                          </div>
                                      </div>                                        
                                      <div class="section" >
                                          <label> Penyebab </label>   
                                          <div> <input type="text" name="sebab" class=" full" value="<? if(isset($kueri->sebab_bencana)){ echo $kueri->sebab_bencana; } ?>"  /></div>
                                      </div>                                    
                                      <div class="section" >
                                          <label> Deskripsi Bencana </label>   
                                          <div > <textarea name="editor" id="editor"  class="editor"  cols="" rows="1"><? if(isset($kueri->deskripsi_bencana)){ echo $kueri->deskripsi_bencana; } ?></textarea></div> 
                                      </div>
                                      <div class="section" >
                                          <label> Kondisi Cuaca </label>   
                                          <div> <input type="text" name="kondisi" class=" large" value="<? if(isset($kueri->kondisi_bencana)){ echo $kueri->kondisi_bencana; } ?>"  /></div>
                                      </div>
                                      <div class="section" >
                                          <label> Cakupan Bencana </label>   
                                          <div> <input type="text" name="cakup_bencana" class=" large" value="<? if(isset($kueri->cakup_bencana)){ echo $kueri->cakup_bencana; } ?>"  /></div>
                                      </div>
                                      <div class="section" >
                                          <label> Kondisi Cuaca </label>   
                                          <div> <input type="text" name="kondisi" class=" large" value="<? if(isset($kueri->kondisi_bencana)){ echo $kueri->kondisi_bencana; } ?>"  /></div>
                                      </div>
                                      <div class="section" >
                                          <label> Jumlah Korban </label>   
                                          <div>
                                              <table class="cbencana">
                                                <tr class="tengah">
                                                  <td rowspan="2" width="30px" class="judul">NO</td><td rowspan="2" width="130px" class="judul">Korban</td><td colspan="2" class="judul">Anak-anak</td><td colspan="2" class="judul">Dewasa</td><td colspan="2" class="judul">Lansia</td><td colspan="2" class="judul">Ibu Hamil</td>
                                                </tr>
                                                <tr class="tengah">
                                                  <td width="50px" class="judul">L</td><td width="50px" class="judul">P</td><td width="50px" class="judul">L</td><td width="50px" class="judul">P</td><td width="50px" class="judul">L</td><td width="50px" class="judul">P</td><td width="50px" class="judul">P</td>
                                                </tr>
                                                <?                                                
                                                $keterangan = array('Meninggal','Hilang','Luka Berat','Luka Ringan','Pengungsi','Penderita/terdampak');
                                                $no = 1;
                                                $indeks = 1;
                                                foreach($keterangan as $dt_keterangan)
                                                {
                                                  ?>
                                                  <tr>
                                                    <td class="tengah"><?=$no?></td><td class="tulisan"><?=$dt_keterangan?></td>
                                                    <?
                                                    for($i=0;$i<=6;$i++)
                                                    {
                                                      ?><td class="clik" id="<?=$indeks?>">
                                                      <?
                                                      $ide = $indeks."-r";
                                                      $nilai = (isset($detile[$indeks]))?"<input type='text' name='inputs".$indeks."' class='nilais' value='".$detile[$indeks]."' id='".$ide."'/>":"0";
                                                      echo $nilai;
                                                      ?>
                                                      </td><?
                                                      $indeks++;
                                                    }
                                                    ?>
                                                  </tr>
                                                  <?
                                                  $no++;
                                                }
                                                ?>                                                
                                              </table>                                              
                                          </div>                                          
                                      </div>
                                      <div class="section" >
                                          <label> Jumlah Kerugian </label>   
                                          <div>
                                              <table class="cbencana">                                                
                                                <tr class="tengah">
                                                  <td width="30px" class="judul">NO</td><td width="130px" class="judul">Sektor</td><td class="judul">Rusak Berat</td><td class="judul">Rusak Sedang</td><td class="judul">Rusak Ringan</td><td class="judul">Gagal Panen</td>
                                                </tr>
                                                <?                                                
                                                $kerugian = array('Rumah','Fasilitas Pendidikan','Fasilitas Kesehatan','Fasilitas Peribadatan','Kantor','Pasar','Bangunan Lain','Jembatan','Bendungan','Jalan','Sawah','Kebun','Tambak');
                                                $no = 1;
                                                $indeks = 1;
                                                foreach($kerugian as $dt_kerugian)
                                                {
                                                  ?>
                                                  <tr>
                                                    <td class="tengah"><?=$no?></td><td class="tulisan"><?=$dt_kerugian?></td>
                                                    <?
                                                    for($i=0;$i<=3;$i++)
                                                    {
                                                      ?><td class="cliks" id="<?=$indeks?>-r-k">
                                                      <?
                                                      $ide = $indeks."-r-k-k";
                                                      $nilai = (isset($rusake[$indeks]))?"<input type='text' name='inpute".$indeks."-r-k' class='nilaie' value='".$rusake[$indeks]."' id='".$ide."'/>":"0";
                                                      echo $nilai;
                                                      ?>
                                                      </td><?
                                                      $indeks++;
                                                    }
                                                    ?>
                                                  </tr>
                                                  <?
                                                  $no++;
                                                }
                                                ?>                                                
                                              </table>                                              
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