<div class="box">
    <div class="container">
      <div class="row">
                <?php 


                    if($menus!=""){
                      foreach($menus as $value){ ?> 
      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-8">                        
      <div class="card h-100 border-0 shadow">
        <a href="<?=base_url().$value['menu_link']?>">
        <div class="card-img-top">
          <div class="embed-responsive embed-responsive-4by3">
            <div class="embed-responsive-item">
              <img src="<?=base_url()?>assets/images/<?=$value['menu_icon']?>" alt="" class="img-fluid w-100" />
            </div>
          </div>
        </div>
        <div class="card-body">
          <p><?=$value['menu_name']?></p>
        </div>
      </div>
    </div>
        <?php } } ?>
    
    </div>    
    </div>
</div>