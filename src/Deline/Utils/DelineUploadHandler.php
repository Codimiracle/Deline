<?php
namespace Deline\Utils;

class DelineUploadHandler extends UploadHandler
{

    public function __construct($options = null, $initialize = true, $error_messages = null)
    {
        parent::__construct($options, $initialize, $error_messages);
    }
}

