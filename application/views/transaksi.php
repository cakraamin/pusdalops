<script type="text/javascript">

    /*setInterval("imports();",10000);

    function imports(){

      $.post( "<?php echo base_url(); ?>setting/import", function( data ) {

        if(data == 'ok'){

          $.get( "<?php echo base_url(); ?>transaksi/getTable/<?php echo $per_page; ?>/<?php echo $cari; ?>/<?php echo $sort_by; ?>/<?php echo $sort_order; ?>/<?php echo $page; ?>", function( data ) {

            $('tbody').html(data);

          });

          window.location = "<?php echo base_url();?>transaksi";

        }         

      });

    }*/

    function generate(){
      var status = $('#statuss').val();

      var limbah = $('#limbah').val();
      var unit = $('#unit').val();
      var user = $('#user').val();
      var transporter = $('#transporter').val();
      var tanggal = $('#tanggal').val();

      if(status == 1){
        window.open("<?php echo base_url()?>transaksi/cetak/"+limbah+"/"+unit+"/"+user+"/"+transporter+"/"+tanggal+"", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=20, width=1200, height=800");
      }
      else
      {
        //$.post("<?php echo base_url()?>transaksi/excel/"+limbah+"/"+unit+"/"+user+"/"+transporter+"/"+tanggal);
        window.location = "<?php echo base_url(); ?>transaksi/excel/"+limbah+"/"+unit+"/"+user+"/"+transporter+"/"+tanggal;
      }
    }

  </script>

<form action="<?php echo base_url();?>transaksi/all_transaksi/<?php echo $limbah; ?>/<?php echo $unit; ?>/<?php echo $user; ?>/<?php echo $transporter; ?>/<?php echo $tanggal; ?>/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>" method="POST" enctype="multipart/form-data">

<div class="topcolumn">

            <div class="logo"></div>

                            <ul  id="shortcut">   
                                <?php $notif = $this->globals->notification($this->session->userdata('user_id')); ?>
                                <?php

                                if($role == 1)

                                {

                                  ?><li> <a href="<?php echo base_url();?>transaksi/tambah_transaksi" title="Tambah Transaksi"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/add.png" alt="home" width="40px"/><strong>Tambah</strong> </a> </li><?php

                                }

                                ?>                  

                                <li> <input type="image" src="<?php echo base_url();?>assets/template/fingers/images/icon/shortcut/Delete.png" name="image" width="40" height="40" style="margin-top:9.5px; margin-left:17px;"><br/><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hapus</strong></li>
                                <li> <a href="<?php echo base_url() ?>berita/unread/<?php echo $notif['detail']; ?>" title="Messages"> <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/shortcut/mail.png" alt="messages" /><strong>Message</strong></a><?php echo $notif['jml']; ?></li>

                            </ul>

          </div>           

          <div class="clear"></div> 

          <?php echo $this->message->display(); ?>

<div class="onecolumn" >

                    <div class="header">

                    <span ><span class="ico  gray spreadsheet"></span> Daftar Timbangan </span>

                    </div><!-- End header --> 

                    <div class=" clear"></div>

                    <div class="content" >                      

                    <form> 

          <div class="tableName">   

          <div id="DataTables_Table_0_filter" class="dataTables_filter">

          <label>          
          <?php          
          $limb = "  data-placeholder='Nama Limbah...'' class='medium' id='limbah' ";         
          echo form_dropdown('limbah', $limbah, $limbahs,$limb);

          $lunit = "  data-placeholder='Nama Unit...'' class='medium' id='unit' ";          
          echo form_dropdown('unit', $unit, $units,$lunit);

          $luser = "  data-placeholder='Nama User...'' class='medium' id='user' ";         
          echo form_dropdown('user', $user, $userd,$luser);

          $ltrans = "  data-placeholder='Nama Transporter...'' class='medium' id='transporter' ";    
          echo form_dropdown('transporter', $transporter, $transporters,$ltrans);                    

          if($total_page > 0)
          { 
              $laporan = array(
                '1'     => 'Cetak',
                '2'     => 'Excel'
              );
              $llap = " class='medium' id='statuss' ";    
              echo form_dropdown('laporan', $laporan, '',$llap);              
          }
          ?>                    
          <br/><input type="text"  name="tanggal" id="tanggal"  class="birthday  small caris" value="<?php if(isset($tanggal)){ echo $tanggal; }?>"/>
          <input type="submit"  name="submit" id="submit"  class="cButton" value="Cari"/>
          <?php
          if($total_page > 0)
          {               
              echo '<input type="button"  name="button" id="submit"  class="cButton" value="Cetak Laporan" onClick="generate()"/>';
          }
          ?>

          </label>

          </div>     

<table class="display" >

  <thead>

    <tr>

      <th width="35" ><input type="checkbox" id="checkAll1"  class="checkAll"/></th>

      <th><div class="th_wrapp">No Tiket</div></th>

      <th><div class="th_wrapp">No Kend</div></th>

      <th><div class="th_wrapp">Jam Masuk</div></th>

      <th><div class="th_wrapp">Jenis Limbah</div></th>

      <th><div class="th_wrapp">Pemanfaat</div></th>      

      <th><div class="th_wrapp">Transporter</div></th>      

      <th><div class="th_wrapp">S. Jalan</div></th>      

      <th><div class="th_wrapp">No. Manifest</div></th>

      <th><div class="th_wrapp">No. MGP</div></th>            

      <th><div class="th_wrapp">Gross</div></th>            

      <th><div class="th_wrapp">Tarra</div></th>            

      <th><div class="th_wrapp">Netto</div></th>            

      <th><div class="th_wrapp">Penimbang</div></th>            

      <th><div class="th_wrapp">Pengemudi</div></th>            

      <th><div class="th_wrapp">Action</div></th>

    </tr>

  </thead>

  <tbody>

    <?php

    if(count($kueri) > 0)
    {
        foreach($kueri as $dt_kueri)

        {

            ?>

            <tr class="odd gradeX">

              <td  width="35" ><input type="checkbox" name="check[]" class="chkbox"  id="check<?php echo $dt_kueri->notrans; ?>" value="<?php echo $dt_kueri->notrans; ?>"/></td>

              <td><?php echo $dt_kueri->notrans; ?></td>

              <td><?php echo $dt_kueri->nopol; ?></td>

              <td><?php echo $dt_kueri->jamtb1; ?></td>

              <td><?php echo $dt_kueri->namabrg; ?></td>

              <td><?php echo $dt_kueri->namacust; ?></td>              

              <td><?php echo $dt_kueri->namatrsp; ?></td>              
              <?php                      
                $do = isset($dt_kueri->nomorspk)?$dt_kueri->nomorspk:"//";
                $pecahdo = explode("/", $do);
                $jalan = (isset($pecahdo[0]) && $pecahdo[0] != "")?$pecahdo[0]:"";
                $manifest = (isset($pecahdo[1]) && $pecahdo[1] != "")?$pecahdo[1]:"";
                $mgp = (isset($pecahdo[2]) && $pecahdo[2] != "")?$pecahdo[2]:"";
              ?>
              <td><?php echo $jalan; ?></td>

              <td><?php echo $manifest; ?></td>

              <td><?php echo $mgp; ?></td>

              <td><?php echo number_format($dt_kueri->timbang1,0,',','.'); ?></td>

              <td><?php echo number_format($dt_kueri->timbang2,0,',','.'); ?></td>

              <td><?php echo number_format($dt_kueri->netto,0,',','.'); ?></td>

              <td><?php echo $dt_kueri->user2; ?></td>

              <td><?php echo $dt_kueri->sopir; ?></td>

              <td class="center">

                <span class="tip" >

                  <a  title="Edit Transaksi" href="<?php echo base_url();?>transaksi/edit_transaksi/<?php echo $dt_kueri->notrans; ?>/<?php echo $limbah; ?>/<?php echo $unit; ?>/<?php echo $user; ?>/<?php echo $transporter; ?>/<?php echo $tanggal; ?>/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>" >

                    <img src="<?php echo base_url()?>assets/template/fingers/images/icon/icon_edit.png" >

                  </a>

                </span> 

                <span class="tip" >

                  <a id="" class="Delete"  name="Band ring" title="Hapus Transaksi" href="<?php echo base_url();?>transaksi/hapus_transaksi/<?php echo $dt_kueri->notrans; ?>/<?php echo $limbah; ?>/<?php echo $unit; ?>/<?php echo $user; ?>/<?php echo $transporter; ?>/<?php echo $tanggal; ?>/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>"  >

                    <img src="<?php echo base_url();?>assets/template/fingers/images/icon/icon_delete.png" >

                  </a>

                </span>

                <?php

                $comment = $this->mtransaksi->getComment($dt_kueri->notrans);

                if(isset($comment->text_comment) && $comment->text_comment != "")

                {

                  ?>

                  <span class="tip" >              

                      <img src="<?php echo base_url();?>assets/template/fingers/images/icon/dialog.png" width="16px" >    

                  </span>

                  <?php

                }

                ?>

              </td>

            </tr>

            <?php

        }
    }
    else
    {
      ?><tr><td colspan="16">Tidak Ada Transaksi</td></tr><?php
    }

    ?>      

  </tbody>

</table>

                    </div>

          </form>

          <?php echo $paging; ?>

          </div>

</div>