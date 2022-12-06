<?php

use yii\web\View;
use yii\helpers\Url;
use kartik\helpers\Html;

$this->title = "Dashboard";

$now = (new \DateTime())->format('Y-m-d');

$nextMaintenance = date('d M Y');
$countdowndata = "";
if($maintenance1)
{
  $nextMaintenance = date('d M Y', strtotime( $maintenance1 ));
  $date1 = new DateTime($nextMaintenance);
  $date2 = new DateTime($now);
  $countdowndata = "";
  if($date1 > $date2)
  {
    $interval = $date1->diff($date2);
    $countdowndata =  "";
  }
  else
  {
    $nextMaintenance = date('d M Y', strtotime( $now ));
    $countdowndata = ". <h4 style='color: red;'>Maintenance Date is Today.!</h4>";
  }
}

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Hai <?= Yii::$app->user->identity->user_nama ?></h3>
    </div>

    <div class="card-body">
        <p>Welcome to Predictive Maintenance System of Hemodialysis Reverse Osmosis Water Purification System (PMRO) </p>
    </div>

</div>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">RO Data</h3>
    </div>

    <div class="card-body">
        <div class="row">

        <?php //var_dump(Yii::$app->user->identity) ?>
            <div class="col-2">
                <div class="mb-1">Select RO Device :</div>
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <?= Html::dropDownList('node_name', $nodeId, $nodes, ['class' => 'form-control', 'id' => 'node_name', 'onchange'=>'changeDevice()'] //options
                    ) ?>
            </div>

            <div class="col-2">
                <div class="mb-1">Select Chart Type :</div>
                <select id="chart_type" name="chart_type" class="form-control" onchange="changeChartType();">
                    <option value="Line">Line</option>
                    <option value="Gauge">Gauge</option>
                </select>            
            </div>

            <div class="col-6">
                <div class="mb-1">Select Date : </div>
                <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                          <div class="input-group date" id="start" data-target-input="nearest">
                          <input type="text" name="start" id="input_start" class="form-control datetimepicker-input" data-target="#start" />
                          <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                          <button type="button" onclick="applyFilter()" class="ml-1 btn btn-primary form-control">Filter</button>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                          <button type="reset" onclick="resetFilter()" class="ml-1 btn btn-secondary form-control align-bottom">Reset</button>
                      </div>
                    </div>
                    <!-- <div class="col-6">
                    <div class="input-group date" id="end" data-target-input="nearest">
                        <input type="text" name="end" name="input_end" class="form-control datetimepicker-input" data-target="#end" />
                        <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div> -->
                </div>

            </div>

            <!-- <div class="col-4">
                <div class="mb-1">&nbsp;</div>
                <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                          <button type="button" onclick="applyFilter()" class="ml-1 btn btn-primary form-control">Filter</button>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                          <button type="reset" onclick="resetFilter()" class="ml-1 btn btn-secondary form-control align-bottom">Reset</button>
                      </div>
                    </div>
                </div>
            </div> -->

        </div>

        <div class="row line">
            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pressure</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="pressure-chart-wrapper" style="display:none">
                    <div class="chart">
                        <div id="pressure-chart" style="min-height: 150px;max-height: 300px;"></div>
                    </div>
                    </div>


                    <div id="pressure-loader">
                    <div class="skeleton-loader" style="height: 300px"></div>
                    <div class="mt-3 skeleton-loader" style="height:20px"></div>
                    </div>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="row line">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Conductivity</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="con-chart-wrapper" style="display:none">
                    <div class="chart">
                        <div id="con-chart" style="min-height: 200px;max-height: 300px;"></div>
                    </div>
                    </div>


                    <div id="con-loader">
                    <div class="skeleton-loader" style="height: 300px"></div>
                    <div class="mt-3 skeleton-loader" style="height:20px"></div>
                    </div>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Flow Rate</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="flow-chart-wrapper" style="display:none">
                    <div class="chart">
                        <div id="flow-chart" style="min-height: 200px;max-height: 300px;"></div>
                    </div>
                    </div>


                    <div id="flow-loader">
                    <div class="skeleton-loader" style="height: 300px"></div>
                    <div class="mt-3 skeleton-loader" style="height:20px"></div>
                    </div>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>

        <div class="row gauge" style="display:none">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pressure</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="gauge-chart-wrapper" style="display:none">
                    <div class="chart">
                        <div id="gauge-chart" style="min-height: 200px;max-height: 300px;"></div>
                    </div>
                    </div>


                    <div id="gauge-loader">
                    <div class="skeleton-loader" style="height: 300px"></div>
                    <div class="mt-3 skeleton-loader" style="height:20px"></div>
                    </div>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pressure</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="gauge-con-chart-wrapper" style="display:none">
                    <div class="chart">
                        <div id="gauge-con-chart" style="min-height: 200px;max-height: 300px;"></div>
                    </div>
                    </div>


                    <div id="gauge-con-loader">
                    <div class="skeleton-loader" style="height: 300px"></div>
                    <div class="mt-3 skeleton-loader" style="height:20px"></div>
                    </div>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pressure</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="gauge-flow-chart-wrapper" style="display:none">
                    <div class="chart">
                        <div id="gauge-flow-chart" style="min-height: 200px;max-height: 300px;"></div>
                    </div>
                    </div>


                    <div id="gauge-flow-loader">
                    <div class="skeleton-loader" style="height: 300px"></div>
                    <div class="mt-3 skeleton-loader" style="height:20px"></div>
                    </div>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Machine Learning Predictive Maintenance</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                    </div>
                </div>
                <div class="card-body">

                    <div id="ml-wrapper" style="display:none">
                        <div id="countdown1"></div><br>
                        <p><h4 style="text-align: center;" id="estimationText"><strong>Estimation for Device Failure = <?=$nextMaintenance.$countdowndata?></strong></h4></p>
                    </div>

                    <div id="ml-loader">
                        <div class="skeleton-loader" style="height: 300px"></div>
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

