<?php 
require_once('../../models/initialization.php');
require_once('../layouts/header.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Brands
        <small>version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>/public/index.php">
                <i class="fa fa-dashboard"></i> Home
            </a>
        </li>
        <li><a href="<?php echo base_url(); ?>/public/brands/index.php">Brands</a></li>
        <li class="active">Brands</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Brands</h3>
                    <div class="box-tools pull-right">
                        <button type="button" id="newBrandBtn" class="btn btn-sm btn-info">
                            <i class="fa fa-plus"></i> New Brand
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="loadBrands" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>CATEGORY</th>
                                <th>BRAND NAME</th>
                                <th>DESCRIPTION</th>
                                <th>PRODUCTS</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>CATEGORY</th>
                                <th>BRAND NAME</th>
                                <th>DESCRIPTION</th>
                                <th>PRODUCTS</th>
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
    <div class="modal fade" id="newBrandModal">
        <div class="modal-dialog">
            <form id="newBrandForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">New Brand</h4>
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
                            <label for="brand">Brand Name:</label>
                            <input type="text" name="brand" id="brand" class="form-control" placeholder="Brand Name">
                        </div>
                        <div class="form-group">
                            <label for="brand_description">Brand Description:</label>
                            <textarea name="description" id="brand_description" class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="newBrandSubmitBtn" class="btn btn-info">Save</button>
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
<script src="<?php echo base_url(); ?>public/dist/js/pages/brands.js"></script>