<section class="content-header">
    <h1>Category
        <small>Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</i>
    </ol>
</section>

<!-- Main content -->

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= ucfirst($page) ?>Category</h3>
        <div class="pull-right">
            <a href="<?= site_url('category') ?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i> Backs
            </a>
        </div>
    </div>
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Horizontal Form</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <div class="box-body">
                <form action="<?= site_url('category/process') ?>" method="post">
                    <div class="form-group">
                        <label>Jenis Alat *</label>
                        <input type="hidden" name="id" value="<?= $row->category_id ?>">
                        <input type="text" name="jenisalat" value="<?= $row->jenisalat ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fungsi *</label>
                        <input type="hidden" name="id" value="<?= $row->category_id ?>">
                        <input type="text" name="fungsi" value="<?= $row->fungsi ?>" class="form-control" required>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
    </div>
    </form>
    </form>
</div>
</div>
</div>
</div>