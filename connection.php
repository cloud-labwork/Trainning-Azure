<?php
    use MicrosoftAzure\Storage\Blob\BlobRestProxy;
    use MicrosoftAzure\Storage\Blob\BlobSharedAccessSignatureHelper;
    use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
    use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
    use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
    use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
    use MicrosoftAzure\Storage\Blob\Models\DeleteBlobOptions;
    use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;
    use MicrosoftAzure\Storage\Blob\Models\GetBlobOptions;
    use MicrosoftAzure\Storage\Blob\Models\ContainerACL;
    use MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesOptions;
    use MicrosoftAzure\Storage\Blob\Models\ListPageBlobRangesOptions;
    use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
    use MicrosoftAzure\Storage\Common\Exceptions\InvalidArgumentTypeException;
    use MicrosoftAzure\Storage\Common\Internal\Resources;
    use MicrosoftAzure\Storage\Common\Internal\StorageServiceSettings;
    use MicrosoftAzure\Storage\Common\Models\Range;
    use MicrosoftAzure\Storage\Common\Models\Logging;
    use MicrosoftAzure\Storage\Common\Models\Metrics;
    use MicrosoftAzure\Storage\Common\Models\RetentionPolicy;
    use MicrosoftAzure\Storage\Common\Models\ServiceProperties;

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

    function generateRandomString($length = 6) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function createContainerSample($blobClient){
        try {
            // Create container.
            global $containerName;
            global $createContainerOptions;

            $blobClient->createContainer($containerName, $createContainerOptions);
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message.PHP_EOL;
        }
    }

    function uploadBlobSample($blobClient, $fileName, $content) {
        try {
            //Upload blob
            global $containerName;
            $blobClient->createBlockBlob($containerName, $fileName, $content);
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message.PHP_EOL;
        }
    }

    function cleanUp($blobClient) {
        global $containerName;
        $blobClient->deleteContainer($containerName);
        echo "Successfully cleaned up\n";
    }
?>