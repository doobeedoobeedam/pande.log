<?= $this->extend('templates/template'); ?>
<?= $this->section('content'); ?>
<table id="data-log" class="table table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Full Name</th>
            <th>Photo</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $user['number']; ?></td>
                <td><?= $user['fullname']; ?></td>
                <td><img src="<?= base_url(); ?>/img/<?= $user['photo']; ?>" width="25" class="rounded-circle" alt="<?= $user['fullname']; ?>"></td>
                <td><?= $user['role']; ?></td>
                <td>
                    <!-- <a href="#detailUser" class="badge bg-info border-0 detailUser" role="button" data-bs-toggle="modal"><i class='bx bx-show'></i></a> -->
                    <a href="users/edit/<?= $user['id']; ?>" class="badge bg-warning text-white border-0"><i class='bx bxs-pencil'></i></a>
                    <a href="#delete" class="badge bg-danger text-white border-0 deleteUser" role="button" data-bs-toggle="modal" data-id="<?= $user['id']; ?>" data-warning="If you delete this user, all personal logs from that user will also be permanently deleted."><i class='bx bx-trash'></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>