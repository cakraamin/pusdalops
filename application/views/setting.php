<div class="topcolumn">

            <div class="logo"></div>                            
            <ul  id="shortcut">        
                <?php $notif = $this->globals->notification($this->session->userdata('user_id')); ?>                
                <li> <a href="<?php echo base_url() ?>berita/unread/<?php echo $notif['detail']; ?>" title="Messages"> <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/shortcut/mail.png" alt="messages" /><strong>Message</strong></a><?php echo $notif['jml']; ?></li>
            </ul>   
          </div>  

          <div class="clear"></div>          

                    <div class="clear"></div>

                  <?php echo $this->message->display(); ?>

                  <div class="onecolumn" >

                  <div class="header"><span ><span class="ico  gray user"></span><?php echo $ket;?></span> </div><!-- End header --> 

                  <div class="clear"></div>

                  <div class="content" >                      

                    <div class="tab_container" >



                          <div id="tab1" class="tab_content"> 

                              <div class="load_page">                        

                                 

                                <div class="formEl_b">  

                                <form id="validation" action="<?php echo base_url(); ?><?php echo $link; ?>" method="POST" enctype="multipart/form-data"> 

                                <fieldset >

                                <legend><?php echo $ket; ?> <span class="small s_color">( <?php echo $jenis;?> )</span></legend>

                                      <div class="section">

                                      <label> Lokasi Database </label>

                                      <div>

                                      <input type="text" name="path" id="path"  class="full" value="<?php if($kueri->dir_direktori){ echo $kueri->dir_direktori; } ?>" placeholder="Path Database"/>

                                      </div>

                                      </div>                                                                                                                      

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