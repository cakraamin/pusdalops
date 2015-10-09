<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
//google maps GIS 1.1.b by desrizal
//dibuat tanggal 8 Jan 2011
var peta;
var pertama = 0;
//var jenis = "restoran";
var judulx = new Array();
var desx = new Array();
var i;
var url;
var gambar_tanda;
function peta_awal(){
    var rembang = new google.maps.LatLng(-6.708609147163017, 111.33379555307329);
    var petaoption = {
        zoom: 14,
        center: rembang,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        };
    peta = new google.maps.Map(document.getElementById("petakun"),petaoption);
    google.maps.event.addListener(peta,'click',function(event){
        kasihtanda(event.latLng);
    });
    ambildatabase('<?=$this->session->userdata("id_school");?>');
}
function kasihtanda(lokasi){
    //set_icon(jenis);
    tanda = new google.maps.Marker({
            position: lokasi,
            map: peta,
            icon: gambar_tanda
    });
    $("#lintang").val(lokasi.lat());
    $("#bujur").val(lokasi.lng());
}
function set_icon(jenisnya){
    switch(jenisnya){
        case "restoran":
            gambar_tanda = '<?=base_url()?>assets/template/fingers/images/icon/peta/embassy.png';
            break;
        case "airport":
            gambar_tanda = '<?=base_url()?>assets/template/fingers/images/icon/peta/embassy.png';
            break;
        case  "sekolah":
            gambar_tanda = '<?=base_url()?>assets/template/fingers/images/icon/peta/embassy.png';
            break;
    }
}

function setjenis(jns){
    jenis = jns;
}

function setinfo(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {
        $("#jendelainfo").fadeIn();
        $("#teksjudul").html(judulx[nomor]);
        $("#teksdes").html(desx[nomor]);
    });
}

