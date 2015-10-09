<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>manajemen/users" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
                            </ul>      
          </div>  
          <div class="clear"></div> 
                <?=$this->message->display();?>         
                    <div class="clear"></div>
                        
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray user"></span><?=$ket?></span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                      
                    <div class="tab_container" >

                          <div id="tab1" class="tab_content"> 
                              <div class="load_page">                        
                                 
                                <div class="formEl_b">  
                                <form id="validation" action="<?=base_url()?>manajemen/<?=$link?>" method="POST"> 
                                <fieldset >
                                    <table border="0" cellpadding="5" cellspacing="0">
                                    <tr><th></th><th>Member</th><th>Not Member</th></tr>
                                    <?            
                                    $no = 0;                    
                                    foreach ($kueri as $k => $v)
                                    {
                                        echo "<tr><td><label>" . $v['Name'] . "</label></td>";
                                        echo "<td><input type=\"radio\" name=\"role" . $no . "\" id=\"role_" . $v['ID'] . "_1\" value=\"1\"";
                                        if ($this->acl->userHasRole($v['ID'])) { echo " checked=\"checked\""; }
                                        echo " /></td>";
                                        echo "<td><input type=\"radio\" name=\"role" . $no . "\" id=\"role_" . $v['ID'] . "_0\" value=\"0\"";
                                        if (!$this->acl->userHasRole($v['ID'])) { echo " checked=\"checked\""; }
                                        echo " /></td>";
                                        echo "</tr>";    
                                        echo "<input type='hidden' name='roles".$no."' value='".$v['ID']."' >";
                                        $no++;
                                    }
                                ?>
                                    </table>
                                    <input type="hidden" name="jumlah" value="<?=$no?>">   
                                    <div class="section">                              
                                    <div></div></div>
                                    <div class="section last">
                                      <div>
                                        <a class="uibutton submit_form" >Simpan</a><a class="uibutton special"   onClick="ResetForm()" title="Reset  Form"   >Reset Form</a>
                                     </div>
                                     </div>
                                </fieldset>
                                </form>
                                </div>
                              </div>  
                          </div><!--tab1-->                                                                                                      
                  </div>                  
                  <div class="clear"/></div>                  
                  </div>
                  </div>