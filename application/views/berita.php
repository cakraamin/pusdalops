<form action="<?php echo base_url();?>berita/all_berita/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>" method="POST" enctype="multipart/form-data">
<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">  
                                <?php $notif = $this->globals->notification($this->session->userdata('user_id')); ?> 
                                <li> <a href="<?php echo base_url();?>berita/tambah_berita" title="Tambah Transaksi"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/add.png" alt="home" width="40px"/><strong>Tambah</strong> </a> </li>                                
                                <li> <input type="image" src="<?php echo base_url();?>assets/template/fingers/images/icon/shortcut/Delete.png" name="image" width="40" height="40" style="margin-top:9.5px; margin-left:17px;"><br/><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hapus</strong></li>
                                <li> <a href="<?php echo base_url() ?>berita/unread/<?php echo $notif['detail']; ?>" title="Messages"> <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/shortcut/mail.png" alt="messages" /><strong>Message</strong></a><?php echo $notif['jml']; ?></li>
                            </ul>
          </div>           
          <div class="clear"></div> 
          <?php echo $this->message->display(); ?>
<div class="onecolumn" >
                    <div class="header">
                    <span ><span class="ico  gray spreadsheet"></span> Daftar Berita </span>
                    </div><!-- End header --> 
                    <div class=" clear"></div>
                    <div class="content" >                      
                    <form> 
          <div class="tableName">             
<table class="display" >
  <thead>
    <tr>
      <th width="35" ><input type="checkbox" id="checkAll1"  class="checkAll"/></th>
      <th><div class="th_wrapp">Judul</div></th>      
      <th><div class="th_wrapp">Penulis</div></th>      
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
              <td  width="35" ><input type="checkbox" name="check[]" class="chkbox"  id="check<?php echo $dt_kueri->id_berita; ?>" value="<?php echo $dt_kueri->id_berita; ?>"/></td>
              <td align="left"><?php echo $dt_kueri->judul_berita; ?></td>
              <td><?php echo $dt_kueri->user_email; ?></td>              
              <td class="center">
                <span class="tip" >
                  <a  title="Edit Berita" href="<?php echo base_url();?>berita/edit_berita/<?php echo $dt_kueri->id_berita; ?>/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>" >
                    <img src="<?php echo base_url()?>assets/template/fingers/images/icon/icon_edit.png" >
                  </a>
                </span> 
                <span class="tip" >
                  <a id="" class="Delete"  name="Band ring" title="Hapus Berita" href="<?php echo base_url();?>berita/hapus_berita/<?php echo $dt_kueri->id_berita; ?>/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>"  >
                    <img src="<?php echo base_url();?>assets/template/fingers/images/icon/icon_delete.png" >
                  </a>
                </span>                
              </td>
            </tr>
            <?php
        }
    }
    else
    {
      ?><tr><td colspan="9">Tidak Ada Berita</td></tr><?php
    }
    ?>      
  </tbody>
</table>
                    </div>
          </form>
          <?php echo $paging; ?>
          </div>
</div>