<input type="hidden" id="anomaly" value='<?= json_encode( $Anomaly )?>'/>
<input type="hidden" id="trainingData"/>
<input type="hidden" id="lastData"/>
<input type="hidden" id="dayPrediction"/>

<script>
  'use strict';

  window.pressureChart = null;
  window.conChart = null;
  window.flowChart = null;
  window.gaugeChart = null;

  window.populationChart = null;

  let start = new Date('<?= $start ?>');
  let end = new Date('<?= $end ?>');

  window.nFormatter = (num, digits) => {
    const lookup = [{
        value: 1,
        symbol: ""
      },
      {
        value: 1e3,
        symbol: "k"
      },
      {
        value: 1e6,
        symbol: "M"
      },
      {
        value: 1e9,
        symbol: "G"
      },
      {
        value: 1e12,
        symbol: "T"
      },
      {
        value: 1e15,
        symbol: "P"
      },
      {
        value: 1e18,
        symbol: "E"
      }
    ];
    const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    var item = lookup.slice().reverse().find(function(item) {
      return num >= item.value;
    });
    return item ? (num / item.value).toFixed(digits).replace(rx, "$1") + item.symbol : "0";
  }

  window.applyFilter = async () => {
    dataPressure();
    // populationByGender();

    <?php if ((Yii::$app->user->identity->user_tipe == 'SUPERADMIN') || (Yii::$app->user->identity->user_tipe == 'ADMIN')) : ?>
    //   totalTenant();
    //   totalDataPressure();
    //   dataRecording();

    //   landingPage();
    //   dashboardLogin();
    //   appLogin();
    //   totalOrder();
    <?php endif; ?>
  };

  window.resetFilter = async () => {

    $('#start').datepicker({ dateFormat: 'YYYY-MM-DD'}).datepicker("setDate", start);
    // $('#end').datepicker({ dateFormat: 'YYYY-MM-DD'}).datepicker("setDate", end);

    dataPressure();
  };

  window.addEventListener('load', async (e) => {

    $('#start').datetimepicker({
      format: 'YYYY-MM-DD',
      defaultDate: start,
      disabledHours: [0, 1, 2, 3, 4, 5, 6, 20, 21, 22, 23, 24]
    });

    // $('#end').datetimepicker({
    //   format: 'YYYY-MM-DD',
    //   defaultDate: end,
    //   disabledHours: [0, 1, 2, 3, 4, 5, 6, 20, 21, 22, 23, 24]
    // });

    applyFilter();

    let timerInterval
      Swal.fire({
      title: 'Processing Machine Learning',
      html: 'Please wait while AI is still processing.',
      timer: 10000,
      timerProgressBar: true,
      didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
          b.textContent = Swal.getTimerLeft()
          }, 100)
      },
      willClose: () => {
          clearInterval(timerInterval)
      }
      }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
          console.log('I was closed by the timer')
      }
    });
      
  });


  window.dataPressure = async () => {

    $('#pressure-chart-wrapper').hide();
    $('#pressure-loader').show();

    $.post('<?= Url::to(['/dashboard/data-pressure']) ?>', {
      _csrf: $('#_csrf').attr('content'),
      device: document.getElementById("node_name").value,
      start: $('input[name="start"]').val()
      // ,end: $('input[name="end"]').val()
    }, (data) => {
      const options = {
        chart: {
          type: 'line',
          height: '400px'

        },
        series: [{
          name: 'Sensor 1 (Psi)',
          data: data.s1
        },
        {
          name: 'Sensor 2 (Psi)',
          data: data.s2
        },
        {
          name: 'Sensor 3 (Psi)',
          data: data.s3
        },
        {
          name: 'Sensor 4 (Psi)',
          data: data.s4
        },
        {
          name: 'Sensor 5 (Psi)',
          data: data.s5
        }],
        xaxis: {
          categories: data.date
        }
      }

      $('#pressure-loader').hide();
      $('#pressure-chart-wrapper').show();

      if (pressureChart && pressureChart.rendered) {
        pressureChart.destroy();
      }

      window.pressureChart = new ApexCharts(document.querySelector('#pressure-chart'), options);
      pressureChart.render().then(() => pressureChart.rendered = true);

      ////con chart

      const optionsCon = {
        chart: {
          type: 'line'
          ,height: '400px'
        },
        series: [{
          name: 'Sensor 1 (mS/cm)',
          data: data.s8
        },
        {
          name: 'Sensor 2 (mS/cm)',
          data: data.s9
        }],
        xaxis: {
          categories: data.date
        }
      }

      $('#con-loader').hide();
      $('#con-chart-wrapper').show();

      if (conChart && conChart.rendered) {
        conChart.destroy();
      }

      window.conChart = new ApexCharts(document.querySelector('#con-chart'), optionsCon);
      conChart.render().then(() => conChart.rendered = true);

       ////flow chart

       const optionsFlow = {
        chart: {
          type: 'line'
          ,height: '400px'
        },
        series: [{
          name: 'Sensor 1 (L/min)',
          data: data.s6
        },
        {
          name: 'Sensor 2 (L/min)',
          data: data.s7
        }],
        xaxis: {
          categories: data.date
        }
      }

      $('#flow-loader').hide();
      $('#flow-chart-wrapper').show();

      if (flowChart && flowChart.rendered) {
        flowChart.destroy();
      }

      window.flowChart = new ApexCharts(document.querySelector('#flow-chart'), optionsFlow);
      flowChart.render().then(() => flowChart.rendered = true);

        $('#ml-wrapper').show();
        $('#ml-loader').hide();

/////

var gauge_options = {
          series: [data.s1[data.s1.length-1], data.s2[data.s2.length-1], data.s3[data.s3.length-1], data.s4[data.s4.length-1],data.s5[data.s5.length-1]],
          chart: {
          height: 390,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: '30%',
              background: 'transparent',
              image: undefined,
            },
            dataLabels: {
              name: {
                show: false,
              },
              value: {
                show: false,
              }
            }
          }
        },
        labels: ['Sensor 1', 'Sensor 2', 'Sensor 3', 'Sensor 4', 'Sensor 5'],
        legend: {
          show: true,
          floating: true,
          fontSize: '16px',
          position: 'left',
          offsetX: 160,
          offsetY: 15,
          labels: {
            useSeriesColors: true,
          },
          markers: {
            size: 0
          },
          formatter: function(seriesName, opts) {
            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
          },
          itemMargin: {
            vertical: 3
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
                show: false
            }
          }
        }]
        };

        $('#gauge-loader').hide();
        $('#gauge-chart-wrapper').show();
        var chart = new ApexCharts(document.querySelector("#gauge-chart"), gauge_options);
        chart.render();

        //gauge con

        var gauge_con_options = {
          series: [data.s8[data.s8.length-1], data.s9[data.s9.length-1]],
          chart: {
          height: 390,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: '30%',
              background: 'transparent',
              image: undefined,
            },
            dataLabels: {
              name: {
                show: false,
              },
              value: {
                show: false,
              }
            }
          }
        },
        labels: ['Sensor 1', 'Sensor 2'],
        legend: {
          show: true,
          floating: true,
          fontSize: '16px',
          position: 'left',
          offsetX: 160,
          offsetY: 15,
          labels: {
            useSeriesColors: true,
          },
          markers: {
            size: 0
          },
          formatter: function(seriesName, opts) {
            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
          },
          itemMargin: {
            vertical: 3
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
                show: false
            }
          }
        }]
        };

        $('#gauge-con-loader').hide();
        $('#gauge-con-chart-wrapper').show();
        var chart = new ApexCharts(document.querySelector("#gauge-con-chart"), gauge_con_options);
        chart.render();

        //gauge flow

        var gauge_flow_options = {
          series: [data.s6[data.s6.length-1], data.s7[data.s7.length-1]],
          chart: {
          height: 390,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: '30%',
              background: 'transparent',
              image: undefined,
            },
            dataLabels: {
              name: {
                show: false,
              },
              value: {
                show: false,
              }
            }
          }
        },
        labels: ['Sensor 1', 'Sensor 2'],
        legend: {
          show: true,
          floating: true,
          fontSize: '16px',
          position: 'left',
          offsetX: 160,
          offsetY: 15,
          labels: {
            useSeriesColors: true,
          },
          markers: {
            size: 0
          },
          formatter: function(seriesName, opts) {
            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
          },
          itemMargin: {
            vertical: 3
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
                show: false
            }
          }
        }]
        };

        $('#gauge-flow-loader').hide();
        $('#gauge-flow-chart-wrapper').show();
        var chart = new ApexCharts(document.querySelector("#gauge-flow-chart"), gauge_flow_options);
        chart.render();

        window.dispatchEvent(new Event('resize'));


    });

  };

  function changeChartType() {
    if(document.getElementById("chart_type").value == "Line") {
        $('.line').show();
        $('.gauge').hide();
    } else {
        $('.line').hide();
        $('.gauge').show();
    }
  }

  function changeDevice() {
    applyFilter();
    changeChartType();
  }
