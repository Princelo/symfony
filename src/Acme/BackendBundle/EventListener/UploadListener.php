<?php

namespace Acme\BackendBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;

class UploadListener
{
    public function __construct($doctrine = null)
    {
        $this->doctrine = $doctrine;
    }

    public function onUpload(PostPersistEvent $event)
    {
        /*$request = $event->getRequest();
        $gallery = $request->get('gallery');
        //...
        session_start();
        //$s = $_SESSION['upload_progress_'.intval($_GET['PHP_SESSION_UPLOAD_PROGRESS'])];
        $s = $_SESSION['upload_progress_123'];
        $progress = array(
            'lengthComputable' => true,
            'loaded' => $s['bytes_processed'],
            'total' => $s['content_length']
        );
        echo json_encode($progress);*/
        echo '{"files":[{"name":"上传成功", "gen_name": "'.$event->getFile()->getFileName() .'"}]}';
        exit;
    }
}