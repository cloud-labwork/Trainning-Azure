<?php

    namespace MicrosoftAzure\Storage\Samples;

    require_once ("vendor/autoload.php");
    require_once ("connection.php");
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
    <h1>VISION APPS</h1>
    <form method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="imageFile">
        </div>
        <div>
            <input type="submit" value="submit" name="submit">
        </div>
    </form>
    <br>
    <?php
        if(isset($_POST['submit'])) {
            $fileName = "image_" . date("YmdHis") . $_FILES['imageFile']['name'];
            $fileData = $_FILES['imageFile']['tmp_name'];

            createContainerSample($blobClient);
            uploadBlobSample($blobClient, $fileName, $fileData);
            // cleanUp($blobClient);
            $url = listBlobsSample($blobClient, $fileName);
            $req = array(
                "getParams" => $base_url . "?visualFeatures=Categories,Description,Color&details=&language=en",
                "getUrl" => array("url" => $url)
            );

            $res = getAnalyze($req);
            ?>
            <div id="wrapper" style="width: 1024px; margin: 0 auto; display: table">
                <div id="jsonOutput" style="width:600px; display:table-cell;">
                    Response: <?php echo json_decode($res)->description->captions[0]->text; ?>
                    <br><br>
                    <textarea id="responseTextArea"
                            style="width: 580px; height:400px;"><?php echo json_encode(json_decode($res), JSON_PRETTY_PRINT);?></textarea>
                </div>
                <div id="imageDiv" style="width:420px; display:table-cell;">
                    Source image:
                    <br><br>
                    <img id="sourceImage" width="400" src="<?php echo $url;?>" />
                </div>
            </div>
            <?php
        }
    ?>
</body>
</html>