//   const myTimeout = setInterval(dataPressure(),20000);

//   window.populationByGender = async () => {

//     $('#livestock-population-wrapper').hide();
//     $('#livestock-population-loader').show();

//     $('#population-chart').hide();
//     $('#population-loader').show();

//     $('#male-bar').css({
//       width: '0%'
//     });

//     $('#female-bar').css({
//       width: '0%'
//     });

//     $.post('<?= Url::to(['/admin/dashboard/population-by-gender']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       start: $('input[name="start"]').val(),
//       end: $('input[name="end"]').val(),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {

//       $('#male-count').text(data.male);
//       $('#female-count').text(data.female);

//       $('#livestock-population-loader').hide();
//       $('#livestock-population-value').text(data.total);
//       $('#livestock-population-wrapper').show();

//       const optionspop = {
//         series: [data.female, data.male],
//         labels: ['Betina', 'Jantan'],
//         chart: {
//           type: 'donut',
//         },
//         plotOptions: {
//           pie: {
//             donut: {
//               labels: {
//                 show: true,
//                 total: {
//                   show: false,
//                 }
//               }
//             }
//           }
//         }
//       };

//       $('#population-loader').hide();
//       $('#population-chart').show();

//       if (populationChart && populationChart.rendered) {
//         populationChart.destroy();
//       }

