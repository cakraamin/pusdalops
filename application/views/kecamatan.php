<form action="<?=base_url()?>masters/all_kecamatan" method="POST" enctype="multipart/form-data">

<div class="topcolumn">

            <div class="logo"></div>

                            <ul  id="shortcut">

                                <li> <a href="<?=base_url()?>masters/tambah_kecamatan" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/add.png" alt="home" width="40px"/><strong>Tambah</strong> </a> </li>                                
                                <li> <button type="button" onclick="return konfirm()" class="delete"></button><br/><strong>Hapus</strong></li>

                            </ul>

          </div>           

          <div class="clear"></div> 

          <?=$this->message->display();?>

<div class="onecolumn" >

                    <div class="header">

                    <span ><span class="ico  gray spreadsheet"></span> Daftar Kecamatan </span>

                    </div><!-- End header --> 

                    <div class=" clear"></div>

                    <div class="content" >   
                              <input class=" small" type="text" name="kuncine" value="<? if(isset($kuncine)){ echo $kuncine; } ?>"><br/>                   
                              <div class="rekord">Jumlah Record <span><?=$totalPage?></span></div>
                              <table id="static" class="display static dataTable">

                                <thead>

                                  <tr>

                                    <th width="35" ><input type="checkbox" id="checkAll1"  class="checkAll"/></th>

                                    <th align="left">Name</th>

                                    <th align="left">Kabupaten</th>

                                    <th align="left">Kode Kecamatan</th>

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

                                    <td  width="35" ><input type="checkbox" name="check[]" class="chkbox"  id="check<?=$no?>" value="<?=$dt_kueri->id_kecamatan?>"/></td>

                                    <td  align="left"><?=$dt_kueri->nama_kecamatan?></td>

                                    <td  align="left"><?=$dt_kueri->nama_kabupaten?></td>

                                    <td  align="left"><?=$dt_kueri->kode_kecamatan?></td>

                                    <td >          

                                      <span class="tip" >

                                          <a  title="Edit Kecamatan" href="<?=base_url()?>masters/edit_kecamatan/<?=$dt_kueri->id_kecamatan?>" >

                                              <img src="<?=base_url()?>assets/template/fingers/images/icon/icon_edit.png" >

                                          </a>

                                      </span> 

                                      <span class="tip" >

                                          <a id="<?=$no?>" title="Delete Kecamatan" href="<?=base_url()?>masters/hapus_kecamatan/<?=$dt_kueri->id_kecamatan?>" onclick="return konfirm()">

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