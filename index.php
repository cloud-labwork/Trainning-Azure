<?php
    require_once ("vendor/autoload.php");
    require_once ("connection.php");

    if(isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $query = sqlsrv_query($conn, "INSERT INTO todo (id, title, description) VALUES(DEFAULT, '$title', '$description')");
        if($query === false) {
            die( print_r( sqlsrv_errors(), true));
        }
        else {
            echo ("<script>alert('Berhasil menambahkan aktivitas'); location.assign('https://aitek230.azurewebsites.net/');</script>");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO APPS</title>
    <style>
        h1 {
            font-size: 24px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>TODO APPS</h1>
    <form method="post">
        <div>
            <input type="text" name="title" placeholder="Input Title">
        </div>
        <div>
            <textarea name="description" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="submit" name="submit">
        </div>
    </form>
    <br>
    <table cellpadding="5" border="1px">
        <thead>
            <tr>
                <th>NO</th>
                <th>TITLE</th>
                <th>DESCRIPTION</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = sqlsrv_query($conn, "SELECT * FROM todo", array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $count = sqlsrv_num_rows($query);

            if($count === false || $count === 0){
                echo ("
                    <tr>
                        <td colspan='3'>No Row Found</td>
                    </tr>
                ");
            }
            else {
                $no = 0;
                while ($row = sqlsrv_fetch_array($query)) {
        ?>
            <tr>
                <td><?php echo ++$no; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
            </tr>
        <?php
                }
            }
        ?>
        </tbody>
    </table>
</body>
</html>