//       window.populationChart = new ApexCharts(document.querySelector('#pop-chart'), optionspop);
//       populationChart.render().then(() => populationChart.rendered = true);

//       setTimeout(async () => {
//         $('#male-bar').animate({
//           width: ((data.male / data.total) * 100) + '%'
//         }, 1000);

//         $('#female-bar').animate({
//           width: ((data.female / data.total) * 100) + '%'
//         }, 1000);
//       }, 500);
//     });
//   };

//   window.totalTenant = async () => {

//     $('#total-tenant-wrapper').hide();
//     $('#total-tenant-loader').show();

//     $.post('<?= Url::to(['/admin/dashboard/total-tenant']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {

//       $('#total-tenant-loader').hide();
//       $('#total-tenant-value').text(nFormatter(data.value));
//       $('#total-tenant-wrapper').show();

//     });

//   };

//   window.totalDataPressure = async () => {

//     $('#milk-production2-wrapper').hide();
//     $('#milk-production2-loader').show();

//     $.post('<?= Url::to(['/admin/dashboard/total-milk-production']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {
//       $('#milk-production2-loader').hide();
//       $('#milk-production2-value').text(nFormatter(data.value));
//       $('#milk-production2-wrapper').show();
//     });
//   };

//   window.dataRecording = async () => {

