<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/datatables.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/boxicons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
    <title><?= $title; ?></title>
</head>
<body oncontextmenu="return false;">
    <form action="<?= base_url('Logs/update/' . $log['id']); ?>" method="POST">
        <?php csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Date</label>
                <input type="date" id="date" name="date" class="form-control <?= ($validation->hasError('date')) ? 'is-invalid' : '' ?>" value="<?= $log['date']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('date'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Time</label>
                <input type="time" id="time" name="time" class="form-control <?= ($validation->hasError('time')) ? 'is-invalid' : '' ?>" value="<?= date("H:i", strtotime($log['time'])); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('time'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Location</label>
                <input type="text" id="location" name="location" class="form-control <?= ($validation->hasError('location')) ? 'is-invalid' : '' ?>" value="<?= $log['location']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('location'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Temperature</label>
                <input type="text" id="temperature" name="temperature" class="form-control <?= ($validation->hasError('temperature')) ? 'is-invalid' : '' ?>" value="<?= $log['temperature']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('temperature'); ?>
                </div>
            </div>
        </div>
        <div class="float-end mt-3">
            <a href="<?= base_url('logs'); ?>" class="btn bg-warning text-white me-2"><i class='bx bx-arrow-back'></i> Cancel</a>
            <button type="submit" class="btn bg-primary text-white"><i class='bx bxs-save'></i> Submit</button>
        </div>
    </form>
    <script src="<?= base_url(); ?>/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
    </script>
</body>
</html>