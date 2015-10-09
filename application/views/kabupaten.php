<form action="<?=base_url()?>masters/all_kabupaten" method="POST" enctype="multipart/form-data">

<div class="topcolumn">

            <div class="logo"></div>

                            <ul  id="shortcut">

                                <li> <a href="<?=base_url()?>masters/tambah_kabupaten" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/add.png" alt="home" width="40px"/><strong>Tambah</strong> </a> </li>

                                <li> <input type="image" src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/Delete.png" name="image" width="40" height="40" style="margin-top:9.5px; margin-left:17px;" onclick="return konfirm()"><br/><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hapus</strong></li>

                            </ul>

          </div>           

          <div class="clear"></div> 

          <?=$this->message->display();?>

<div class="onecolumn" >

                    <div class="header">

                    <span ><span class="ico  gray spreadsheet"></span> Daftar Kabupaten </span>

                    </div><!-- End header --> 

                    <div class=" clear"></div>

                    <div class="content" >                      
                              <div class="rekord">Jumlah Record <span><?=$totalPage?></span></div>
                              <table class="display " id="static">

                                <thead>

                                  <tr>

                                    <th width="30"><input type="checkbox" id="checkAll1"  class="checkAll"/></th>

                                    <th align="left"></th>

                                    <th align="left">Name</th>

                                    <th align="left">Propinsi</th>                                    

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

                                    <td><input type="checkbox" name="check[]" class="chkbox"  id="check<?=$no?>" value="<?=$dt_kueri->id_kabupaten?>"/></td>

                                    <td  align="left"></td>

                                    <td  align="left"><?=$dt_kueri->nama_kabupaten?></td>

                                    <td  align="left"><?=$dt_kueri->nama_propinsi?></td>                                    

                                    <td >          

                                      <span class="tip" >

                                          <a  title="Edit Kabupaten" href="<?=base_url()?>masters/edit_kabupaten/<?=$dt_kueri->id_kabupaten?>" >

                                              <img src="<?=base_url()?>assets/template/fingers/images/icon/icon_edit.png" >

                                          </a>

                                      </span> 

                                      <span class="tip" >

                                          <a id="<?=$no?>" title="Delete Kabupaten" href="<?=base_url()?>masters/hapus_kabupaten/<?=$dt_kueri->id_kabupaten?>" onclick="return konfirm()">

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