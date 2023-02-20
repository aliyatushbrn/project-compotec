 <!-- Main content -->
 <section class="content">
     <div class="col-md-6">
         <div class="box">
             <a href="<?= site_url('dashboard') ?>"></a>
             <div class="box-header with-border">
                 <h3 class="box-title">Barang yang telah dikalibrasi (Kadaluarsa)</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
                 <table class="table table-bordered">
                     <tr>
                         <th>Nama Barang</th>
                         <th>Tanggal Kalibrasi</th>
                         <th>Tanggal Kalibrasi Selanjutnya</th>
                     </tr>
                     <?php $no = 1;
                        foreach ($row->result() as $key => $data) { ?>
                         <tr>
                             <td>
                                 <?= $data->nama_alat_ukur  ?>
                             </td>
                             <td>
                                 <div class="badge bg-blue" style="width: 70%"> <?= $data->kalibrasi ?>
                                 </div>
                             </td>
                             <td>
                                 <div class="badge bg-red" style="width: 70%"> <?= $data->selanjutnya ?>
                                 </div>
                             </td>
                         </tr>
                     <?php } ?>
                 </table>
                 <!-- /.box-body -->
                 <div class="box-footer clearfix">
                     <ul class="pagination pagination-sm no-margin pull-right">
                         <li><a href="<?= site_url('dashboard') ?>">&laquo;</a></li>
                         <li><a href="<?= site_url('dashboard') ?>">1</a></li>
                         <li><a href="<?= site_url('dashboard') ?>">2</a></li>
                         <li><a href="<?= site_url('dashboard') ?>">3</a></li>
                         <li><a href="<?= site_url('dashboard') ?>">&raquo;</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
     <!-- /.box -->

     <!-- Main content -->
     <div class="col-md-6">
         <div class="box">
             <div class="box-header with-border">
                 <h3 class="box-title">Barang yang akan di kalibrasi</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
                 <table class="table table-bordered">
                     <th>Nama Barang</th>
                     <th>Tanggal Kalibrasi</th>
                     <th>Tanggal Kalibrasi Selanjutnya</th>
                     </tr>
                     <?php foreach ($kalibrasi as $item) : ?>
                         <tr>
                             <td> <?= $item->nama_alat_ukur ?></td>
                             <td>
                                 <div class="badge bg-blue" style="width: 70%"> <?= $data->kalibrasi ?>
                                 </div>
                             </td>
                             <td>
                                 <div class="badge bg-red" style="width: 70%"> <?= $data->selanjutnya ?>
                                 </div>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </table>
             </div>
             <!-- /.box-body -->
             <div class="box-footer clearfix">
                 <ul class="pagination pagination-sm no-margin pull-right">
                     <li><a href="<?= site_url('dashboard') ?>">&laquo;</a></li>
                     <li><a href="<?= site_url('dashboard') ?>">1</a></li>
                     <li><a href="<?= site_url('dashboard') ?>">2</a></li>
                     <li><a href="<?= site_url('dashboard') ?>">3</a></li>
                     <li><a href="<?= site_url('dashboard') ?>">&raquo;</a></li>
                 </ul>
             </div>
         </div>
     </div>
     </div>
 </section>
 <!-- /.box -->