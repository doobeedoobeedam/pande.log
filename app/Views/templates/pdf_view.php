<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $filename; ?></title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        th {
            background: #FFC46C;
        }
        span {
            font-weight: lighter;
        }
    </style>
</head>
<body>
    <h4>Full Name : <span><?= $user_session['fullname']; ?></span></h4>
    <h4>NIK : <span><?= $user_session['number']; ?></span></h4>
    <table border=1 width=100% cellpadding=2 cellspacing=0>
        <thead>
            <tr>
                <th>#</th>
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
                    <td><?= date("jS F Y", strtotime($log['date'])); ?></td>
                    <td align=center><?= date("H:i", strtotime($log['time'])); ?></td>
                    <td><?= $log['location']; ?></td>
                    <td><?= $log['temperature']; ?>°</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
    <h5>Downloaded @ <?= date('d/m/Y, H:i A'); ?></h5>
</body>
</html>