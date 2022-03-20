<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>
    <div class=" border-0 shadow-sm p-4">
        <div class="row">
            <div class="col-md-3">
                <img src="<?= base_url(); ?>/img/<?= $user['photo']; ?>" width="300" class="rounded-circle img-preview">
            </div>
            <div class="col-md-8 py-5 ps-5">
                <p class="fs-5 mb-4 pb-3 border-bottom"><span class="fw-bold">Full Name</span> <span class="float-end"><?= $user['fullname']; ?></span></p>
                <p class="fs-5 mb-4 pb-3 border-bottom"><span class="fw-bold">NIK</span> <span class="float-end"><?= $user['number']; ?></span></p>
                <p class="fs-5 mb-4 pb-3 border-bottom"><span class="fw-bold">Role</span> <span class="float-end"><?= ucfirst($user['role']); ?></span></p>
                <a href="<?= base_url('users/edit/' . $user['id']); ?>" class="badge bg-warning text-decoration-none text-white fs-6 float-end">
                    <i class='bx bxs-pencil'></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>