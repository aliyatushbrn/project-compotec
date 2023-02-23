<section>
    <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- Main content -->
        <!-- /.box-header -->
        <div class="box-body table-responsive">

            <form method="post" class="form-inline">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">month/year</button>
                        </span>
                        <input type="month" name="now" class="form-control" placeholder="Search for...">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        </form>
        <table class="table table-bordered table-striped" id="table1">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Kalibrasi</th>
                    <th>Tanggal Kalibrasi Selanjutnya</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($monitoring->result() as $item) { ?>
                    <tr>
                        <td>
                            <?php if (check_data('p_item', array(
                                'selanjutnya >' => $now,
                                'item_id' => $item->item_id
                            )) == 0) : ?>
                                <span class="label label-info">Done</span>
                            <?php else : ?>
                                <span class="label label-warning">Not Yet</span>
                            <?php endif; ?>
                        </td>

                        <td> <?= $item->nama_alat_ukur ?></td>
                        <td>
                            <?= $item->kalibrasi ?>
                        </td>
                        <td>
                            <?= $item->selanjutnya ?>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</section>
<!-- /.box -->