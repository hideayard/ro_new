<?php

use yii\helpers\Url;

$this->title = "Dashboard";
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Hai <?= Yii::$app->user->identity->user_nama ?></h3>
    </div>

    <div class="card-body">
        <p>Welcome to Predictive Maintenance System of Haemodialysis Reverse Osomis Water Purificarion System (PMRO) </p>
    </div>

</div>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">RO Data</h3>
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-4">
                <div class="mb-1">Periode data</div>
                <div class="row">
                    <div class="col-6">
                    <div class="form-group">
                        <div class="input-group date" id="start" data-target-input="nearest">
                        <input type="text" name="start" class="form-control datetimepicker-input" data-target="#start" />
                        <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="input-group date" id="end" data-target-input="nearest">
                        <input type="text" name="end" class="form-control datetimepicker-input" data-target="#end" />
                        <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>

            <div class="col-4">
                <div class="mb-1">&nbsp;</div>
                <div class="row">
                    <div class="col-6">
                    <div class="form-group">
                        <button type="button" onclick="applyFilter()" class="ml-1 btn btn-primary form-control">Filter</button>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                        <button type="reset" class="ml-1 btn btn-secondary form-control align-bottom">Reset</button>
                    </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pertumbuhan Produksi Susu</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="milk-chart-wrapper" style="display:none">
                    <div class="chart">
                        <div id="milk-chart" style="min-height: 200px;max-height: 500px;"></div>
                    </div>
                    </div>


                    <div id="milk-loader">
                    <div class="skeleton-loader" style="height: 500px"></div>
                    <div class="mt-3 skeleton-loader" style="height:20px"></div>
                    </div>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
</div>

<?php if(Yii::$app->user->identity->user_tipe=="TRAINER") { ?>
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Your Student's Enrollment</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Task</th>
                    <th>Progress</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($student_enroll as $key => &$enroll) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $enroll->enrollCourse->course_type ?></td>
                        <td><?= $enroll->enrollCourse->course_title ?>
                            <?php
                            foreach($progress[$key] as $key => &$value)
                            {
                                $nilai = ($value["ep_nilai"] != null)?$value["ep_nilai"] : 0 ;
                                echo "<br>Assessment ".($key+1)." ( Mark : ".$nilai.")";
                            }
                            ?>
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?=($enroll->enrollProgress)?>%" aria-valuenow="<?=($enroll->enrollProgress)?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            (<?=($enroll->enrollProgressText)?> Section ) <?=($enroll->enrollProgress)?>%
                        </td>
                        <td><?= date("Y-m-d", strtotime($enroll->enroll_created_at)); ?></td>
                        <td><a href="<?= Url::to(['site/enroll', 'id' => $enroll->enroll_id]) ?>" class="btn btn-primary">Detail</a></td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>
