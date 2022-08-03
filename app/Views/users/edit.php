<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>
    <form action="<?= base_url('users/update/' . $user['id']); ?>" method="POST" enctype="multipart/form-data">
        <?php csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIK</label>
                <input type="number" id="number" name="number" class="form-control <?= ($validation->hasError('number')) ? 'is-invalid' : '' ?>" value="<?= (old('number')) ? old('number') : $user['number']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('number'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                <input type="fullname" id="fullname" name="fullname" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : '' ?>" value="<?= (old('fullname')) ? old('fullname') : $user['fullname']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlInput1" class="form-label">Photo</label>
                <div class="row">
                    <div class="col-sm-1 mb-3">
                        <img src="<?= base_url(); ?>/img/<?= $user['photo']; ?>" width="40" class="rounded-circle img-preview">
                    </div>
                    <div class="col-sm-11 mb-3">
                        <input type="hidden" name="oldPhoto" value="<?= $user['photo']; ?>">
                        <input type="file" id="photo" name="photo" class="form-control" onchange="imgPreview()" value="<?= (old('photo')) ? old('photo') : $user['photo']; ?>">                        
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
        <div class="d-flex mt-3">
            <div class="me-auto">
                <a href="#editPassword" class="btn bg-info text-white editPassword" data-bs-toggle="modal" data-bs-target="#editPassword" data-id="<?= $user['id']; ?>">
                    <i class='bx bxs-key me-2'></i>Edit Password
                </a>
            </div>
            <div class="">
                <?php if($user_session['role'] == 'admin') : ?>
                    <a href="<?= base_url('users'); ?>" class="btn bg-warning text-white me-2"><i class='bx bx-arrow-back'></i> Cancel</a>
                <?php else : ?>
                    <a href="<?= base_url('home'); ?>" class="btn bg-warning text-white me-2"><i class='bx bx-arrow-back'></i> Cancel</a>
                <?php endif; ?>
            </div>
            <div class="">
                <button type="submit" class="btn bg-primary text-white"><i class='bx bxs-save'></i> Submit</button>
            </div>
        </div>
    </form>

    <div class="modal fade" id="editPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <form action="" method="POST" id="formEditPassword">
                    <?= csrf_field(); ?>
                    <div class="modal-body border-0">
                        <h5 class="modal-title text-red fs-3" id="exampleModalLabel">#Edit Password</h5>
                        <div class="my-3">
                            <label for="current-password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current-password" name="current-password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new-password" required>
                        </div>
                        <div class="">
                            <label for="repeat-password" class="form-label">Repeat Password</label>
                            <input type="password" class="form-control" id="repeat-password" name="repeat-password" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn bg-warning text-white border-0 shadow-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary text-white border-0 shadow-sm">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>