function ambildatabase(id){
    $.ajax({
        url: site+"peta/getPeta",
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                judulx[i] = msg.wilayah.petak[i].judul;
                desx[i] = msg.wilayah.petak[i].deskripsi;

                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: gambar_tanda
                });
                setinfo(tanda,i);

            }
        }
    });
}
$(document).ready(function(){
   peta_awal();
});
</script>
<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>masters/kecamatan" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
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
                                <form id="validation" action="<?=base_url()?>sekolah/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                                                                                                                                                                                                                                                                                            
                                      <div>
                                          <div>
                                              <input type="radio" name="opinion" id="radios-1" value="1"  class="ck" checked="checked"/>
                                              <label for="radios-1">Kabupaten</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="opinion" id="radios-2" value="1"  class="ck"/>
                                              <label for="radios-2" >Kota</label>
                                          </div>                                          
                                      </div>
                                      <label> Kode POS  <small>Kode POS</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan Kode POS Sekolah. </span> 
                                      </div> 
                                      <label> Kode Area / No.Telp  <small>Kode</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan Kode Area / No. Telp Sekolah. </span> 
                                      </div> 
                                      <label> Kode Area / No. Fax  <small>Kode</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan Kode Area / No. Fax Sekolah. </span> 
                                      </div> 
                                      <label> Internet </label>
                                      <div>
                                          <div>
                                              <input type="radio" name="internet" id="radioi-1" value="1"  class="ck" checked="checked"/>
                                              <label for="radioi-1">Ada</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="internet" id="radioi-2" value="1"  class="ck"/>
                                              <label for="radioi-2" >Tidak Ada</label>
                                          </div>                                          
                                      </div>
                                      <label> Provider </label>
                                      <div>
                                          <div>
                                              <input type="radio" name="provider" id="radiop-1" value="1"  class="ck" checked="checked"/>
                                              <label for="radiop-1">Ada</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="provider" id="radiop-2" value="1"  class="ck"/>
                                              <label for="radiop-2" >Tidak Ada</label>
                                          </div>                                          
                                      </div>
                                      <label> E-mail  <small>E-mail</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan E-mail Sekolah. </span> 
                                      </div> 
                                      <label> Website  <small>Website</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan Website Sekolah. </span> 
                                      </div> 
                                      <label> Jarak Sekolah Sejenis  <small>Jarak</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan Jarak Sekolah Sejenis. </span> 
                                      </div> 
                                      </div>                                      
                                      <div class="section">
                                      <label> Tahun Dibuka  <small>Tahun Dibuka</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan Tahun Dibuka. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Tahun Tarakhir Sekolah Direnovasi  <small>Tahun Terakhir Renovasi</small></label>
                                      <div>
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan Tahun Terakhir Direnovasi. </span> 
                                      </div>
                                      </div>
                                      <div class="section">
                                      <label> Status Sekolah  <small>Status</small></label>
                                      <div>
                                              <?
                                              $seleks = (isset($kueri->status_school))?$kueri->status_school:"";
                                              $jps = "data-placeholder='Status Sekolah...' class='chzn-select'";
                                              echo form_dropdown('status', $status, $seleks,$jps);
                                              ?>
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Akreditasi Sekolah  <small>Akreditasi</small></label>
                                      <div>
                                              <?
                                              $seleka = (isset($kueri->status_school))?$kueri->status_school:"";
                                              $jpa = "";
                                              echo form_dropdown('akreditasi', $akreditasi, $seleka,$jpa);
                                              ?>
                                      </div>    
                                      <label> SK Akreditas Terakhir  <small>SK Akreditas</small></label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>  <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan SK Akreditasi Terakhir. </span> 
                                      </div>                                                                        
                                      </div>                                                                          
                                      <div class="section">
                                      <label> Status Mutu Sekolah  <small>Status Mutu</small></label>
                                      <div>
                                          <div>
                                              <input type="radio" name="status" id="status-1" value="1"  class="ck" checked="checked"/>
                                              <label for="status-1">SPM</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="status-2" value="1"  class="ck"/>
                                              <label for="status-2" >Pra SSN</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="status-3" value="1"  class="ck"/>
                                              <label for="status-3" >SSN</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="status-4" value="1"  class="ck"/>
                                              <label for="status-4" >RSBI</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="status-5" value="1"  class="ck"/>
                                              <label for="status-5" >SBI</label>
                                          </div>
                                      </div>
                                      </div>
                                      <div class="section">
                                      <label> Kategori Sekolah(Khusus SMP)  <small>Kategori Sekolah</small></label>
                                      <div>
                                          <div>
                                              <input type="radio" name="status" id="kategori-1" value="1"  class="ck" checked="checked"/>
                                              <label for="kategori-1">SMP 1 Atap</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="kategori-2" value="1"  class="ck"/>
                                              <label for="kategori-2" >Biasa</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="kategori-3" value="1"  class="ck"/>
                                              <label for="kategori-3" >Terbuka</label>
                                          </div>                                          
                                      </div>
                                      </div> 
                                      <div class="section">
                                      <label> Waktu Penyelenggaraan  <small>Waktu</small></label>
                                      <div>
                                          <div>
                                              <input type="radio" name="status" id="waktu-1" value="1"  class="ck" checked="checked"/>
                                              <label for="waktu-1">Pagi</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="waktu-2" value="1"  class="ck"/>
                                              <label for="waktu-2" >Siang</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="waktu-3" value="1"  class="ck"/>
                                              <label for="waktu-3" >Kombinasi</label>
                                          </div>                                          
                                      </div>
                                      </div>                                                                                   
                                      <div class="section">
                                      <label> Tempat Penyelenggaraan Praktik(Khusus SMK)  <small>Tempat Penyelenggarann</small></label>
                                      <div>
                                          <div>
                                              <input type="radio" name="status" id="praktek-1" value="1"  class="ck" checked="checked"/>
                                              <label for="praktek-1">Sekolah Sendiri</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="praktek-2" value="1"  class="ck"/>
                                              <label for="praktek-2" >Tempat Lain, sebutkan</label>                                              
                                              <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                          </div>                                                                                    
                                      </div>
                                      </div>          
                                      <div class="section">
                                      <label> Tempat Pelaksanaan Praktik Kerja Industri(Khusus SMK)  <small>Pelaksanaan Prakerin</small></label>
                                      <div>
                                          <div>
                                              <input type="radio" name="status" id="prakterin-1" value="1"  class="ck" checked="checked"/>
                                              <label for="prakterin-1">Lembaga Pemerintah</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="prakterin-2" value="1"  class="ck"/>
                                              <label for="prakterin-2" >Gabungan</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="prakterin-3" value="1"  class="ck"/>
                                              <label for="prakterin-3" >Lembaga</label>
                                          </div>                                          
                                          <div>
                                              <input type="radio" name="status" id="prakterin-4" value="1"  class="ck"/>
                                              <label for="prakterin-4" >Tidak Ada</label>
                                          </div>                                          
                                      </div>
                                      <label> Jumlah </label>
                                      <div>
                                          <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      </div>                                      
                                      </div>     
                                      <div class="section">                                      
                                      <label>a. SK Akreditas Terakhir  <small>SK Akreditas</small></label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>  <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan SK Akreditasi Terakhir. </span> 
                                      </div>
                                      <label>a. SK Akreditas Terakhir  <small>SK Akreditas</small></label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>  <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan SK Akreditasi Terakhir. </span> 
                                      </div>
                                      <label>b. Keterangan SK  </label>
                                      <div>
                                          <div>
                                              <input type="radio" name="status" id="keterangan-1" value="1"  class="ck" checked="checked"/>
                                              <label for="keterangan-1">Pemutihan</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="keterangan-2" value="1"  class="ck"/>
                                              <label for="keterangan-2" >Penegerian</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="keterangan-3" value="1"  class="ck"/>
                                              <label for="keterangan-3" >Alih Fungsi</label>
                                          </div>                                          
                                          <div>
                                              <input type="radio" name="status" id="keterangan-4" value="1"  class="ck"/>
                                              <label for="keterangan-4" >Sekolah Baru</label>
                                          </div> 
                                          <div>
                                              <input type="radio" name="status" id="keterangan-5" value="1"  class="ck"/>
                                              <label for="keterangan-5" >Perubahan Nama</label>
                                          </div>                                          
                                      </div>
                                      </div>   
                                      <div class="section">                                                                          
                                      <label>a. Apakah sekolah ini mengadakan sekolah inklusi  </label>
                                      <div>
                                          <div>
                                              <input type="radio" name="status" id="inklusi-1" value="1"  class="ck" checked="checked"/>
                                              <label for="inklusi-1">Ya</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="status" id="inklusi-2" value="1"  class="ck"/>
                                              <label for="inklusi-2" >Tidak</label>
                                          </div>                                                                                  
                                      </div>                                      
                                      <label>b. SK Akreditas Terakhir  <small>SK Akreditas</small></label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>  <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan SK Akreditasi Terakhir. </span> 
                                      </div>
                                      </div>           
                                      <div class="section">
                                      <label> Apakah sekolah ini menyelenggarakan program C/BI?  <small>Program C/BI</small></label>
                                      <div>
                                          <div>
                                              <input type="radio" name="program" id="program-1" value="1"  class="ck" checked="checked"/>
                                              <label for="program-1">Ya</label>
                                          </div>
                                          <div>
                                              <input type="radio" name="program" id="program-2" value="1"  class="ck"/>
                                              <label for="program-2" >Tidak</label>
                                          </div>                                          
                                      </div>                                                                                            
                                      </div> 
                                      <div class="section">
                                      <label>Sebelum SK pada butir 12</label><br/><br/>
                                      <label> Nomor Statistik Sekolah</label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      </div>
                                      <label> Nama Sekolah</label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      </div>
                                      <label> Status Sekolah</label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      </div>
                                      <label> Alamat Sekolah</label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      </div>
                                      <label> Kecamatan</label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      </div>
                                      </div>      
                                      <div class="section">                                                                                                                                                    
                                      <label>SK/Ijin Pendirian Sekolah dari Kanwil Depdiknas Diknas Pendidikan</label>
                                      <div>                                    
                                      <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>  <input type="text"  name="npsn" id="npsn"  class="validate[required] medium" value="<? if(isset($kueri->npsn_school)){ echo $kueri->npsn_school; } ?>"/>
                                      <span class="f_help"> Isikan SK Akreditasi Terakhir. </span> 
                                      </div>
                                      </div>                                                                                                                       
                                      <div class="section">
                                      <label>&nbsp;</label>
                                      <div>
                                      <div id="petakun" style="width:400px; height:300px"></div>
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Titik Lintang  <small>Lintang</small></label>
                                      <div>
                                      <input type="text"  name="lintang" id="lintang"  class="validate[required] medium" value="<? if(isset($kueri->lintang_school)){ echo $kueri->lintang_school; } ?>"/>
                                      <span class="f_help"> Isikan Titik Lintang Sekolah. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Titik Bujur  <small>Bujur</small></label>
                                      <div>
                                      <input type="text"  name="bujur" id="bujur"  class="validate[required] medium" value="<? if(isset($kueri->bujur_school)){ echo $kueri->bujur_school; } ?>"/>
                                      <span class="f_help"> Isikan Titik Bujur Sekolah. </span> 
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