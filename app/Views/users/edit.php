<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>
    <form action="<?= base_url('users/update/' . $user['id']); ?>" method="POST" enctype="multipart/form-data">
        <?php csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIK</label>
                <input type="number" id="number" name="number" class="form-control <?= ($validation->hasError('number')) ? 'is-invalid' : '' ?>" value="<?= $user['number']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('number'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                <input type="fullname" id="fullname" name="fullname" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : '' ?>" value="<?= $user['fullname']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Photo</label>
                <div class="row">
                    <div class="col-sm-1">
                        <img src="<?= base_url(); ?>/img/<?= $user['photo']; ?>" width="40" class="rounded-circle img-preview">
                    </div>
                    <div class="col-sm-11">
                        <input type="hidden" name="oldPhoto" value="<?= $user['photo']; ?>">
                        <input type="file" id="photo" name="photo" class="form-control" onchange="imgPreview()">                        
                    </div>
                </div>
            </div>
            
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Role</label>
                    <select class="form-select" name="role">
                        <?php if($user['role'] == 'admin') : ?>
                            <option value="<?= $user['role']; ?>" selected>Admin</option>
                            <option value="general">General</option>
                        <?php elseif($user['role'] == 'general') : ?>
                            <option value="<?= $user['role']; ?>" selected>General</option>
                            <option value="admin" <?= ($user_session['role'] == 'general') ? 'disabled' : ''; ?>>Admin</option>
                        <?php endif; ?>                    
                    </select>
                </div>
        </div>
        <div class="float-end mt-3">
            <?php if($user_session['role'] == 'admin') : ?>
                <a href="<?= base_url('users'); ?>" class="btn bg-warning text-white me-2"><i class='bx bx-arrow-back'></i> Cancel</a>
            <?php else : ?>
                <a href="<?= base_url('home'); ?>" class="btn bg-warning text-white me-2"><i class='bx bx-arrow-back'></i> Cancel</a>
            <?php endif; ?>
            <button type="submit" class="btn bg-primary text-white"><i class='bx bxs-save'></i> Submit</button>
        </div>
    </form>
<?= $this->endSection(); ?>