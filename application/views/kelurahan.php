<form action="<?=base_url()?>masters/all_kelurahan" method="POST" enctype="multipart/form-data">

<div class="topcolumn">

            <div class="logo"></div>

                            <ul  id="shortcut">

                                <li> <a href="<?=base_url()?>masters/tambah_kelurahan" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/add.png" alt="home" width="40px"/><strong>Tambah</strong> </a> </li>                                
                                <li> <button type="button" onclick="return konfirm()" class="delete"></button><br/><strong>Hapus</strong></li>
                            </ul>

          </div>           

          <div class="clear"></div> 

          <?=$this->message->display();?>

<div class="onecolumn" >

                    <div class="header">

                    <span ><span class="ico  gray spreadsheet"></span> Daftar Kelurahan </span>

                    </div><!-- End header --> 

                    <div class=" clear"></div>

                    <div class="content" >   
                              <input class=" small" type="text" name="kuncine" value="<? if(isset($kuncine)){ echo $kuncine; } ?>"><br/>                   
                              <div class="rekord">Jumlah Record <span><?=$totalPage?></span></div>
                              <table id="static" class="display static dataTable">

                                <thead>

                                  <tr>

                                    <th width="35" ><input type="checkbox" id="checkAll1"  class="checkAll"/></th>

                                    <th align="left">Kelurahan</th>

                                    <th align="left">Kecamatan</th>

                                    <th align="left">Kabupaten</th>

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

                                    <td  width="35" ><input type="checkbox" name="check[]" class="chkbox"  id="check<?=$no?>" value="<?=$dt_kueri->id_kelurahan?>"/></td>

                                    <td  align="left"><?=$dt_kueri->nama_kelurahan?></td>

                                    <td  align="left"><?=$dt_kueri->nama_kecamatan?></td>

                                    <td  align="left"><?=$dt_kueri->nama_kabupaten?></td>

                                    <td >          

                                      <span class="tip" >

                                          <a  title="Edit Kelurahan" href="<?=base_url()?>masters/edit_kelurahan/<?=$dt_kueri->id_kelurahan?>" >

                                              <img src="<?=base_url()?>assets/template/fingers/images/icon/icon_edit.png" >

                                          </a>

                                      </span> 

                                      <span class="tip" >

                                          <a id="<?=$no?>" title="Delete Kelurahan" href="<?=base_url()?>masters/hapus_kelurahan/<?=$dt_kueri->id_kelurahan?>" onclick="return konfirm()">

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