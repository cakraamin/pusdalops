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
                    <div id="uploadTab">
                      <div class="userOnline">
                      <ul class="tabs" >
                          <?
                          if(is_array($skpd))
                          {
                            foreach($skpd as $dt_skpd)
                            {
                            ?>
                            <li ><a href="#<?=str_replace(".", "_", $dt_skpd)?>" class="statusOnline"  >   <?=$this->arey->skpd($dt_skpd)?>  </a></li>  
                            <?
                            }
                          }
                          else
                          {
                            ?><li ><a href="#<?=str_replace(".", "_", $skpd)?>" class="statusOnline"  >   <?=$this->arey->skpd($skpd)?>  </a></li>  <?
                          }                    
                          ?>                                              
                      </ul>
                      </div>  
                      <div class="tab_container" >                                                  
                          <?          
                          if(is_array($skpd))
                          {
                            foreach($skpd as $dt_skpd)
                            {
                            ?>                            
                            <div id="<?=str_replace(".", "_", $dt_skpd)?>" class="tab_content"> 
                              <center><h2>Laporan Harian <?=$this->arey->skpd($dt_skpd)?> tanggal <?=ganti_tanggal($tanggal)?></h2></center>
                              <table class="tabels">
                                  <tr>
                                      <td rowspan="2" class="juduls">NO</td><td rowspan="2" class="juduls">NAMA</td><td rowspan="2" class="juduls">NIP</td><td colspan="2" class="juduls">ABSENSI</td><td rowspan="2" class="juduls">KETERANGAN</td>
                                  </tr>
                                  <tr>
                                      <td class="juduls">ABSEN MASUK</td><td class="juduls">ABSEN PULANG</td>
                                  </tr>                                                          
                              <?
                              $query = $kueri[$dt_skpd];                                                  
                              for($n=0;$n<count($query);$n++)
                              {
                                ?>
                                  <tr>
                                      <td class="senter"><?=$n+1?></td><td align="left"><?=$query[$n]['first_name']." ".$query[$n]['last_name']?></td><td align="left"><?=$query[$n]['nik']?></td><td><?=$query[$n]['datang']?></td><td><?=$query[$n]['pulang']?></td><td><?=$query[$n]['status']?></td>
                                  <tr>
                                <?
                              }                                                
                              ?>
                              </table> 
                            </div>                  
                            <?
                            }
                          }
                          else
                          {                    
                            ?>
                            <div id="<?=str_replace(".", "_", $skpd)?>" class="tab_content"> 
                              <center><h2>Laporan Harian <?=$this->arey->skpd($skpd)?> tanggal <?=ganti_tanggal($tanggal)?></h2></center>
                              <table class="tabels">
                                  <tr>
                                      <td rowspan="2" class="juduls">NO</td><td rowspan="2" class="juduls">NAMA</td><td rowspan="2" class="juduls">NIP</td><td colspan="2" class="juduls">ABSENSI</td><td rowspan="2" class="juduls">KETERANGAN</td>
                                  </tr>
                                  <tr>
                                      <td class="juduls">ABSEN MASUK</td><td class="juduls">ABSEN PULANG</td>
                                  </tr>                                                          
                              <?
                              $query = $kueri[$skpd];                            
                              for($n=0;$n<count($query);$n++)
                              {
                                ?>
                                  <tr>
                                      <td class="senter"><?=$n+1?></td><td align="left"><?=$query[$n]['first_name']." ".$query[$n]['last_name']?></td><td align="left"><?=$query[$n]['nik']?></td><td><?=$query[$n]['datang']?></td><td><?=$query[$n]['pulang']?></td><td><?=$query[$n]['status']?></td>
                                  <tr>
                                <?
                              }   
                              ?>
                              </table>                                      
                            </div>                  
                            <?                        
                          }
                          ?>
                  </div>
                  </div>         
                  <div class="clear"/></div>                  
                  </div>
                  </div>