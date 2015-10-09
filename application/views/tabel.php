<?php
foreach($kueri as $dt_kueri)
    {
        ?>
        <tr class="odd gradeX">
          <td  width="35" ><input type="checkbox" name="check[]" class="chkbox"  id="check<?php echo $dt_kueri->notrans; ?>" value="<?php echo $dt_kueri->notrans; ?>"/></td>
          <td><?php echo $dt_kueri->notrans; ?></td>
          <td><?php echo $dt_kueri->nopol; ?></td>
          <td><?php echo $dt_kueri->namabrg; ?></td>
          <td class="center"><?php echo $dt_kueri->namacust; ?></td>
          <td class="center"><?php echo $dt_kueri->namatrsp; ?></td>
          <td class="center"><?php echo $dt_kueri->nomorspk; ?></td>
          <td class="center"><?php echo $dt_kueri->netto; ?></td>
          <td class="center">
            <span class="tip" >
              <a  title="Edit Transaksi" href="<?php echo base_url();?>transaksi/edit_transaksi/<?php echo $dt_kueri->notrans; ?>/<?php echo $cari?>/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>" >
                <img src="<?php echo base_url()?>assets/template/fingers/images/icon/icon_edit.png" >
              </a>
            </span> 
            <span class="tip" >
              <a id="" class="Delete"  name="Band ring" title="Hapus Transaksi" href="<?php echo base_url();?>transaksi/hapus_transaksi/<?php echo $dt_kueri->notrans; ?>/<?php echo $cari?>/<?php echo $sort_by; ?>/<?php echo $sort_order;?>/<?php echo $page; ?>"  >
                <img src="<?php echo base_url();?>assets/template/fingers/images/icon/icon_delete.png" >
              </a>
            </span>
          </td>
        </tr>
        <?php
    }
?>