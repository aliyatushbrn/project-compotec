<section class="content-header">
    <h1>Kalibrasi
        <small>Satuan Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kalibrasi</i>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= ucfirst($page) ?>Kalibrasi</h3>
            <div class="pull-right">
                <a href="<?= site_url('kalibrasi') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php echo form_open_multipart('kalibrasi/process') ?>
                    <div class="form-group">
                        <label>Item *</label>
                        <?php echo form_dropdown(
                            'item',
                            $item,
                            $selecteditem,
                            ['class' => 'form-control', 'required' => 'required']
                        ) ?>
                    </div>
                    <div class="form-group">
                        <label>Lembaga Kalibrasi</label>
                        <input type="hidden" name="id" value="<?= $row->lembaga_kalibrasi ?>">
                        <input type="text" name="lembaga_kalibrasi" value="<?= $row->lembaga_kalibrasi ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No Sertifikat</label>
                        <input type="hidden" name="id" value="<?= $row->no_sertifikat ?>">
                        <input type="text" name="no_sertifikat" value="<?= $row->no_sertifikat  ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>File Sertikat</label>
                        <input type="file" name="file_sertifikat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="hidden" name="id" value="<?= $row->keterangan ?>">
                        <input type="text" name="keterangan" value="<?= $row->keterangan  ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Frekuensi Kalibrasi *</label>
                        <select name="durasi_kalibrasi" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="1x/1y" <?= $row->durasi_kalibrasi == '1x/1y' ? 'selected' : '' ?>>1 kali per satu tahun</option>
                            <option value="1x/2y" <?= $row->durasi_kalibrasi == '1x/2y' ? 'selected' : '' ?>>1 kali per dua tahun</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pembelian</label>
                        <input type="hidden" name="id" value="<?= $row->tanggal_pembelian ?>">
                        <input type="date" name="tanggal_pembelian" value="<?= $row->tanggal_pembelian  ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kalibrasi</label>
                        <input type="hidden" name="id" value="<?= $row->tanggal_kalibrasi ?>">
                        <input type="date" name="tanggal_kalibrasi" value="<?= $row->tanggal_kalibrasi  ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
                            <i class="fa fa-paper-plane"></i> Save
                        </button>
                        <button type="Reset" class="btn btn-flat">Reset</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>

        </div>
    </div>

</section>