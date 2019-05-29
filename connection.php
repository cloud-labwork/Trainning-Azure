<?php
    $name = "aitek230";
    $key1 = "K9ReKKgFozmzy3nlt5HJnjQygmaURpkw2tj8MxTJSpdlxF1/BNwN1/aosI7qTwNNiI8qA4GJGfw6uPtbNpxbXw==";
    $key2 = "a2d8nofNqlHWTGTbc9Zxwz/ocUN4WD1KnYiyWF8ANaQD2oJ0qtXDB+gnkBtY9ioRS1wfiyAHL0BhMyAGeXBR3A==";
    $conn = "DefaultEndpointsProtocol=https;AccountName=".$name.";AccountKey=".$key1.";EndpointSuffix=core.windows.net";

    $blobClient = BlobRestProxy::createBlobService($conn);
    $createContainerOptions = new CreateContainerOptions();

    $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
    $createContainerOptions->addMetaData("key1", $key1);
    $createContainerOptions->addMetaData("key2", $key2);

    $containerName = "blockblobs".generateRandomString();
?>