<?PHP
/**
 * UploadFile - Class contains private and public methods which are used to upload files and log errors.
 */
class UploadFile {
    private $errors = array();
    private $uploadDirName = "uploads/";
    private $extension = "jpg";

    public function upload($files){
        foreach ($files['name'] as $key => $image) {
            // Check file errors
            if ($files['error'][$key] != 0 && $files['error'][$key] != 4) {         
                $errMessage = $this->showError($files['error'][$key]);
                $this->errors[] = array('image' => $image, 'error' => $errMessage);
                continue;
            } 
            // validates correct file type
            $errMessage = $this->checkMimeType($files['tmp_name'][$key],$this->extension);
            if($errMessage != 0) {
                $errMessage = $this->showError($errMessage);
                $this->errors[] = array('image' => $image, 'error' => $errMessage);
                continue;
            }
            // Generate Unique name for file 
            $filename = time().uniqid(rand(), true);
            $path = $this->uploadDirName.$filename.".".$this->extension;

            // Finally move from temp location to uploads dir
            if (!move_uploaded_file($files['tmp_name'][$key], $path)) {
                $this->errors[] = array('image' => $image, 'error' => " File upload failed. ");
            } else {
                $this->errors[] = array('image' => $image, 'error' => " File uploaded Successfully. ");
            }
        }
        // Display error logs
        $this->displayLog();
    }

    private function displayLog() {
        $print = "<table border='1' width='50%' ><tr><th>Filename</th><th>Status</th></tr>";
        foreach ($this->errors as $val) {
                $print .= "<tr><td>{$val['image']}</td><td>{$val['error']}</td></tr>";
            }
            $print .= "</table>";
            echo $print;
    }
    
    private function checkMimeType($fileType,&$ext){
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if ($ext = array_search($finfo->file($fileType),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),true)) {
                return 0;
        } else {
            return 10;
        }
    }

    private function showError($errorCode){
        $message = "";
        switch($errorCode){
            case UPLOAD_ERR_INI_SIZE: 
                $message = "uploaded file exceeds the upload_max_filesize"; 
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                $message = "Uploaded file exceeds the MAX_FILE_SIZE."; 
                break; 
            case UPLOAD_ERR_PARTIAL: 
                $message = "Transferring failed."; 
                break; 
            case UPLOAD_ERR_NO_FILE: 
                $message = "No file uploaded."; 
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = "Missing temporary folder."; 
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                $message = "Failed to write file on disk."; 
                break; 
            case UPLOAD_ERR_EXTENSION: 
                $message = "File upload stopped by extension"; 
                break; 
            case 10: 
                $message = " Unsupported File type."; 
                break;
            default: 
                $message = "Unknown error"; 
                break; 
        }
        return $message;
    }
}

$uploadFile = new UploadFile();
$uploadFile->upload($_FILES["myfile"]);
?>