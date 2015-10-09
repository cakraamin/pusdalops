<script type="text/javascript">
function pilih(){
  var status = $('#status').val();
  if(status == 2){
    $('#status_peg').show();
  }else{
    $('#status_peg').hide();
  }
}
function piliht(){
  var tunjangan = $('#tunjangan').val();
  if(tunjangan == 1){
    $('#sertif').show();
  }else{
    $('#sertif').hide();
  }
}
</script>
<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>guru/daftar" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
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
                                <form id="validation" action="<?=base_url()?>guru/<?=$link?>" method="POST"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                                                                                             
                                      <div class="section numericonly">
                                      <label> NIK/NIP Guru  <small>NIK/NIP</small></label>
                                      <div>
                                      <input type="text"  name="nik" id="nik"  class="validate[required] medium" value="<? if(isset($kueri->nik_guru)){ echo $kueri->nik_guru; } ?>"/>
                                      <span class="f_help"> Isikan NIK/NIP Sekolah. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section alluppercase textonly">
                                      <label> Nama Guru  <small>Nama</small></label>
                                      <div>
                                      <input type="text"  name="nama" id="nama"  class="validate[required] medium" value="<? if(isset($kueri->nama_guru)){ echo $kueri->nama_guru; } ?>"/>
                                      <span class="f_help"> Isikan Nama Sekolah. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Tanggal Lahir  <small>Tanggal</small></label>
                                      <div>
                                              <?
                                              $tgl_lahir = (isset($kueri->tgl_lahir))?$kueri->tgl_lahir:"";
                                              $tanggal_lahir = explode("-", $tgl_lahir);
                                              $selektgl = (isset($tanggal_lahir['2']) && $tanggal_lahir['2'] != '00')?$tanggal_lahir['2']:"";
                                              $jptgl = "data-placeholder='Pilih Status Pegawai...' class='small'";
                                              echo form_dropdown('tanggal', $tanggal, $selektgl,$jptgl);
                                              $selekbln = (isset($tanggal_lahir['1']) && $tanggal_lahir['1'] != '00')?$tanggal_lahir['1']:"";
                                              $jpbln = "data-placeholder='Pilih Status Pegawai...' class='small'";
                                              echo form_dropdown('bulan', $bulan, $selekbln,$jpbln);
                                              $selekthn = (isset($tanggal_lahir['0']) && $tanggal_lahir['0'] != '0000')?$tanggal_lahir['0']:"";
                                              $jpthn = "data-placeholder='Pilih Status Pegawai...' class='small'";
                                              echo form_dropdown('tahun', $tahun, $selekthn,$jpthn);
                                              ?> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> TMT  <small>TMT</small></label>
                                      <div>
                                              <?
                                              $tmt_guru = (isset($kueri->tmt_guru))?$kueri->tmt_guru:"";
                                              $tmt = explode("-", $tmt_guru);
                                              $selektgl = (isset($tmt['2']) && $tmt['2'] != '00')?$tmt['2']:"";
                                              $jptgl = "data-placeholder='Pilih Status Pegawai...' class='small'";
                                              echo form_dropdown('tanggald', $tanggal, $selektgl,$jptgl);
                                              $selekbln = (isset($tmt['2']) && $tmt['2'] != '00')?$tmt['2']:"";
                                              $jpbln = "data-placeholder='Pilih Status Pegawai...' class='small'";
                                              echo form_dropdown('buland', $bulan, $selekbln,$jpbln);
                                              $selekthn = (isset($tmt['2']) && $tmt['2'] != '00')?$tmt['2']:"";
                                              $jpthn = "data-placeholder='Pilih Status Pegawai...' class='small'";
                                              echo form_dropdown('tahund', $tahun, $selekthn,$jpthn);
                                              ?> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Jenis Kelamin  <small>Jenis Kelamin</small></label>
                                      <div>
                                              <?
                                              $selekje = (isset($kueri->jenis_kel))?$kueri->jenis_kel:"";                                              
                                              echo form_dropdown('jenisKel', $jenisKel, $selekje);
                                              ?>
                                      <span class="f_help"> Pilih salah satu. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Status Pekerjaan  <small>Status</small></label>
                                      <div>
                                              <?
                                              $selek = (isset($kueri->status_guru))?$kueri->status_guru:"";
                                              $jp = "data-placeholder='Pilih Status Pegawai...' onchange='pilih()' id='status'";
                                              echo form_dropdown('status', $status, $selek,$jp);
                                              ?>
                                      <span class="f_help"> Pilih salah satu. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section" id="status_peg" style="display:none;">
                                      <label> Status Pegawai  <small>Status</small></label>
                                      <div>
                                              <?
                                              $selekstat = (isset($kueri->status_peg))?$kueri->status_peg:"";
                                              $jpstat = "data-placeholder='Pilih Status Pegawai...'";
                                              echo form_dropdown('statuspeg', $statuspeg, $selekstat,$jpstat);
                                              ?>
                                      <span class="f_help"> Pilih salah satu. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Jabatan Guru <small>Jabatan Guru</small></label>
                                      <div>
                                              <?
                                              $selekj = (isset($kueri->id_jabatan))?$kueri->id_jabatan:"";
                                              $jpj = "data-placeholder='Pilih Jabatan Guru...'";
                                              echo form_dropdown('jabatan', $jabatan, $selekj,$jpj);
                                              ?>
                                      <span class="f_help"> Isikan Jabatan Guru. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Tunjangan Guru  <small>Tunjangan</small></label>
                                      <div>
                                              <?
                                              $selektunj = (isset($kueri->tunjangan_guru))?$kueri->tunjangan_guru:"";
                                              $jtunj = "data-placeholder='Pilih Status Tunjangan...' onchange='piliht()' id='tunjangan'";
                                              echo form_dropdown('tunjangan', $tunjangan, $selektunj,$jtunj);
                                              ?>
                                      <span class="f_help"> Pilih salah satu. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section" style="display:none;" id="sertif">
                                      <label> Tahun Sertifikasi  <small>Tahun Sertifikasi</small></label>
                                      <div>
                                              <?
                                              $selektuntj = (isset($kueri->tahun_tunjangan))?$kueri->tahun_tunjangan:"";
                                              $jtuntj = "data-placeholder='Pilih Tahun Sertifikasi...'";
                                              echo form_dropdown('sertif', $sertif, $selektuntj,$jtuntj);
                                              ?>
                                      <span class="f_help"> Pilih salah satu. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Jenis Kendaraan  <small>Jenis</small></label>
                                      <div>
                                              <?
                                              $seleke = (isset($kueri->jenis_kendaraan))?$kueri->jenis_kendaraan:"";
                                              $jpe = "data-placeholder='Pilih Jenis Kendaraan...'";
                                              echo form_dropdown('kendaraan', $kendaraan, $seleke,$jpe);
                                              ?>
                                      <span class="f_help"> Pilih salah satu(Kendaraan ke Sekolah). </span> 
                                      </div>                                                                            
                                      </div> 
                                      <div class="section numericonly">
                                      <label> Jarak Rumah dan Sekolah  <small>Jarak</small></label>
                                      <div>
                                      <input type="text"  name="jarak" id="jarak"  class="validate[required] medium" value="<? if(isset($kueri->jarak)){ echo $kueri->jarak; } ?>"/>
                                      <span class="f_help"> Jarak rumah dan sekolah(kilometer). </span> 
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