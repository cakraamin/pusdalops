<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/fingers/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/fingers/js/jquery.highchartTable.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('table.highchart').highchartTable();
    });
</script>
<style type="text/css">
    table.highchart{
        display: none;
    }
</style>
<div class="topcolumn">

            <div class="logo"></div>
            <ul  id="shortcut">&nbsp;                
            </ul>   
          </div> 

           <div class="clear"></div> 

           <?=$this->message->display();?>

<div class="column_left">
  <div class="onecolumn" >
    <div class="header"> <span ><span class="ico gray home"></span> Grafik Berdasarkan Jenis Bencana</span> </div>
    <div class="clear"></div>
      <div class="content" >                                                         
        <table class="highchart" data-graph-container-before="1" data-graph-type="column">
          <thead>
            <tr>
              <th>Jumlah</th>
              <th>Bencana</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($grafik as $key => $dt_grafik)
              {
                echo "<tr>";
                echo "<td>".$key."</td>";                                            
                echo "<td>". $dt_grafik['value']."</td>";                                            
                echo "</tr>";
              }
            ?>                                  
          </tbody>
        </table>                                                                                
        <div class="clear"></div>
      </div>
  </div>
</div>
<div class="column_right" >
  <div class="onecolumn" >
    <div class="header"> <span ><span class="ico gray home"></span> Grafik Berdasarkan Lokasi</span> </div>
    <div class="clear"></div>
      <div class="content" >                                                         
        <table class="highchart" data-graph-container-before="1" data-graph-type="column">
          <thead>
            <tr>
              <th>Jumlah</th>
              <th>Lokasi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($lokasi as $kunci => $detail_lokasi)
              {
                echo "<tr>";
                echo "<td>".$kunci."</td>";                                            
                echo "<td>".$detail_lokasi['value']."</td>";                                            
                echo "</tr>";
              }
            ?>                                  
          </tbody>
        </table>                                                                                
        <div class="clear"></div>
      </div>
  </div>
</div>
<div class="clear"></div>
<div class="column_left">
  <div class="onecolumn" >
    <div class="header"> <span ><span class="ico gray home"></span> Grafik Berdasarkan Bulan Kejadian</span> </div>
    <div class="clear"></div>
      <div class="content" > 
      <caption>Tahun <b><?php echo $tahun; ?></b></caption>                                                        
        <table class="highchart" data-graph-container-before="1" data-graph-type="column">
          <thead>
            <tr>
              <th>Jumlah</th>
              <th>Bencana</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($tahunan as $key => $dt_tahunan)
              {
                echo "<tr>";
                echo "<td>". $dt_tahunan['bulan']."</td>";                                            
                echo "<td>". $dt_tahunan['value']."</td>";                                            
                echo "</tr>";
              }
            ?>                                  
          </tbody>
        </table>                                                                                
        <div class="clear"></div>
      </div>
  </div>
</div>
<div class="column_right" >
  <div class="onecolumn" >
    <div class="header"> <span ><span class="ico gray home"></span> Grafik Berdasarkan Tingkat Kerusakan</span> </div>
    <div class="clear"></div>
      <div class="content" >                                                         
        <table class="highchart" data-graph-container-before="1" data-graph-type="column">
          <thead>
            <tr>
              <th>Jumlah</th>
              <th>Lokasi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($rusak as $kunci => $detail_rusak)
              {
                echo "<tr>";
                echo "<td>".$kunci."</td>";                                            
                echo "<td>".$detail_rusak['value']."</td>";                                            
                echo "</tr>";
              }
            ?>                                  
          </tbody>
        </table>                                                                                
        <div class="clear"></div>
      </div>
  </div>
</div>
<div class="clear"></div>