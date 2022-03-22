<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $filename; ?></title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        th {
            background: #FFC46C;
        }
        span {
            font-weight: lighter;
        }

        table {
            font-size: 13px;
        }
    </style>
</head>
<body>
    <h4><?= $filename . ' | '. date('d/m/Y, H:i A'); ?></h4>
    <table border=1 width=100% cellpadding=2 cellspacing=0>
        <thead>
            <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>NIK</th>
                <th>Date</th>
                <th align=center>Time</th>
                <th>Location</th>
                <th>Temperature</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($logs as $log) : ?>
                <tr>
                    <td align=center><?= $i++; ?></td>
                    <td><?= $log->fullname; ?></td>
                    <td><?= $log->number; ?></td>
                    <td><?= date("jS F Y", strtotime($log->date)); ?></td>
                    <td align=center><?= date("H:i", strtotime($log->time)); ?></td>
                    <td><?= $log->location; ?></td>
                    <td><?= $log->temperature; ?>°</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>