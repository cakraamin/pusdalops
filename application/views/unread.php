<div class="topcolumn">

            <div class="logo"></div>
            <ul  id="shortcut">       
                <?php $notif = $this->globals->notification($this->session->userdata('user_id')); ?>         
                <li> <a href="<?php echo base_url() ?>berita/unread/<?php echo $notif['detail']; ?>" title="Messages"> <img src="<?php echo base_url(); ?>assets/template/fingers/images/icon/shortcut/mail.png" alt="messages" /><strong>Message</strong></a><?php echo $notif['jml']; ?></li>
            </ul>   
          </div> 

           <div class="clear"></div> 

           <?=$this->message->display();?>

<div class="onecolumn" >

                        <div class="header"> <span ><span class="ico gray home"></span> Home</span> </div>

                        <div class="clear"></div>

                        <div class="content" >                            
                            <div style="width: 49%; float: left;" class="grid2">
                                    <div class="inner">
                                        <div id="news_update" style="position: relative;" >                                            
                                            <?php                                          
                                            if(count($kueri) > 0)
                                            {
                                                ?>
                                                <ul style="position: absolute; margin: 0pt; padding: 0pt; top: 0px; width: 100%;">
                                                    <?php
                                                    foreach($kueri as $dt_berita)
                                                    {                                                       
                                                        ?>
                                                        <li>
                                                            <?php
                                                            if($dt_berita['gambar_berita'] != "")
                                                            {
                                                                ?>
                                                                <div class="temp_news"><img src="<?php echo base_url(); ?>uploads/gambar/<?php echo $dt_berita['gambar_berita']; ?>" alt="<?php echo $dt_berita['judul_berita']; ?>" width="20px" /></div>
                                                                <?php
                                                            }
                                                            ?>
                                                            <div class="detail_news">                                                                
                                                                <div class="boxtitle min" > <?php echo $dt_berita['judul_berita']; ?></div>
                                                                <p><?php echo word_limiter($dt_berita['content_berita'],30); ?></p>
                                                                <span class="datepost">
                                                                    <?php
                                                                    $tanggal = explode("-", $dt_berita['tgl_berita']);
                                                                    echo $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0];
                                                                    ?></span><span class="morelink"><a href="<?php echo base_url(); ?>dashboard/detil_berita/<?php echo $dt_berita['id_berita']; ?>/<?php echo url_title($dt_berita['judul_berita'],"underscore"); ?>" class="red">Selengkapnya</a></span> </div>
                                                            <br class="clear"/>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            }
                                            else
                                            {
                                                echo '<center><h2>Tidak Ada Berita</h2></center>';
                                            }
                                            ?>                                            
                                        </div>
                                    </div>
                                </div>              
                            <div class="clear"></div>

                        </div>

                    </div>