//     $('#data-recording-wrapper').hide();
//     $('#data-recording-loader').show();

//     $.post('<?= Url::to(['/admin/dashboard/data-recording']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {

//       $('#data-recording-loader').hide();
//       $('#data-recording-value').text(nFormatter(data.value));
//       $('#data-recording-wrapper').show();

//     });

//   };

//   window.landingPage = async () => {

//     $('#landing-page-wrapper').hide();
//     $('#landing-page-loader').show();

//     $.post('<?= Url::to(['/admin/dashboard/landing-page']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {

//       $('#landing-page-loader').hide();
//       $('#landing-page-value').text(nFormatter(data.value));
//       $('#landing-page-wrapper').show();

//     });

//   };

//   window.dashboardLogin = async () => {

//     $('#dashboard-login-wrapper').hide();
//     $('#dashboard-login-loader').show();

//     $.post('<?= Url::to(['/admin/dashboard/dashboard-login']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {

//       $('#dashboard-login-loader').hide();
//       $('#dashboard-login-value').text(nFormatter(data.value));
//       $('#dashboard-login-wrapper').show();

//     });

//   };

//   window.appLogin = async () => {

//     $('#app-login-wrapper').hide();
//     $('#app-login-loader').show();

//     $.post('<?= Url::to(['/admin/dashboard/app-login']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {

//       $('#app-login-loader').hide();
//       $('#app-login-value').text(nFormatter(data.value));
//       $('#app-login-wrapper').show();

//     });

//   };

//   window.totalOrder = async () => {

//     $('#total-order-wrapper').hide();
//     $('#total-order-loader').show();

//     $.post('<?= Url::to(['/admin/dashboard/total-order']) ?>', {
//       _csrf: $('#_csrf').attr('content'),
//       tenant_id: $('#tenant_id').val()
//     }, (data) => {

