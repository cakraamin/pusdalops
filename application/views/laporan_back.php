<form action="<?=base_url()?>laporan/submit" method="POST" enctype="multipart/form-data" id="validation" >
<div class="topcolumn">
            <div class="logo"></div>
            <ul  id="shortcut">
              <li> <a href="<?=base_url()?>laporan/report" title="Generate Report"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/laporan.png" alt="home" width="40px"/><strong>Report</strong> </a> </li>
            </ul>     
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                  <?php echo $this->message->display(); ?>
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray spreadsheet"></span>Rekap Laporan</span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >
                      <?
                      $selekben = (isset($kebencanaan))?$kebencanaan:"";
                      echo form_dropdown('bencana', $bencanane,$selekben);
                      echo "<br/><br/>";
                      $seleklok = (isset($lokasine))?$lokasine:"";
                      $jplok = "data-placeholder='Lokasi Kebencanaan...' class='chzn-select'";
                      echo form_dropdown('lokasi', $lokasi, $seleklok,$jplok);
                      echo "<br/><br/>";
                      ?> 
                      <input type="text"  id="datepick" class="datepicker" readonly="readonly" name="tanggal" value="<? if($tanggale != "00-00-0000"){ echo $tanggale; } ?>"/>&nbsp;<a class="uibutton submit_form" >Cari</a>
                      <table class="display bencana " id="static">
                                <thead>
                                  <tr>
                                    <th width="35" >NO</th>
                                    <th width="120" align="left">Bencana</th>
                                    <th>Tanggal</th>
                                    <th>Kelurahan</th>
                                    <th>Lokasi</th>
                                    <th>Meninggal</th>
                                    <th>Hilang</th>
                                    <th>Luka Berat</th>
                                    <th>Luka Ringan</th>
                                    <th>Pengungsi</th>
                                    <th>Menderita</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?
                                  $no = 1;
                                  foreach($kueri as $dt_kueri)
                                  {
                                    ?>
                                    <tr>
                                      <td  width="35" ><?=$no?></td>
                                      <td  align="left"><a href="<?=base_url()?>laporan/get_detail/<?=$dt_kueri['id']?>"><?=$dt_kueri['jenis']?></a></td>
                                      <td ><?=ganti_tanggal($dt_kueri['tanggal'])?></td>
                                      <td ><?=$dt_kueri['lokasi']?></td>
                                      <td ><?=$dt_kueri['alamat']?></td>
                                      <td ><?=$dt_kueri['meninggal']?></td>
                                      <td ><?=$dt_kueri['hilang']?></td>
                                      <td ><?=$dt_kueri['berat']?></td>
                                      <td ><?=$dt_kueri['ringan']?></td>
                                      <td ><?=$dt_kueri['pengungsi']?></td>
                                      <td ><?=$dt_kueri['menderita']?></td>
                                    </tr>
                                    <?
                                    $no++;
                                  }
                                  ?>                                  
                                </tbody>
                              </table>                                          
                  <div class="clear"/></div>                  
                  <?=$paging?>
                  </div>
                  </div>
                  </form>