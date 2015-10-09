<div class="topcolumn">
            <div class="logo"></div>
                            <ul  id="shortcut">
                                <li> <a href="<?=base_url()?>kebencanaan/daftar" title="Back To home"> <img src="<?=base_url()?>assets/template/fingers/images/icon/shortcut/home.png" alt="home" width="40px"/><strong>Daftar</strong> </a> </li>
                            </ul>     
          </div>  
          <div class="clear"></div>          
                    <div class="clear"></div>
                  <?=$this->message->display();?>
                  <div class="onecolumn" >
                  <div class="header"><span ><span class="ico  gray user"></span><?=$ket?></span> </div><!-- End header --> 
                  <div class="clear"></div>
                  <div class="content" >                      
                    <div class="tab_container" >
                          <div id="tab1" class="tab_content"> 
                              <div class="load_page">                                                         
                                <div class="formEl_b">  
                                <form id="validation" action="<?=base_url()?>kebencanaan/<?=$link?>" method="POST" enctype="multipart/form-data"> 
                                <fieldset >
                                <legend><?=$ket?> <span class="small s_color">( <?=$jenis?> )</span></legend>                                                                                                                                                   
                                      <div class="section ">
                                      <label> File Import </label>   
                                      <div> 
                                          <input type="file" class="fileupload" name="userfile" />
                                          <br/><br/><a href="<?=base_url()?>kebencanaan/sample">Sample File Import</a>
                                      </div>
                                      </div>                                      
                                      <div class="section last">
                                      <div>
                                        <a class="uibutton submit_form" >Import</a>
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