<form action="user/all" method="POST" enctype="multipart/form-data">

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
                            <?php                          
                            if($roles == 3 OR $roles == 1)
                            {                                                                   
                                ?>
                                <div style="width: 49%; float: left;" class="grid2">                                
                                    <div class="inner">
                                        <center><h1>Selamat Datang Di Aplikasi Pengelolaan Limbah PLTU<br>Tanjung Jati B Jepara</h1></center>
                                    </div>
                                </div>
                                <div style="width: 49%; float: left;" class="grid2">
                                    <div class="inner">
                                        <div style="position: relative;" >
                                            <?php                                            
                                            if(count($berita) > 0)
                                            {
                                                ?>                                                
                                                    <?php
                                                    foreach($berita as $dt_berita)
                                                    {                                                                                                                                    
                                                            ?>                             
                                                            <div class="detail_news">
                                                                <div class="boxtitle min" > <?php echo $dt_berita->judul_berita; ?></div>
                                                                <?php
                                                                if($dt_berita->gambar_berita != "")
                                                                {
                                                                    ?>
                                                                    <div class="temp_news"><img src="<?php echo base_url(); ?>uploads/gambar/<?php echo $dt_berita->gambar_berita; ?>" alt="<?php echo $dt_berita->judul_berita; ?>" width="200px" style="float:left; margin-right:10px; margin-top:7px; border:solid 1px #EEE; padding:2px;" /></div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <p><?php echo $dt_berita->content_berita; ?></p>
                                                                <span class="datepost">
                                                                    <?php
                                                                    $tanggal = explode("-", $dt_berita->tgl_berita);
                                                                    echo $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0];
                                                                    ?></span></div>
                                                            <br class="clear"/>                                                        
                                                        <?php
                                                    }
                                                    ?>                                                
                                                <?php
                                            }
                                            else
                                            {
                                                echo '<center><h2>Tidak Ada Berita</h2></center>';
                                            }
                                            ?>
                                            <div class="clear"></div> 
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <center><h1>Selamat Datang Di Aplikasi Pengelolaan Limbah PLTU<br>Tanjung Jati B Jepara</h1></center>
                                <?php
                            }
                            ?>                            
                            <div class="clear"></div>

                        </div>

                    </div>