<div class="topcolumn">
            <div class="logo"></div>
                            &nbsp;
          </div>
                    <div class="clear"></div> 
                    <?=$this->message->display();?>
                    <div class="onecolumn" >
                        <div class="header"><span><span class="ico gray diskette"></span> Data Siswa</span></div>
                        <div class="clear"></div>                        
                        <div class="content" >
   

    <!-- Smart Wizard -->      
      <div id="wizard" class="swMain">
        <ul>
          <?
          for($i=1;$i<=$kelas;$i++)
          {
              ?>
                <li><a href="#step-<?=$i?>">
                    <label class="stepNumber"><?=$i?></label>
                    <span class="stepDesc">Kelas <?=$i?><br />
                       <small><?=$jenjang?> Kelas <?=$i?></small>
                    </span>
                </a></li>
              <?
          }
          ?>          
        </ul>
        <?          
          for($i=1;$i<=$kelas;$i++)
          {
              ?>                
                <div id="step-<?=$i?>">                           
                  <p>Silahkan isikan seluruh form inputan sesuai dengan petunjuk yang telah disediakan sesuai dengan kelas masing-masing</p>
                    <div id="pesan"></div>
                    <h2>Data Siswa <?=$jenjang?> kelas <?=$i?></h2>                  
                    <form method="POST" action="<?=base_url()?>siswa/simpan_siswa" id="wizardsss<?=$i?>">
                      <div class="section numericonly">
                      <label> Jumlah Siswa Laki-laki  <small>Jumlah</small></label>
                      <div>
                      <input type="text"  placeholder="Jumlah Laki-laki" name="laki_<?=$i?>" id="laki_<?=$i?>"  class="validate[required,] large utama<?=$i?>" value="<? if(isset($kueri[$i]['laki'])){ echo $kueri[$i]['laki']; } ?>"  />
                      <span class="f_help"> Jumlah Siswa Laki-laki</span> 
                      </div>                    
                      </div>
                      <div class="section numericonly">
                      <label> Jumlah Siswa Perempuan  <small>Jumlah</small></label>
                      <div>
                      <input type="text"  placeholder="Jumlah Perempuan" name="pr_<?=$i?>" id="pr_<?=$i?>"  class="validate[required,] large utama<?=$i?>" value="<? if(isset($kueri[$i]['pr'])){ echo $kueri[$i]['pr']; } ?>"  />
                      <span class="f_help"> Jumlah Siswa Perempuan</span> 
                      </div> 
                      </div>
                      <?
                      if(isset($nilai[$i]) AND count($nilai[$i]) > 0)
                      {
                        foreach($nilai[$i] as $detil)
                        {
                        ?>
                        <div class="section numericonly">
                        <label> <?=$detil['batas']?>  <small>Jumlah</small></label>
                        <div>
                        <input type="text"  placeholder="Jumlah" name="detil_<?=$detil['id_detail_umur']?>" id="detil_<?=$detil['id_detail_umur']?>"  class="large anak<?=$i?>" value="<?=$detil['value']?>"/>
                        <input type="hidden" name="detilss[]" value="<?=$detil['id_detail_umur']?>">
                        </div>
                        </div>
                        <?
                        }
                      }                     
                      if(isset($prodi[$i]) AND count($prodi[$i]) > 0)
                      {                        
                        foreach($prodi[$i] as $dt_prodi)
                        {
                        $peserta = ($i == $kelas)?'[Peserta]':'';
                        $lulusan = ($i == $kelas)?'[Lulusan]':'';
                        ?>
                        <div class="section numericonly">
                        <label> <?=$dt_prodi['nama_prodi']?> <?=$peserta?>  <small>Jumlah</small></label>
                        <div>
                        <input type="text"  placeholder="Jumlah" name="detilp_<?=$dt_prodi['id_detail_prodi']?>" id="detilp_<?=$dt_prodi['id_detail_prodi']?>"  class="large prodi<?=$i?>" value="<?=$dt_prodi['peserta']?>"/>
                        </div>                        
                        <?
                        if($i == $kelas)
                        {
                          ?>
                          <br/><label> <?=$dt_prodi['nama_prodi']?> <?=$lulusan?>  <small>Jumlah</small></label>
                          <div>
                          <input type="text"  placeholder="Jumlah" name="detilpl_<?=$dt_prodi['id_detail_prodi']?>" id="detilpl_<?=$dt_prodi['id_detail_prodi']?>"  class="large prodi<?=$i?>" value="<?=$dt_prodi['lulus']?>"/>
                          </div>
                          <?
                        }
                        ?>
                        <input type="hidden" name="detilssp[]" value="<?=$dt_prodi['id_detail_prodi']?>">                        
                        </div>
                        <?
                        }
                      }
                      else
                      {
                        if($i == $kelas)
                        {                          
                          ?>
                          <div class="section numericonly">
                          <label> Jumlah UN [Peserta] Laki-laki  <small>Jumlah</small></label>
                          <div>
                          <input type="text"  placeholder="Jumlah" name="detilp1_0" id="detilp1_0"  class="large" value="<?=$nonprodi['peserta_l']?>"/>
                          </div>                    
                          <label> Jumlah UN [Peserta] Perempuan  <small>Jumlah</small></label>
                          <div>
                          <input type="text"  placeholder="Jumlah" name="detilp2_0" id="detilp2_0"  class="large" value="<?=$nonprodi['peserta_p']?>"/>
                          </div>                    
                          <label> Jumlah UN [Lulusan] Laki-laki <small>Jumlah</small></label>
                          <div>
                          <input type="text"  placeholder="Jumlah" name="detilpl1_0" id="detilpl1_0"  class="large" value="<?=$nonprodi['lulus_l']?>"/>
                          </div>
                          <label> Jumlah UN [Lulusan] Perempuan<small>Jumlah</small></label>
                          <div>
                          <input type="text"  placeholder="Jumlah" name="detilpl2_0" id="detilpl2_0"  class="large" value="<?=$nonprodi['lulus_p']?>"/>
                          </div>
                          <input type="hidden" name="detilssp[]" value="<?=$nonprodi['id_detail_prodi']?>">                        
                          <?    
                        }
                      }
                      ?>                      
                      <input type="hidden" name="jumlah" value="<?=$i?>">
                    </form>
                </div>                
              <?
          }
          ?>        
      </div>
      </div>
    <!-- End SmartWizard Content -->       
                          <div class="clear"></div>
                        </div>
                      </div>                    