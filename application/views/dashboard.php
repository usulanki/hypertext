

  <?php include 'layouts/header.php' ?>


  <div style="margin-top: 100px;" class="app-main">
 
        <div class="container">
              <div class="row">

                <?php 

                    if($menus!=""){
                      foreach($menus as $value){ ?> 

                    <div class="dash-boxes">
                        <a href="<?=base_url().$value['menu_link']?>">
                          <div class="dash-icon">
                            <img class="dash-icons" src="<?=base_url()?>assets/images/<?=$value['menu_icon']?>">
                          </div>
                        </a>
                        <div><?=$value['menu_name']?></div>
                     </div>

                    <?php } } ?>

                 

                



              </div>
        </div>

  </div>

        
  <?php include 'layouts/footer.php' ?>