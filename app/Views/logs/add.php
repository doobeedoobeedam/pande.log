<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>    
    <form action="<?= base_url('logs/store'); ?>" method="POST" class="mt-4">
        <?php csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Date</label>
                <input type="date" id="date" name="date" class="form-control <?= ($validation->hasError('date')) ? 'is-invalid' : '' ?>" value="<?= old('date'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('date'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Time</label>
                <input type="time" id="time" name="time" class="form-control <?= ($validation->hasError('time')) ? 'is-invalid' : '' ?>" value="<?= old('time'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('time'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Location</label>
                <input type="text" id="location" name="location" class="form-control <?= ($validation->hasError('location')) ? 'is-invalid' : '' ?>" value="<?= old('location'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('location'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Temperature</label>
                <input type="text" id="temperature" name="temperature" class="form-control <?= ($validation->hasError('temperature')) ? 'is-invalid' : '' ?>" value="<?= old('temperature'); ?>">
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
<?= $this->endSection(); ?>