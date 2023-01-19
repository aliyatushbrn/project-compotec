<section class="content-header">
    <h1>pemilik
        <small>Satuan Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">pemiliks</i>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= ucfirst($page) ?>pemilik</h3>
            <div class="pull-right">
                <a href="<?= site_url('pemilik') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Backs
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('pemilik/process') ?>" method="post">
                        <div class="form-group">
                            <label>Pemilik</label>
                            <input type="hidden" name="id" value="<?= $row->pemilik_id ?>">
                            <input type="text" name="pemilik_name" value="<?= $row->pemilik_name ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
                                <i class="fa fa-paper-plane"></i> Save
                            </button>
                            <button type="Reset" class="btn btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</section>