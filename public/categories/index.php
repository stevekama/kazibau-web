<?php 
require_once('../../models/initialization.php');
require_once('../layouts/header.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Categories
        <small>version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>/public/index.php">
                <i class="fa fa-dashboard"></i> Home
            </a>
        </li>
        <li><a href="<?php echo base_url(); ?>/public/categories/index.php">Categories</a></li>
        <li class="active">Categories</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Categories</h3>
                    <div class="box-tools pull-right">
                        <button type="button" id="newCategoryBtn" class="btn btn-sm btn-info">
                            <i class="fa fa-plus"></i> New Category
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="loadCategories" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>CATEGORY NAME</th>
                                <th>DESCRIPTION</th>
                                <th>BRANDS</th>
                                <th>PRODUCTS</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>CATEGORY NAME</th>
                                <th>DESCRIPTION</th>
                                <th>BRANDS</th>
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
    <div class="modal fade" id="newCatgoryModal">
        <div class="modal-dialog">
            <form id="newCatgoryForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">New Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Category Name:</label>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Category Name">
                        </div>
                        <div class="form-group">
                            <label for="category_description">Category Description:</label>
                            <textarea name="description" id="category_description" class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="newCategorySubmitBtn" class="btn btn-info">Save</button>
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
<script src="<?php echo base_url(); ?>public/dist/js/pages/categories.js"></script>