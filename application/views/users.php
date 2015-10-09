<form action="<?=base_url()?>manajemen/all_users" method="POST" enctype="multipart/form-data">

<div class="topcolumn">            

            <div class="logo"></div>

                            <ul  id="shortcut">                                
                                <li> <a href="<?=base_url()?>manajemen/tambah_user" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/add.png" alt="home" width="40px"/><strong>Tambah</strong> </a> </li>

                                <li> <input type="image" src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/Delete.png" name="image" width="40" height="40" style="margin-top:9.5px; margin-left:17px;" onclick="return konfirm()"><br/><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hapus</strong></li>                                
                            </ul>

          </div>           

          <div class="clear"></div> 

          <?php echo $this->message->display(); ?>

<div class="onecolumn" >                    
                    <div class="header">

                    <span ><span class="ico  gray spreadsheet"></span> Daftar User </span>

                    </div><!-- End header --> 

                    <div class=" clear"></div>

                    <div class="content" >                      
                              <div class="rekord">Jumlah Record <span><?=$totalPage?></span></div>
                              <table id="static" class="display static dataTable">

                                <thead>

                                  <tr>

                                    <th width="35" ><input type="checkbox" id="checkAll1"  class="checkAll"/></th>

                                    <th align="left">Name</th>  

                                    <th align="left"></th>          

                                    <th align="left"></th>                                    

                                    <th width="199" >Management</th>

                                  </tr>

                                </thead>

                                <tbody>                                

                                <?php

                                $no = 1;

                                foreach($kueri as $dt_kueri)

                                {                      

                                ?>

                                  <tr>

                                    <td  width="35" ><input type="checkbox" name="check[]" class="chkbox"  id="check<?php echo $no; ?>" value="<?php echo $dt_kueri->user_id; ?>"/></td>

                                    <td  align="left"><?php echo $dt_kueri->user_email; ?></td>

                                    <td  align="left"></td>

                                    <td  align="left"></td>                                    

                                    <td >          

                                      <span class="tip" >

                                          <a  title="Edit" href="<?php echo base_url(); ?>manajemen/edit_user/<?php echo $dt_kueri->user_id; ?>" >

                                              <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/icon_edit.png" >

                                          </a>

                                      </span> 

                                      <span class="tip" >

                                          <a id="<?php echo $no; ?>" title="Delete" href="<?php echo base_url(); ?>manajemen/hapus_user/<?php echo $dt_kueri->user_id; ?>" onclick="return konfirm()">

                                              <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/icon_delete.png" >

                                          </a>

                                      </span> 

                                        </td>

                                  </tr>                                  

                                  <?php

                                  $no++;

                                  } 

                                  ?>

                                </tbody>

                              </table>

</form>

<?php echo $paging; ?>

          </div>

</div>