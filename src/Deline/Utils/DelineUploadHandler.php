<?php
namespace Deline\Utils;

class DelineUploadHandler extends UploadHandler
{

    public function __construct($dirname)
    {
        $path = getcwd() . "/static/";
        if ($dirname) {
            $path .= $dirname."/";
        } else {
            $path .= "uploads/";
        }
        parent::__construct(array(
            "delete_type" => 'POST',
            "upload_dir" => $path,
            "upload_url" => $this->get_full_url()."/index.php?node=/Upload&file="
        ));
    }
}

