<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut"> 
                                <?php $notif = $this->globals->notification($this->session->userdata('user_id')); ?>  
                                <li> <a href="<?php echo base_url();?>berita/daftar" title="Tambah Transaksi"> <img width="40px" alt="home" src="http://cakra.web.id/pltu/assets/template/fingers/images/icon/shortcut/home.png"><strong>Daftar</strong> </a> </li>
                                <li> <a href="<?php echo base_url() ?>berita/unread/<?php echo $notif['detail']; ?>" title="Messages"> <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/shortcut/mail.png" alt="messages" /><strong>Message</strong></a><?php echo $notif['jml']; ?></li>
                            </ul>
          </div>           
          <div class="clear"></div>     
          <?php echo $this->message->display(); ?>      
<div class="onecolumn" >
                    <div class="header">
                    <span ><span class="ico  gray spreadsheet"></span> <?=$ket?> </span>
                    </div><!-- End header --> 
                    <div class=" clear"></div>                    
                    <div class="content" >                                          	
                    <div class="tab_container" >

                          <div id="tab1" class="tab_content"> 
                              <div class="load_page">                        
                                <?php echo get_header(); ?>
                                <div class="formEl_b">  
                                <form id="validation" action="<?php echo base_url();?>background/upload" method="POST" enctype="multipart/form-data"> 
                                <fieldset >
                                <legend><?php echo $ket;?> <span class="small s_color">( <?php echo $jenis;?> )</span></legend>
                                      <div class="section ">
                                      <label> Background <small>Fileupload</small></label>   
                                      <div> 
                                          <input type="file" class="fileupload" name="userfile" />
                                      </div>
                                      </div>   
                                      <input type="hidden" name="gambar" value="<?php echo get_img(); ?>">
                                      <div class="section last">
                                              <div>
                                                <a class="uibutton submit_form" >Simpan</a><a class="uibutton special"   onClick="ResetForm()" title="Reset  Form"   >Reset Form</a>
                                             </div>
                                             </div>                                     
                                </fieldset>                                                                                          
                                </div>
                              </div>  
                          </div><!--tab1-->   
          </div>
</div></div>