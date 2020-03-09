<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in intialization file 
require_once('../../models/initialization.php');

$products = new Products();

$data = array();

if($_POST['action'] == "FETCH_NUM_PRODUCTS"){
    $user_id = $session->user_id;
    $user_products = $products->find_products_by_user_id($user_id);
    $num_products = $user_products->rowCount();
    $data['total'] = $num_products;
    echo json_encode($data);
}


if($_POST['action'] == "FIND_PRODUCT_BY_ID"){
    $product_id = htmlentities($_POST['product_id']);
    $current_product = $products->find_product_by_id($product_id);
    if(!$current_product){
        $data['message'] = "errProduct";
        echo json_encode($data);
        die();
    }
    echo json_encode($current_product);
}

if($_POST['action'] == "FIND_PRODUCTS_FOR_LANDING_PAGE"){
    $landing_products = $products->find_all_products();
    $count = $landing_products->rowCount();
    if($count > 0){
        while($landing_product = $landing_products->fetch(PDO::FETCH_ASSOC)){ ?>
            <div class="col-lg-4 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="<?php echo base_url(); ?>landing/img/products/<?php echo htmlentities($landing_product['product_pic']); ?>" alt="">
                        <div class="sale pp-sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="#">+ Quick View</a></li>
                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <?php 
                    $categories = new Categories(); 
                    $current_catgory = $categories->find_category_by_id($landing_product['category_id']);
                    ?>
                    <div class="pi-text">
                        <div class="catagory-name">
                            <?php if(!$current_catgory){
                                echo "No Category";
                            }else{
                                echo htmlentities($current_catgory['category_name']);
                            } ?>
                        </div>
                        <a href="#">
                            <h5><?php echo htmlentities($landing_product['product']); ?></h5>
                        </a>
                        <div class="product-price">
                            Kes.<?php echo htmlentities($landing_product['product_price']); ?>
                            <!-- <span>Kes.35.00</span> -->
                        </div>
                    </div>
                </div>
            </div>
      <?php  }
    }
}