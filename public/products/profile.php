<?php 
require_once('../../models/initialization.php');
require_once('../layouts/header.php');
?>
<section class="content-header">
    <h1>
        View Product
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>public/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>public/products/index.php">Products </a></li>
        <li class="active">Product Profile</li>
    </ol>   
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <span id="productPic">
                </span>
                <h3 id="productName" class="profile-username text-center">
                </h3>
                <p id="productDescription" class="text-muted text-center">
                </p>
                <hr>
                <a href="#" id="updateProductPicBtn" class="btn btn-primary btn-block">
                    <b>Change Profile</b>
                </a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About product</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Category</strong>
                <p id="productCategory" class="text-muted"></p>
                <hr>
                <strong><i class="fa fa-trademark margin-r-5"></i> Brand</strong>
                <p id="productBrand" class="text-muted"></p>
                <hr>
                <strong><i class="fa fa-balance-scale margin-r-5"></i> Status</strong>
                <p id="productStatus" class="text-muted"></p>
                <hr>
                <strong><i class="fa fa-money margin-r-5"></i> Status</strong>
                <p id="productPrice" class="text-muted"></p>
                <hr>
                <button id="updateProductBtn" class="btn btn-block btn-primary">Change Details</button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#product_images" data-toggle="tab">
              More Images
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="product_images">
              images  
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!--update product details -->
  <div class="modal fade" id="updateProductModal">
      <div class="modal-dialog">
          <form id="updateProductForm">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Update Product</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="product_id" id="updateProductId" class="form-control" placeholder="Product Name">
                    </div>
                      <div class="form-group">
                          <label for="product">Product Name:</label>
                          <input type="text" name="product" id="updateProduct" class="form-control" placeholder="Product Name">
                      </div>
                      <div class="form-group">
                          <label for="product_description">Product Description:</label>
                          <textarea name="description" id="updateProductDescription" class="form-control" placeholder="Description"></textarea>
                      </div>
                      <div class="form-group">
                          <label for="product_price">Price:</label>
                          <input type="text" name="price" id="updateProductPrice" class="form-control" placeholder="Product Price">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" id="updateProductSubmitBtn" class="btn btn-info">Update</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </form>
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!--update product pic -->
  <div class="modal fade" id="updateProductPicModal">
      <div class="modal-dialog">
          <form id="updateProductPicForm">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Change Product pic</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <span id="alertMessageProfile"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="product_id" id="updateProductPicId" class="form-control" placeholder="Product Name">
                    </div>
                    
                    <div class="form-group">
                      <label for="updateProductPic">Product Pic</label>
                      <input type="file" name="pic" id="updateProductPic">
                      <p class="help-block">Please select qua;ity picture here.</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" id="updateProductPicSubmitBtn" class="btn btn-info">Update</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </form>
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
</section>
<?php require_once('../layouts/footer.php'); ?>
<script src="<?php echo base_url(); ?>public/dist/js/pages/product_profile.js"></script>