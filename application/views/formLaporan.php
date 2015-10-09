<div class="topcolumn">

            <div class="logo"></div>
            <ul  id="shortcut">            
                <?php $notif = $this->globals->notification($this->session->userdata('user_id')); ?>            
                <li> <a href="<?php echo base_url() ?>berita/unread/<?php echo $notif['detail']; ?>" title="Messages"> <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/shortcut/mail.png" alt="messages" /><strong>Message</strong></a><?php echo $notif['jml']; ?></li>
            </ul>   
          </div>  

          <div class="clear"></div>          

                    <div class="clear"></div>

                  <?=$this->message->display();?>

                  <div class="onecolumn" >

                  <div class="header"><span ><span class="ico  gray spreadsheet"></span>Rekap Laporan</span> </div><!-- End header --> 

                  <div class="clear"></div>

                  <div class="content" >                                      

                              <div class="load_page">                        

                                 

                                <div class="formEl_b">  

                                <form id="validation" action="<?=base_url()?>laporan/generate_sekolah/<?=$id?>" method="POST"> 

                                <fieldset >

                                <legend>Generate Laporan Sekolah <span class="small s_color">( Laporan )</span></legend>                                                                                                             

                                      <div class="section">

                                          <label>Tanggal Abasensi <small>Pilih Tanggal</small></label>   

                                          <div><input type="text"  id="birthday" class=" birthday  small " name="birthday"  /></div>

                                      </div>                                                                                               

                                      <div class="section last">

                                      <div>

                                        <a class="uibutton submit_form" >Generate Report</a>

                                     </div>

                                     </div>                                     

                                </fieldset>

                                </form>

                                </div>                                                                                                    

                  </div>                  

                  <div class="clear"/></div>                  

                  </div>

                  </div>