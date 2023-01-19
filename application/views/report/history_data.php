<section class="content-header">
    <h1>
        histories
        <small>History</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="#">histories</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">

    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="table1">
            <thead>
                <tr>
                    <th>History id</th>
                    <th>Nama Alat Ukur </th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width:5%;"><?= $no++ ?>.</td>
                        <td><?= $data->nama_alat_ukur ?></td>
                        <td><?= $data->description ?></td>
                        <td class="text-center" width="160px">
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
    </div>

</section>