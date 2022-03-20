<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>
<?php if($user_session['role'] == 'admin') : ?>
    <a href="<?= base_url('logs/create'); ?>" class="badge bg-primary mb-5 text-decoration-none text-white fs-5"><i class='bx bx-plus-circle me-1'></i> New Log</a>
<?php endif; ?>
<table id="data-log" class="table table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>Temperature</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($logs as $log) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= date("jS F Y", strtotime($log['date'])); ?></td>
                <td><?= date("H:i", strtotime($log['time'])); ?></td>
                <td><?= $log['location']; ?></td>
                <td><?= $log['temperature']; ?>&deg</td>
                <td>
                    <a href="#detailLog" class="badge bg-info text-white border-0 detailLog" data-bs-toggle="modal" 
                        data-date="<?= date("d F Y", strtotime($log['date'])); ?>" data-time="<?= date("H:i", strtotime($log['time'])); ?>" data-location="<?= $log['location']; ?>" data-temperature="<?= $log['temperature']; ?>">
                        <i class='bx bx-show'></i>
                    </a>
                    <a href="logs/edit/<?= $log['id']; ?>" class="badge bg-warning text-white border-0"><i class='bx bxs-pencil'></i></a>
                    <a href="#delete" class="badge bg-danger text-white border-0 deleteLog" role="button" data-bs-toggle="modal" data-id="<?= $log['id']; ?>"><i class='bx bx-trash'></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade detailLogModal" id="detailLog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-body border-0">
                    <h5 class="modal-title text-red fs-3" id="exampleModalLabel">#Detail</h5>
                    <div class="row mt-4">
                        <div class="col-4">
                            <p class="fw-bold">Date</p>
                            <p class="fw-bold">Time</p>
                            <p class="fw-bold">Location</p>
                            <p class="fw-bold">Temperature</p>
                        </div>
                        <div class="col-7">
                            <p id="detail-date"></p>
                            <p id="detail-time"></p>
                            <p id="detail-location"></p>
                            <p id="detail-temperature"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn bg-warning border-0 shadow-sm text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>