//       $('#total-order-loader').hide();
//       $('#total-order-value').text(nFormatter(data.value));
//       $('#total-order-wrapper').show();

//     });

//   };



// let timerInterval;
// Swal.fire({
//   title: 'Auto close alert!',
//   html: 'I will close in <b></b> milliseconds.',
//   timer: 2000,
//   timerProgressBar: true,
//   didOpen: () => {
//     Swal.showLoading()
//     const b = Swal.getHtmlContainer().querySelector('b')
//     timerInterval = setInterval(() => {
//       b.textContent = Swal.getTimerLeft()
//     }, 100)
//   },
//   willClose: () => {
//     clearInterval(timerInterval)
//   }
// }).then((result) => {
//   /* Read more about handling dismissals below */
//   if (result.dismiss === Swal.DismissReason.timer) {
//     console.log('I was closed by the timer')
//   }
// });

const myTimeout = setTimeout(getDataML, 5000);

function getDataML() {
  console.log("dataML=",<?=$dataML?>);
  var parsed_data = (<?=$dataML?>);
  console.log("parsed_data=",parsed_data);

  // console.log(JSON.parse(<?=$dataML?>));
  // parsed_data = JSON.parse(<?=$dataML?>);

  document.getElementById('trainingData').value = JSON.stringify( parsed_data[0]) ;
  document.getElementById('lastData').value =JSON.stringify( parsed_data[1]) ;

  if(parsed_data[2])
  {
    TrainingML(parsed_data[0],parsed_data[3],parsed_data[2]);
  }
  else
  {
    TrainingML(parsed_data[0],parsed_data[1],parsed_data[2]);
  }
}


function TrainingML(trainingData,lastData,idData)
{

/////trial ML
  const net = new brain.recurrent.LSTMTimeStep({
              inputSize: 9,
              hiddenLayers: [10],
              outputSize: 9,
              learningRate: 0.01,
              decayRate: 0.0099,
              });

  net.train(trainingData, { log: true, errorThresh: 0.09 });

  // now we're cookin' with gas!
  const forecast = net.forecast(
      [ lastData ],
      1
  );

  console.log('next n predictions', forecast);
  console.log("this.trainingData=", JSON.parse( document.getElementById('trainingData').value) );
  console.log("this.lastData=",JSON.parse( document.getElementById('lastData').value) );

  var forecastN = forecast;
  var i=0,n=0,z=0,x=0;
  var degradationValueTotal = 0;
  var degradationValue = 0.0001;
  var failureTimes = [];
  for (i; i < forecast[0].length; i++) 
  {   
    var n=0;
    while((forecastN[0][i]>=3 && forecastN[0][i]<=10))
    {
      if(forecastN[0][i] < 6.25)
      { //jika data trend keatas maka di tambahkan degradation
        forecastN[0][i] -= degradationValue;
      }
      else
      {
        forecastN[0][i] += degradationValue;
      }
      
      if(forecastN[0][i]<3 || forecastN[0][i]>10)
      {
        console.log("detected",forecastN[0][i],"in",n); 
        failureTimes[i] = n;
        z+=n;
      }
      if(++n>100000)break;
    }
    console.log("forecastN=",forecastN,"i=",i);
  }
  x = z/8;
  console.log("failureTimes=",failureTimes,"z=",z," rata2=",x);
  document.getElementById('dayPrediction').value = parseInt( (x*5)/60/24 );
  console.log(document.getElementById('dayPrediction').value);
  
  // var dataPredict = new FormData();
  // dataPredict.append("predict", forecast);
  // dataPredict.append("id", idData);

// if(idData)
// {
//   $.ajax({
//         type: "POST",
//         enctype: 'multipart/form-data',
//         url: "actionSavePredict.php",
//         data: dataPredict,
//         processData: false,
//         contentType: false,
//         cache: false,
//         timeout: 600000,
//         success: function (data) {
//       var rv;
//       try {
//         rv = JSON.parse(data);
//         console.log(rv.status,rv.info,rv);

//       } catch (e) {
//         //error data not json
//         Swal.fire(
//                 'error actionSavePredict!',
//                 'Error Input Data, '+data,
//                 'error'
//                 );
            
//             console.log("ERROR : ", data);
//       } 

//     },
//     error: function (e) {

//         console.log("ERROR : ", e);

//     }
//     }); //end of ajax
// }

// var dataPredict = new FormData();
//   dataPredict.append("predict", document.getElementById('dayPrediction').value);

if(document.getElementById('dayPrediction').value > 0)
{
  
  console.log(addDays(Date.now(),document.getElementById('dayPrediction').value));
  let dateMaintenance = addDays(Date.now(),document.getElementById('dayPrediction').value).toISOString().slice(0, 10);

  document.getElementById('estimationText').innerHTML = "<strong>Estimation for Device Failure = "+dateMaintenance+" </strong>";

    $.post('<?= Url::to(['/dashboard/create-notif']) ?>', {
          _csrf: $('#_csrf').attr('content'),
          notif_title:"ML Device Failure",
          notif_text: "Machine Learning Info : \n<strong>Estimation for Device Failure = "+dateMaintenance+" </strong>"
        }, (data) => {
                        Swal.fire({
                        icon: 'success',
                        html: '<h4>Notification will be sent ASAP.</h4>',
                        timer:4000
                      });

        });
        
//   $.ajax({
//         type: "POST",
//         enctype: 'multipart/form-data',
//         url: "actionPredict.php",
//         data: dataPredict,
//         processData: false,
//         contentType: false,
//         cache: false,
//         timeout: 600000,
//         success: function (data) {
//       var rv;
//       try {
//         rv = JSON.parse(data);
//         console.log(rv.status,rv.info,rv);

//       } catch (e) {
//         //error data not json
//         Swal.fire(
//                 'error!',
//                 'Error Input Data, '+data,
//                 'error'
//                 );
            
//             console.log("ERROR : ", data);
//       } 

//     },
//     error: function (e) {

//         console.log("ERROR : ", e);

//     }
//     }); //end of ajax
}

Swal.fire({
    icon: 'success',
    html: '<h4>Prediction Success!</h4>',
    timer:4000
  });
///end trial ML

}

