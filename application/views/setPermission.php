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
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                      
                                      <?
                                      $no = 0;
                                      $nilai = "";                              
                                      foreach($kueri as $k => $v)
                                      {
                                      		?>
                                      		<div class="section">                                            
                                            <label><?=$v['Name']?> <small>Pilih Satu/Beberapa</small></label>
                                            <div>   
                                            <?                                                         	
                                              	echo "<select name=\"perm_" . $no . "\">";
                                              	echo "<option value=\"1\"";
                        												if ($this->acl->hasPermission($v['Key']) && $rPerms[$v['Key']]['inheritted'] != true) { echo " selected=\"selected\""; }
                        												echo ">Allow</option>";
                        												echo "<option value=\"0\"";
                        												if (isset($rPerms[$v['Key']]['value']) && $rPerms[$v['Key']]['value'] === false && isset($rPerms[$v['Key']]['inheritted']) && $rPerms[$v['Key']]['inheritted'] != true) { echo " selected=\"selected\""; }
                        												echo ">Deny</option>";
                        												echo "<option value=\"x\"";
                        												if (isset($rPerms[$v['Key']]['inheritted']) && $rPerms[$v['Key']]['inheritted'] == true || !array_key_exists($v['Key'],$rPerms))
                        												{
                        													echo " selected=\"selected\"";                        												
                                                  if (isset($rPerms[$v['Key']]['value']) && $rPerms[$v['Key']]['value'] == true )
                                                  {
                                                    $iVal = '(Allow)';
                                                  } 
                                                  else 
                                                  {
                                                    $iVal = '(Deny)';
                                                  }
                        												}                                                
                        												echo ">Inherit $iVal</option>";
								                                echo "</select>";
                                                $nilai = $nilai."-".$v['ID'];
                                            ?>                                         
	                                        </div>
	                                        </div>
                                      		<?
                                      		$no++;
                                      }
                                      ?>                      
                                      <input type="hidden" name="jumlah" value="<?=$no?>">
                                      <input type="hidden" name="nilai" value="<?=$nilai?>">
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