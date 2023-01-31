<section class="content-header">
    <h1>dashboard
        <small>Satuan Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">dashboard</i>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->view('messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data dashboard</h3>
            <div class="pull-right">
            </div>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Seri</th>
                        <th>Nama Alat Ukur</th>
                        <th>Tanggal Pertama Kalibrasi</th>
                        <th>Tanggal Kalibrasi Selanjutnya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($row->result() as $key => $data) { ?>
                        <tr>
                            <td style="width:5%;"><?= $no++ ?>.</td>
                            <td><?= $data->no_seri ?></td>
                            <td><?= $data->nama_alat_ukur ?></td>
                            <td><?= $data->pertama_kalibrasi ?></td>
                            <td><?= $data->next_kalibrasi ?></td>
                            <td class="text-center" width="160px">
                                <a href="<?= site_url('dashboard/edit/' . $data->dashboard_id) ?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-pencil"></i> Update
                                </a>
                                <a href="<?= site_url('dashboard/del/' . $data->dashboard_id) ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>