function addDays(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  return result;
}

  //  //interval 60 sec to check 
  setInterval(function(){ 
     console.log("interval to show anomaly");
     if(document.getElementById("anomaly").value != "") {

        this.anomaly = JSON.parse(document.getElementById("anomaly").value);

        console.log(this.anomaly);
        if ( typeof this.anomaly === 'object' && !Array.isArray(this.anomaly) && this.anomaly !== null ) {
          
          console.log("anomaly detected");
          let detailsensor = "";
          for (const [key, value] of Object.entries(this.anomaly)) {
                console.log(`${key}: ${value}`);
                detailsensor = detailsensor+"<h5 style='color: red;'>"+key+" = "+value+"</h5>";
          }
          // let detailsensor = this.anomaly.forEach(getDetailSensor);
          let infotext = 'System has detected anomaly data. <hr> '+detailsensor+' <hr> Please check the RO device.!';
          this.anomalyflag = false;

          //trial sent notif
          let dateMaintenance = new Date().toISOString().slice(0, 10);

          $.post('<?= Url::to(['/dashboard/create-notif']) ?>', {
                _csrf: $('#_csrf').attr('content'),
                notif_title:"Data Anomaly Report",
                notif_text: "Data Anomaly Report: \n"+infotext
              }, (data) => {
                              Swal.fire({
                              icon: 'success',
                              html: '<h4>Notification will be sent ASAP.</h4>',
                              timer:4000
                            });
              });

            Swal.fire({
                      icon: 'warning',
                      title: 'Warning!',
                      text: infotext,
                      timer: 5000
                    });
            document.getElementById("anomaly").value = "";
        }
     }

   }, 60000);
</script>