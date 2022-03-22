<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>
    <?php if($user_session['role'] == 'admin') : ?>
        <div class="d-flex bd-highlight mb-3">
            <div class="">
                <h4 class="text-uppercase">Activity</h4>
                <h5 class="text-secondary">Last Log</h5>
            </div>
            <div class="ms-auto">
                <a href="<?= base_url('PDFController/PDFForAdmin') ?>" target="_blank" class="badge bg-warning text-white border-0 mb-3 fs-5">
                    <i class='bx bx-printer'></i>
                </a>
            </div>
        </div>    
        <div class="row mt-4">
            <div class="col-md-4">
                <ul class="list">
                    <?php foreach($admin_log as $log) : ?>
                        <li class="list-item">
                            <h6 class="experience-title"><?= $log['temperature']; ?>&deg -
                                <span class="place"><?= $log['location']; ?></span>
                            </h6>
                            <?= $log['fullname']; ?> <span class="orange fw-bold">ON</span> <?= date("jS F Y", strtotime($log['date'])); ?> | <?= date("H:i", strtotime($log['time'])); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-8">
                <canvas id="myChart" width="400" height="200"></canvas>
                <?php
                    $monthAdmin = "";            // string kosong untuk menampung data tahun
                    $total_logs = null;    // nilai awal null untuk menampung data total siswa
                    $year = "";

                    // looping data dari $chartSiswa
                    foreach ($chartAdmin as $chart) {
                        $monthAdmin .= "'$chart->month'" . ",";
                        $total_logs .= "'$chart->total_logs'" . ",";
                        $year = date("Y");
                    }
                ?>
                <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?= $monthAdmin; ?>],
                            datasets: [{
                                label: 'Log',
                                data: [<?= $total_logs; ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Log Statistics Per Month in <?= $year; ?>'
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    <?php endif; ?>

    <?php if($user_session['role'] == 'general') : ?>
        <h4 class="text-uppercase">Activity</h4>
        <h5 class="text-secondary">Last Week</h5>
        <div class="row mt-4">
            <div class="col-md-4">
                <ul class="list">
                    <?php foreach($user_log as $log) : ?>
                    <li class="list-item">
                        <h6 class="experience-title"><?= $log['temperature']; ?>&deg -
                            <span class="place"><?= $log['location']; ?></span>
                        </h6>
                        <span class="orange fw-bold">ON</span> <?= date("jS F Y", strtotime($log['date'])); ?> | <?= date("H:i", strtotime($log['time'])); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-8">
                <canvas id="myChart" width="400" height="200"></canvas>
                <?php
                    $day = "";            // string kosong untuk menampung data tahun
                    $total_user_logs = null;    // nilai awal null untuk menampung data total siswa
                    $monthGeneral = "";

                    // looping data dari $chartSiswa
                    foreach ($chartGeneral as $chart) {
                        $total_user_logs .= "'$chart->total_user_logs'" . ",";
                        $monthGeneral = date("F");
                        $day .= "'$chart->day $monthGeneral'" . ",";
                    }
                ?>
                <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?= $day; ?>],
                            datasets: [{
                                label: 'Activity',
                                data: [<?= $total_user_logs; ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Log Statistics in <?= $monthGeneral; ?>'
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    <?php endif; ?>
<?= $this->endSection(); ?>