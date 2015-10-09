<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>laporan" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
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
                                <a class="uibutton" href="<?=base_url()?>laporan/exportWord/<?=$idne?>">Export Word</a>&nbsp;<a class="uibutton" href="<?=base_url()?>laporan/edit/<?=$idne?>/<?=$kuncine?>/<?=$jenise?>/<?=$bencanane?>/<?=$lokasine?>/<?=$val?>/<?=$waktune?>/<?=$tahune?>/<?=$bulane?>/<?=$tanggale?>/<?=$sort_by?>/<?=$sort_order?>/<?=$page?>">Edit Bencana</a>&nbsp;<a class="uibutton special" onclick="return konfirm()" href="<?=base_url()?>laporan/hapus/<?=$idne?>/<?=$kuncine?>/<?=$jenise?>/<?=$bencanane?>/<?=$lokasine?>/<?=$val?>/<?=$waktune?>/<?=$tahune?>/<?=$bulane?>/<?=$tanggale?>/<?=$sort_by?>/<?=$sort_order?>/<?=$page?>">Hapus Bencana</a><br/><br/>
                                <form id="validation" action="#" method="POST">                                 
                                <fieldset >                                
                                      <div class="section">
                                      <label> Jenis Bencana </label>
                                      <div>
                                              <label><? if(isset($kueri->nama_jenis_bencana)){ echo $kueri->nama_jenis_bencana; } ?> </label>
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
                                              <label><? if(isset($kueri->id_lokasi)){ echo "Kec. ".$kueri->nama_kecamatan." Kel. ".$kueri->nama_kelurahan; } ?></label>
                                      </div>                                                                              
                                      </div>  
                                      <div class="section">
                                      <label> Alamat </label>
                                      <div>                                              
                                              <label><? if(isset($kueri->id_lokasi)){ echo "Dusun ".$kueri->nama_dusun; } ?> <? if(isset($kueri->rt_lokasi)){ echo "Dusun ".$kueri->rt_lokasi; } ?></label>
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
                                      if(isset($kueri->excel_bencana) && $kueri->excel_bencana == 0)
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
                                          <label> Korban </label>   
                                          <div>                                            
                                            <table class="cbencana">
                                                <tr class="tengah">
                                                  <td rowspan="2" width="30px" class="judul">NO</td><td rowspan="2" width="130px" class="judul">Korban</td><td colspan="2" class="judul">Jenis Kelamin</td>
                                                </tr>
                                                <tr class="tengah">
                                                  <td width="50px" class="judul">L</td><td width="50px" class="judul">P</td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">1</td><td class="tulisan">Meninggal Dunia</td><td class="clik"><?=$korban['meninggal']['l']?></td><td class="clik"><?=$korban['meninggal']['p']?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">2</td><td class="tulisan">Hilang</td><td class="clik"><?=$korban['hilang']['l']?></td><td class="clik"><?=$korban['hilang']['p']?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">3</td><td class="tulisan">Luka Ringan</td><td class="clik"><?=$korban['ringan']['l']?></td><td class="clik"><?=$korban['ringan']['p']?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">4</td><td class="tulisan">Luka Berat</td><td class="clik"><?=$korban['berat']['l']?></td><td class="clik"><?=$korban['berat']['p']?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">5</td><td class="tulisan">Pengungsi</td><td class="clik"><?=$detile['satu']?></td><td class="clik"><?=$detile['dua']?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">6</td><td class="tulisan">Menderita</td><td class="clik"><?=$detile['tiga']?></td><td class="clik"><?=$detile['empat']?></td>
                                                </tr>
                                              </table>
                                          </div>                                          
                                      </div> 
                                      <div class="section" >
                                          <label> Kerusakan </label>   
                                          <div>                                            
                                            <table class="cbencana">                                                
                                                <tr class="tengah">
                                                  <td width="30px" class="judul" rowspan="2">NO</td><td width="130px" class="judul" rowspan="2">Sektor</td><td class="judul" colspan="3">Kerusakan</td>
                                                </tr>
                                                <tr class="tengah">
                                                  <td class="judul">Rusak Berat</td><td class="judul">Rusak Sedang</td><td class="judul">Rusak Ringan</td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">1</td><td class="tulisan">Rumah</td><td class="clik"><?php echo (isset($rusake[1]))?$rusake[1]:0; ?></td><td class="clik"><?php echo (isset($rusake[2]))?$rusake[2]:0; ?></td><td class="clik"><?php echo (isset($rusake[3]))?$rusake[3]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">2</td><td class="tulisan">Fasilitas Pendidikan</td><td class="clik"><?php echo (isset($rusake[4]))?$rusake[4]:0; ?></td><td class="clik"><?php echo (isset($rusake[5]))?$rusake[5]:0; ?></td><td class="clik"><?php echo (isset($rusake[6]))?$rusake[6]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">3</td><td class="tulisan">Fasilitas Kesehatan</td><td class="clik"><?php echo (isset($rusake[7]))?$rusake[7]:0; ?></td><td class="clik"><?php echo (isset($rusake[8]))?$rusake[8]:0; ?></td><td class="clik"><?php echo (isset($rusake[9]))?$rusake[9]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">4</td><td class="tulisan">Fasilitas Ibadah</td><td class="clik"><?php echo (isset($rusake[10]))?$rusake[10]:0; ?></td><td class="clik"><?php echo (isset($rusake[11]))?$rusake[11]:0; ?></td><td class="clik"><?php echo (isset($rusake[12]))?$rusake[12]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">5</td><td class="tulisan">Kantor</td><td class="clik"><?php echo (isset($rusake[13]))?$rusake[13]:0; ?></td><td class="clik"><?php echo (isset($rusake[14]))?$rusake[14]:0; ?></td><td class="clik"><?php echo (isset($rusake[15]))?$rusake[15]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">6</td><td class="tulisan">Kios/Pasar</td><td class="clik" colspan="3"><?php echo (isset($rusake[16]))?$rusake[16]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">7</td><td class="tulisan">PLN</td><td class="clik" colspan="3"><?php echo (isset($rusake[17]))?$rusake[17]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">8</td><td class="tulisan">Jembatan</td><td class="clik" colspan="3"><?php echo (isset($rusake[18]))?$rusake[18]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">9</td><td class="tulisan">Irigasu</td><td class="clik" colspan="3"><?php echo (isset($rusake[19]))?$rusake[19]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">10</td><td class="tulisan">Jalan</td><td class="clik" colspan="3"><?php echo (isset($rusake[20]))?$rusake[20]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">11</td><td class="tulisan">Sawah</td><td class="clik" colspan="3"><?php echo (isset($rusake[21]))?$rusake[21]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">12</td><td class="tulisan">Kebun</td><td class="clik" colspan="3"><?php echo (isset($rusake[22]))?$rusake[22]:0; ?></td>
                                                </tr>
                                                <tr>
                                                  <td class="tengah">13</td><td class="tulisan">Kolam/Tambak</td><td class="clik" colspan="3"><?php echo (isset($rusake[23]))?$rusake[23]:0; ?></td>
                                                </tr>
                                              </table>
                                          </div>                                          
                                      </div> 
                                      <div class="section" >
                                          <label> Taksiran Kerusakan </label>   
                                          <div><?="Rp. ".number_format((isset($rusake['taksiran']))?$rusake['taksiran']:0,2,",",".")?></div>                                          
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