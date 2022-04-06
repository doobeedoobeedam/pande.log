<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>    
    <form action="<?= base_url('users/store'); ?>" method="POST" class="mt-4" enctype="multipart/form-data">
        <?php csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIK</label>
                <input type="text" id="number" name="number" class="form-control <?= ($validation->hasError('number')) ? 'is-invalid' : '' ?>" value="<?= old('number'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('number'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fullname</label>
                <input type="text" id="fullname" name="fullname" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : '' ?>" value="<?= old('fullname'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlInput1" class="form-label">Photo</label>
                <div class="row">
                    <div class="col-sm-1 mb-3">
                        <img src="<?= base_url(); ?>/img/original.jpg" width="40" class="rounded-circle img-preview">
                    </div>
                    <div class="col-sm-11 mb-3">
                        <input type="file" id="photo" name="photo" class="form-control" onchange="imgPreview()">                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" value="<?= old('password'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Role</label>
                <select id="role" name="role" class="form-select form-control <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>">
                    <option disabled>Select role</option>
                    <option value="admin">Admin</option>
                    <option value="general">General</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('role'); ?>
                </div>
            </div>
        </div>
        <div class="float-end mt-3">
            <a href="<?= base_url('users'); ?>" class="btn bg-warning text-white me-2"><i class='bx bx-arrow-back'></i> Cancel</a>
            <button type="submit" class="btn bg-primary text-white"><i class='bx bxs-save'></i> Submit</button>
        </div>
    </form>
<?= $this->endSection(); ?>