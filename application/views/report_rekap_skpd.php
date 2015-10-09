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
                          <li ><a href="#1" class="statusOnline"  >   <?=$skpd?>  </a></li>
                      </ul>
                      </div>  
                      <div class="tab_container" >                                                  
                          <div id="1" class="tab_content"> 
                              <center><h2>Rekap Laporan <?=$skpd?> tanggal <?=ganti_tanggal($awal)?> sampai <?=ganti_tanggal($akhir)?></h2></center>
                              <table class="tabels">
                                  <tr>
                                      <td rowspan="2" class="juduls">NO</td><td rowspan="2" class="juduls">NAMA</td><td rowspan="2" class="juduls">NAMA</td><td colspan="4" class="juduls">ABSENSI</td>
                                  </tr>
                                  <tr>
                                      <td class="juduls">MASUK</td><td class="juduls">TIDAK MASUK</td><td class="juduls">TERLAMBAT</td><td class="juduls">LAIN-LAIN</td>
                                  </tr>
                              <?
                              $query = $kueri[$id];                            
                              for($n=0;$n<count($query);$n++)
                              {
                                ?>
                                  <tr>
                                      <td class="senter"><?=$n+1?></td><td align="left"><?=$query[$n]['first_name']." ".$query[$n]['last_name']?></td><td align="left"><?=$query[$n]['nik']?></td><td><?=$query[$n]['datang']?></td><td><?=$query[$n]['bolos']?></td><td><?=$query[$n]['terlambat']?></td><td><?=$query[$n]['lain']?></td>
                                  <tr>
                                <?
                              }   
                              ?>
                              </table> 
                            </div>
                  </div>
                  </div>         
                  <div class="clear"/></div>                  
                  </div>
                  </div>