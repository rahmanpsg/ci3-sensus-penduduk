<?php $this->load->view('admin/header') ?>
<!-- PAGE CONTENT-->
<div class="page-content--bgf7" id="app">
    <!-- WELCOME-->
    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-4">Selamat Datang di Aplikasi E-Sensus Penduduk Desa Malimpung
                    </h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME-->

    <!-- STATISTIC-->
    <section class="statistic statistic2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--blue">
                        <h2 class="number"><?= $totalPenduduk ?></h2>
                        <span class="desc">Total Penduduk</span>
                        <div class="icon">
                            <i class="zmdi zmdi-male-female"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--red">
                        <h2 class="number"><?= $totalLaki ?></h2>
                        <span class="desc">Laki-laki</span>
                        <div class="icon">
                            <i class="zmdi zmdi-male-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--orange">
                        <h2 class="number"><?= $totalPerempuan ?></h2>
                        <span class="desc">Perempuan</span>
                        <div class="icon">
                            <i class="zmdi zmdi-female"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--green">
                        <h2 class="number"><?= $totalKeluarga ?></h2>
                        <span class="desc">total Keluarga</span>
                        <div class="icon">
                            <i class="zmdi zmdi-home"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <!-- STATISTIC CHART-->
    <!-- <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="recent-report3 m-b-40">
                        <div class="title-wrap">
                            <h3 class="title-3">Laporan Terbaru</h3>
                            <div class="chart-info-wrap">
                                <div class="chart-note">
                                    <span class="dot dot--blue"></span>
                                    <span>Blue</span>
                                </div>
                                <div class="chart-note mr-0">
                                    <span class="dot dot--green"></span>
                                    <span>green</span>
                                </div>
                            </div>
                        </div>
                        <div class="filters m-b-55">
                            <div class="rs-select2--dark rs-select2--md m-r-20 rs-select2--border">
                                <select class="js-select2" name="property">
                                    <option value="migrasi" selected="selected">Laporan Migrasi</option>
                                    <option value="kelahiran">Laporan Kelahiran & Kematian</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="chart-wrap">
                            <canvas id="recent-rep3-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="chart-percent-2 m-b-40">
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="title-3">Karakteristik Penduduk</div>
                            </div>
                            <div class="col-sm-1">
                                <div class="btn-group dropleft">
                                    <button class="color-blue" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php
                                        foreach ($karakteristik as $key => $val) {
                                            echo "<a class='dropdown-item' href='#'>$key</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-note m-b-5">
                            <span class="dot dot--blue"></span>
                            <span>products</span>
                        </div>
                        <div class="chart-note">
                            <span class="dot dot--red"></span>
                            <span>services</span>
                        </div>
                        <div class="chart-wrap m-t-60">
                            <canvas id="karakteristik-penduduk"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- END STATISTIC CHART-->

    <?php $this->load->view('admin/footer') ?>
    <!-- <script src="<?= base_url('/assets/vendor/chartjs/Chart.bundle.min.js') ?>"></script> -->
    <!-- <script src="<?= base_url('/assets/vendor/vue/js/vue-dev.js') ?>"></script> -->
    <!-- <script src="<?= base_url('/assets/vendor/vue/js/vue.js') ?>"></script> -->

    <script>
        // try {

        //     // Recent Report 3
        //     const bd_brandProduct3 = 'rgba(0,181,233,0.9)';
        //     const bd_brandService3 = 'rgba(0,173,95,0.9)';
        //     const brandProduct3 = 'transparent';
        //     const brandService3 = 'transparent';

        //     var data5 = [52, 60, 55, 50, 65, 80, 57, 115];
        //     var data6 = [102, 70, 80, 100, 56, 53, 80, 90];

        //     var ctx = document.getElementById("recent-rep3-chart");
        //     if (ctx) {
        //         ctx.height = 230;
        //         var myChart = new Chart(ctx, {
        //             type: 'line',
        //             data: {
        //                 labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', ''],
        //                 datasets: [{
        //                         label: 'My First dataset',
        //                         backgroundColor: brandService3,
        //                         borderColor: bd_brandService3,
        //                         pointHoverBackgroundColor: '#fff',
        //                         borderWidth: 0,
        //                         data: data5,
        //                         pointBackgroundColor: bd_brandService3
        //                     },
        //                     {
        //                         label: 'My Second dataset',
        //                         backgroundColor: brandProduct3,
        //                         borderColor: bd_brandProduct3,
        //                         pointHoverBackgroundColor: '#fff',
        //                         borderWidth: 0,
        //                         data: data6,
        //                         pointBackgroundColor: bd_brandProduct3

        //                     }
        //                 ]
        //             },
        //             options: {
        //                 maintainAspectRatio: false,
        //                 legend: {
        //                     display: false
        //                 },
        //                 responsive: true,
        //                 scales: {
        //                     xAxes: [{
        //                         gridLines: {
        //                             drawOnChartArea: true,
        //                             color: '#f2f2f2'
        //                         },
        //                         ticks: {
        //                             fontFamily: "Poppins",
        //                             fontSize: 12
        //                         }
        //                     }],
        //                     yAxes: [{
        //                         ticks: {
        //                             beginAtZero: true,
        //                             maxTicksLimit: 5,
        //                             stepSize: 50,
        //                             max: 150,
        //                             fontFamily: "Poppins",
        //                             fontSize: 12
        //                         },
        //                         gridLines: {
        //                             display: false,
        //                             color: '#f2f2f2'
        //                         }
        //                     }]
        //                 },
        //                 elements: {
        //                     point: {
        //                         radius: 3,
        //                         hoverRadius: 4,
        //                         hoverBorderWidth: 3,
        //                         backgroundColor: '#333'
        //                     }
        //                 }


        //             }
        //         });
        //     }

        // } catch (error) {
        //     console.log(error);
        // }

        // try {

        //     // Karakteristik Penduduk
        //     var ctx = document.getElementById("karakteristik-penduduk");
        //     if (ctx) {
        //         ctx.height = 209;
        //         var myChart = new Chart(ctx, {
        //             type: 'doughnut',
        //             data: {
        //                 datasets: [{
        //                     label: "My First dataset",
        //                     data: [60, 40],
        //                     backgroundColor: [
        //                         '#00b5e9',
        //                         '#fa4251'
        //                     ],
        //                     hoverBackgroundColor: [
        //                         '#00b5e9',
        //                         '#fa4251'
        //                     ],
        //                     borderWidth: [
        //                         0, 0
        //                     ],
        //                     hoverBorderColor: [
        //                         'transparent',
        //                         'transparent'
        //                     ]
        //                 }],
        //                 labels: [
        //                     'Products',
        //                     'Services'
        //                 ]
        //             },
        //             options: {
        //                 maintainAspectRatio: false,
        //                 responsive: true,
        //                 cutoutPercentage: 87,
        //                 animation: {
        //                     animateScale: true,
        //                     animateRotate: true
        //                 },
        //                 legend: {
        //                     display: false,
        //                     position: 'bottom',
        //                     labels: {
        //                         fontSize: 14,
        //                         fontFamily: "Poppins,sans-serif"
        //                     }

        //                 },
        //                 tooltips: {
        //                     titleFontFamily: "Poppins",
        //                     xPadding: 15,
        //                     yPadding: 10,
        //                     caretPadding: 0,
        //                     bodyFontSize: 16,
        //                 }
        //             }
        //         });
        //     }

        // } catch (error) {
        //     console.log(error);
        // }
    </script>

    </body>

    </html>
    <!-- end document-->