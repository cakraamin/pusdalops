<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <?php $notif = $this->globals->notification($this->session->userdata('user_id')); ?>
                                <li> <a href="<?php echo base_url(); ?><?php echo $back; ?>" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
                                <li> <a href="<?php echo base_url() ?>berita/unread/<?php echo $notif['detail']; ?>" title="Messages"> <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/shortcut/mail.png" alt="messages" /><strong>Message</strong></a><?php echo $notif['jml']; ?></li>
                            </ul>      
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                        
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray user"></span><?php echo $ket;?></span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                      
                    <div class="tab_container" >

                          <div id="tab1" class="tab_content"> 
                              <div class="load_page">                        
                                 
                                <div class="formEl_b">  
                                <form id="validation" action="<?php echo base_url();?><?php echo $link;?>" method="POST"> 
                                <fieldset >
                                <legend><?php echo $ket;?> <span class="small s_color">( <?php echo $jenis;?> )</span></legend>                                                                
                                      <div class="section">
                                      <label> Nomor Kendaraan  <small>Nomor</small></label>
                                      <div>
                                      <input type="text"  name="nopol" id="nopol"  class="validate[required] medium" value="<?php if(isset($kueri->nopol)){ echo $kueri->nopol; } ?>"/>
                                      <span class="f_help"> Isikan Nomor Kendaraan. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Jenis Limbah  <small>Jenis</small></label>
                                      <div>
                                      <?php
                                        $jsbrg = "  data-placeholder='Nama Barang...'' class='chzn-select' ";
                                        $selekbrg = (isset($kueri->kodebrg))?$kueri->kodebrg:"";
                                        echo form_dropdown('kodebrg', $barang, $selekbrg,$jsbrg);
                                      ?>                                      
                                      </div>                                                                            
                                      </div>                               
                                      <div class="section">
                                      <label> Pemanfaat  <small>Pemanfaat</small></label>
                                      <div>
                                      <?php
                                        $jsco = "  data-placeholder='Customer/Client...'' class='chzn-select' ";
                                        $selekco = (isset($kueri->kodecust))?$kueri->kodecust:"";
                                        echo form_dropdown('kodecust', $customer, $selekco,$jsco);
                                      ?>                                                                              
                                      </div>                                                                            
                                      </div>                               
                                      <div class="section">
                                      <label> Transporter  <small>Transporter</small></label>
                                      <div>
                                      <?php
                                        $jstr = "  data-placeholder='Transporter...'' class='chzn-select' ";
                                        $selektr = (isset($kueri->kodetrsp))?$kueri->kodetrsp:"";
                                        echo form_dropdown('kodetrsp', $transporter, $selektr,$jstr);
                                      ?>                                                                         
                                      </div>                                                                            
                                      </div>   
                                      <?php                      
                                      $do = isset($kueri->nomorspk)?$kueri->nomorspk:"//";
                                      $pecahdo = explode("/", $do);
                                      $jalan = (isset($pecahdo[0]) && $pecahdo[0] != "")?$pecahdo[0]:"";
                                      $manifest = (isset($pecahdo[1]) && $pecahdo[1] != "")?$pecahdo[1]:"";
                                      $mgp = (isset($pecahdo[2]) && $pecahdo[2] != "")?$pecahdo[2]:"";
                                      ?>                                
                                      <div class="section">
                                      <label> Surat Jalan  <small>Surat Jalan</small></label>
                                      <div>
                                      <input type="text"  name="jalan" id="jalan"  class="medium" value="<?php echo $jalan;?>"/>
                                      <span class="f_help"> Isikan Nomor Kendaraan. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Nomor Manifest  <small>Nomor Manifest</small></label>
                                      <div>
                                      <input type="text"  name="manifest" id="manifest"  class="medium" value="<?php echo $manifest; ?>"/>
                                      <span class="f_help"> Isikan Nomor Kendaraan. </span> 
                                      </div>                                                                            
                                      </div>
                                      <div class="section">
                                      <label> Nomor MGP  <small>Nomor MGP</small></label>
                                      <div>
                                      <input type="text"  name="mgp" id="mgp"  class="medium" value="<?php echo $mgp; ?>"/>
                                      <span class="f_help"> Isikan Nomor Kendaraan. </span> 
                                      </div>                                                                            
                                      </div>


                                      <div class="section">
                                      <label> Jumlah Gross </label>
                                      <div>
                                      <input type="text"  name="timbang2" id="timbang2"  class="validate[required] small" value="<?php if(isset($kueri->timbang2)){ echo number_format($kueri->timbang2,0,',','.'); } ?>"/>
                                      </div>
                                      <label> Tanggal </label>
                                      <div>
                                      <input type="text"  name="tgltb2" id="tgltb2"  class="birthday  small" value="<?php if(isset($kueri->tgltb2)){ echo $kueri->tgltb2; } ?>"/>                                      
                                      </div>
                                      <label> Jam </label>
                                      <div>
                                      <input type="text"  name="jamtb2" id="jamtb2"  class="validate[required] small" value="<?php if(isset($kueri->jamtb2)){ echo $kueri->jamtb2; } ?>"/>
                                      </div>                                                                            
                                      </div> 
                                      <div class="section">
                                      <label> Jumlah Tara </label>
                                      <div>
                                      <input type="text"  name="timbang1" id="timbang1"  class="validate[required] small" value="<?php if(isset($kueri->timbang1)){ echo number_format($kueri->timbang1,0,',','.'); } ?>"/>
                                      </div>
                                      <label> Tanggal </label>
                                      <div>
                                      <input type="text"  name="tgltb1" id="tgltb1"  class="birthday  small" value="<?php if(isset($kueri->tgltb1)){ echo $kueri->tgltb1; } ?>"/>
                                      </div>
                                      <label> Jam </label>
                                      <div>
                                      <input type="text"  name="jamtb1" id="jamtb1"  class="validate[required] small" value="<?php if(isset($kueri->jamtb1)){ echo $kueri->jamtb1; } ?>"/>
                                      </div>
                                      </div>          
                                      <div class="section">
                                      <label> Jumlah Netto </label>
                                      <div>
                                      <input type="text"  name="netto" id="netto"  class="validate[required] small" value="<?php if(isset($kueri->netto)){ echo number_format($kueri->netto,0,',','.'); } ?>"/>
                                      </div>                                  
                                      </div>                               
                                      <div class="section">
                                      <label> Penimbang </label>
                                      <div>
                                      <input type="text"  name="user2" id="user2"  class="validate[required] large" value="<?php if(isset($kueri->user2)){ echo $kueri->user2; } ?>"/>
                                      </div>                                  
                                      </div>                               
                                      <div class="section">
                                      <label> Pengemudi </label>
                                      <div>
                                      <input type="text"  name="sopir" id="sopir"  class="validate[required] large" value="<?php if(isset($kueri->sopir)){ echo $kueri->sopir; } ?>"/>
                                      </div>                                  
                                      </div>                               
                                      <?php
                                      if($roles == 1)
                                      {
                                          ?>
                                            <div class="section last">
                                              <div>
                                                <a class="uibutton submit_form" >Simpan</a><a class="uibutton special"   onClick="ResetForm()" title="Reset  Form"   >Reset Form</a>
                                             </div>
                                             </div>
                                          <?php
                                      }
                                      ?>                                      
                                </fieldset>                                                          
                                <?php
                                if($roles == 2 OR $roles == 1 AND $kode != 1)
                                {                                  
                                  ?>
                                  <br/>                                  
                                  <fieldset >
                                  <legend><?php echo $ket;?> <span class="small s_color">( Comment )</span></legend>
                                        <div class="section">
                                        <label> Comment  </label>
                                          <div>
                                          <textarea id="editor" class="editor" rows="" cols="50" name="editor"><?php if(isset($koment->text_comment) AND $koment->text_comment != ''){ echo $koment->text_comment; }?></textarea>
                                          </div>
                                        </div>                                                                                                            
                                        <div class="section last">
                                          <div>
                                            <a class="uibutton submit_form" >Simpan</a><a class="uibutton special"   onClick="ResetForm()" title="Reset  Form"   >Reset Form</a>
                                          </div>
                                        </div>                                                                              
                                  </fieldset>
                                  </form>
                                  <?php
                                }
                                ?>
                                </div>
                              </div>  
                          </div><!--tab1-->                                                                                                      
                  </div>                  
                  <div class="clear"/></div>                  
                  </div>
                  </div>