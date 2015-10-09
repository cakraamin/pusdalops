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
                  <div class="header"><span ><span class="ico  gray user"></span>Detail Kebencanaan</span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                      
                    <div class="tab_container" >
                          <div id="tab1" class="tab_content"> 
                              <div class="load_page">                                                         
                                <div class="formEl_b">  
                                <form id="validation" action="#" method="POST"> 
                                <fieldset >                                
                                      <div class="section">
                                      <label> Jenis Bencana </label>
                                      <div>
                                              <label><? if(isset($kueri->id_jenis_bencana)){ echo $this->arey->getJenisBencana($kueri->id_jenis_bencana); } ?> </label>
                                      </div>                                                                            
                                      </div>    
                                      <div class="section">
                                          <label>Tanggal dan Waktu Kejadian</label>
                                          <?
                                          if(isset($kueri->tanggal_bencana) AND $kueri->tanggal_bencana != "00-00-0000")
                                          { 
                                              $tanggal = ganti_tanggal($kueri->tanggal_bencana)." PUKUL ".$kueri->waktu_bencana;
                                          }
                                          else
                                          {
                                              $tanggal = "";
                                          }
                                          ?>
                                          <div><label><?=$tanggal?></label></div>
                                      </div>                                      
                                      <div class="section">
                                      <label> Lokasi Kebencanaan </label>
                                      <div>
                                              <label><? if(isset($kueri->id_lokasi)){ echo "Kel. ".$kueri->nama_kelurahan; } ?></label>
                                      </div>                                                                              
                                      </div>  
                                      <div class="section">
                                      <label> Alamat </label>
                                      <div>                                              
                                              <label><? if(isset($kueri->dusun_lokasi)){ echo "Dusun ".$kueri->dusun_lokasi." RT ".$kueri->rt_lokasi; } ?></label>
                                      </div>                                                                              
                                      </div>  
                                      <div class="section">
                                      <label> Letak Geografis </label>
                                          <div>
                                          <label>Longitude : <? if(isset($kueri->long_lokasi)){ echo $kueri->long_lokasi; } ?></label>
                                          </div>
                                          <div>
                                          <label>Latitude : <? if(isset($kueri->lat_lokasi)){ echo $kueri->lat_lokasi; } ?></label>
                                          </div>
                                      </div>  
                                      <div class="section lain">
                                      <label> Cakupan Dampak Bencana </label>
                                          <div>
                                          <label>Panjang : <? if(isset($kueri->panjang_bencana)){ echo $kueri->panjang_bencana; } ?></label>
                                          </div>
                                          <div>
                                          <label>Lebar : <? if(isset($kueri->lebar_bencana)){ echo $kueri->lebar_bencana; } ?></label>
                                          </div>
                                          <div>
                                          <label>Radius : <? if(isset($kueri->radius_bencana)){ echo $kueri->radius_bencana; } ?></label>
                                          </div>
                                      </div>
                                      <div class="section banjir" style="display:none;">
                                      <label> Cakupan Dampak Bencana </label>
                                          <div>
                                          <label>Luas Banjir : <? if(isset($kueri->luas_bencana)){ echo $kueri->luas_bencana; } ?></label>
                                          </div>
                                          <div>
                                          <label>Tinggi Banjir : <? if(isset($kueri->tinggi_bencana)){ echo $kueri->tinggi_bencana; } ?></label>
                                          </div>                                          
                                      </div>
                                      <div class="section" >
                                          <label> Penyebab </label>   
                                          <div> <label><? if(isset($kueri->sebab_bencana)){ echo $kueri->sebab_bencana; } ?></label></div>
                                      </div>                                    
                                      <div class="section" >
                                          <label> Deskripsi Bencana </label>   
                                          <div > <label><? if(isset($kueri->deskripsi_bencana)){ echo $kueri->deskripsi_bencana; } ?></label></div> 
                                      </div>
                                      <div class="section" >
                                          <label> Kondisi Cuaca </label>   
                                          <div><label><? if(isset($kueri->kondisi_bencana)){ echo $kueri->kondisi_bencana; } ?></label></div>
                                      </div>
                                      <?
                                      if($kueri->excel_bencana == 0)
                                      {
                                        ?>
                                        <div class="section" >
                                          <label> Meninggal </label>   
                                          <div><label><? if(isset($kueri->meninggal)){ echo $kueri->meninggal; } ?></label></div>
                                          <label> Hilang </label>   
                                          <div><label><? if(isset($kueri->hilang)){ echo $kueri->hilang; } ?></label></div>
                                          <label> Luka Ringan </label>   
                                          <div><label><? if(isset($kueri->ringan)){ echo $kueri->ringan; } ?></label></div>
                                          <label> Luka Berat </label>   
                                          <div><label><? if(isset($kueri->berat)){ echo $kueri->berat; } ?></label></div>
                                          <label> Pengungsi </label>   
                                          <div><label><? if(isset($kueri->pengungsi)){ echo $kueri->pengungsi; } ?></label></div>
                                          <label> Menderita </label>   
                                          <div><label><? if(isset($kueri->menderita)){ echo $kueri->menderita; } ?></label></div>
                                          <label> Kerusakan </label>   
                                          <div><label><? if(isset($kueri->rusak)){ echo $kueri->rusak; } ?></label></div>
                                        </div>
                                        <?
                                      }
                                      else
                                      {
                                        ?>
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
                                                      $nilai = (isset($detile[$indeks]))?$detile[$indeks]:"0";
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
                                                      $ide = $indeks."-k";
                                                      $nilai = (isset($rusake[$indeks]))?$rusake[$indeks]:"0";
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
                                        <?
                                      }
                                      ?>                                                                          
                                </fieldset>
                                </form>
                                </div>
                              </div>  
                          </div><!--tab1-->                                                                                                      
                  </div>                  
                  <div class="clear"/></div>                  
                  </div>
                  </div>