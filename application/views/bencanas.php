<form action="<?=base_url()?>masters/all_bencana" method="POST" enctype="multipart/form-data">

<div class="topcolumn">

            <div class="logo"></div>

                            <ul  id="shortcut">

                                <li> <a href="<?=base_url()?>masters/tambah_bencana" title="Tambah Bencana"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/add.png" alt="home" width="40px"/><strong>Tambah</strong> </a> </li>                                

                                <li> <input type="image" src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/Delete.png" name="image" width="40" height="40" style="margin-top:9.5px; margin-left:17px;" onclick="return konfirm()"><br/><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hapus</strong></li>

                            </ul>

          </div>           

          <div class="clear"></div> 

          <?=$this->message->display();?>

<div class="onecolumn" >

                    <div class="header">

                    <span ><span class="ico  gray spreadsheet"></span> Daftar Jenis Bencana </span>

                    </div><!-- End header --> 

                    <div class=" clear"></div>

                    <div class="content" >                      
                              <div class="rekord">Jumlah Record <span><?=$totalPage?></span></div>
                              <table id="static" class="display static dataTable">

                                <thead>

                                  <tr>

                                    <th width="35" ><input type="checkbox" id="checkAll1"  class="checkAll"/></th>

                                    <th align="left">Bencana</th>

                                    <th align="left"></th>

                                    <th align="left"></th>

                                    <th width="199" >Management</th>

                                  </tr>

                                </thead>

                                <tbody>                                

                                <?

                                $no = 1;

                                foreach($kueri as $dt_kueri)

                                {                      

                                ?>

                                  <tr>

                                    <td  width="35" ><input type="checkbox" name="check[]" class="chkbox"  id="check<?=$no?>" value="<?=$dt_kueri->id_jenis_bencana?>"/></td>

                                    <td  align="left"><?=$dt_kueri->nama_jenis_bencana?></td>

                                    <td  align="left"></td>

                                    <td  align="left"></td>

                                    <td >          

                                      <span class="tip" >

                                          <a  title="Edit Bencana" href="<?=base_url()?>masters/edit_bencana/<?=$dt_kueri->id_jenis_bencana?>" >

                                              <img src="<?=base_url()?>assets/template/fingers/images/icon/icon_edit.png" >

                                          </a>

                                      </span> 

                                      <span class="tip" >

                                          <a id="<?=$no?>" title="Delete Bencana" href="<?=base_url()?>masters/hapus_bencana/<?=$dt_kueri->id_jenis_bencana?>" onclick="return konfirm()">

                                              <img src="<?=base_url()?>assets/template/fingers/images/icon/icon_delete.png" >

                                          </a>

                                      </span> 

                                        </td>

                                  </tr>                                  

                                  <? 

                                  $no++;

                                  } 

                                  ?>

                                </tbody>

                              </table>

</form>

<?=$paging?>

          </div>

</div>