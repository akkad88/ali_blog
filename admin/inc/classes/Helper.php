<?php
class Helper {
    public static function uploadFile($input, $file)
    {
        if(!empty($file)):
            move_uploaded_file($_FILES[$input]['tmp_name'], $file);

        endif;
    }
}