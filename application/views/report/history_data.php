<section class="content-header">
    <h1>
        Items
        <small>Data Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="#">Items</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->view('messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Product Items</h3>
            <div class="pull-right">
            </div>
        </div>
        <div class="box-body table-responsive">

            <form method="post" class="form-inline">
                <div class="form-group">
                    <label for="exampleInputName2">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Pilih Category</option>
                        <?php $no = 1;
                        foreach ($category->result() as $key => $data) { ?>
                            <option value="<?= $data->category_id ?>"><?= $data->jenisalat ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button name="btn_search" type="submit" class="btn btn-default">Send invitation</button>
            </form>
            <table class="table table-bordered table-striped" id="table1" style="width:150%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Seri</th>
                        <th>Nama Alat Ukur</th>
                        <th>Category</th>
                        <th>Pemilik</th>
                        <th>Tanggal Pertama Kalibrasi</th>
                        <th>Tanggal Kalibrasi Selanjutnya</th>
                    </tr>
                    </td>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($row->result() as $key => $data) { ?>
                        <tr>
                            <td style="width:3%;"> <?= $no++ ?>.</td>
                            <td style="width:10%;">
                                <img src="<?= base_url('assets/logo/' . $data->no_seri . ".png") ?>" style="width:100px">
                            </td>
                            <td> <?= $data->nama_alat_ukur ?></td>
                            <td> <?= $data->jenisalat ?></td>
                            <td> <?= $data->pemilik_name ?></td>
                            <td> <?= $data->pertama_kalibrasi ?></td>
                            <td> <?= $data->next_kalibrasi ?></td>
                            <td>
                                <?php if ($data->image != null) { ?>
                                    <img src="<?= base_url('uploads/product/' . $data->image) ?>" style="width:100px">
                                <?php } ?>
                            </td>
                            <td class="text-center" width="160px">
                                <a href="<?= site_url('history/' . $data->item_id) ?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-pencil-square-o"></i> Details
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>