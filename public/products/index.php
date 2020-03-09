<?php 
require_once('../../models/initialization.php');
require_once('../layouts/header.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Products
        <small>version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>/public/index.php">
                <i class="fa fa-dashboard"></i> Home
            </a>
        </li>
        <li><a href="<?php echo base_url(); ?>/public/products/index.php">Products</a></li>
        <li class="active">Products</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Products</h3>
                    <div class="box-tools pull-right">
                        <button type="button" id="newProductBtn" class="btn btn-sm btn-info">
                            <i class="fa fa-plus"></i> New Product
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="loadProducts" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>CATEGORY</th>
                                <th>BRAND NAME</th>
                                <th>PRODUCT</th>
                                <th>STATUS</th>
                                <th>PRICE</th>
                                <th>VIEW</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>CATEGORY</th>
                                <th>BRAND NAME</th>
                                <th>PRODUCT</th>
                                <th>STATUS</th>
                                <th>PRICE</th>
                                <th>VIEW</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="modal fade" id="newProductModal">
        <div class="modal-dialog">
            <form id="newProductForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">New Product</h4>
                    </div>
                    <div class="modal-body">
                        <?php 
                        $categories = new Categories();
                        $all_categories = $categories->find_categories_by_user_id($session->user_id);
                        $count = $all_categories->rowCount();
                        if($count<= 0){ ?>
                             <div class="form-group">
                                <div class="alert alert-danger alert-dismissible">
                                    No Categories entered yet
                                </div>
                             </div>
                            <?php die(); ?>
                        <?php } ?>

                        <?php 
                        $brands = new Brands();
                        $all_brands = $brands->find_products_by_user_id($session->user_id);
                        $count = $all_brands->rowCount();
                        if($count<= 0){ ?>
                             <div class="form-group">
                                <div class="alert alert-danger alert-dismissible">
                                    No Brands entered yet
                                </div>
                             </div>
                            <?php die(); ?>
                        <?php } ?>

                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option disabled selected>Choose a category</option>
                                <?php while($category = $all_categories->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <option value="<?php echo htmlentities($category['id']); ?>">
                                        <?php echo htmlentities($category['category_name']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <select name="brand_id" id="brand" class="form-control">
                                <option disabled selected>Choose a brand</option>
                                <?php while($brand = $all_brands->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <option value="<?php echo htmlentities($brand['id']); ?>">
                                        <?php echo htmlentities($brand['brand_name']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product">Product Name:</label>
                            <input type="text" name="product" id="product" class="form-control" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <label for="product_description">Product Description:</label>
                            <textarea name="description" id="product_description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Price:</label>
                            <input type="text" name="price" id="product_price" class="form-control" placeholder="Product Price">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="newProductSubmitBtn" class="btn btn-info">Save</button>
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
<script src="<?php echo base_url(); ?>public/dist/js/pages/products.js"></script>