<?PHP
/*
*@copyright Copyright (c) 2008, 4MDesigners.com
*/

class Iceupload{
    
    public $path;
    
    private $errors = array();
    
    private $check_file_optional = 0;
    private $remove_spaces = TRUE;
    private $is_image = false;
    
    function __construct($settings=array()){
        $defaults = array(
                            'check_file_optional'    => 0,
                            'is_image'            => FALSE,
                            'remove_spaces'        => TRUE
                        );    
        
        foreach ($defaults as $key => $val){
            if (isset($config[$key])){
                $method = 'set_'.$key;
                if (method_exists($this, $method))
                    $this->$method($config[$key]);
                else
                    $this->$key = $config[$key];        
            }else{
                $this->$key = $val;
            }
        }
    }//__construct ends
    
    public function doUpload($field){
    
        if(!$this->is_fileOptional()){
            if ( !isset($_FILES[$field])){
                $this->setError('No file selected to upload');
                return FALSE;
            }
        }
        
        // Was the file able to be uploaded? If not, determine the reason why.
        if ( !is_uploaded_file($_FILES[$field]['tmp_name']) ){
        
            $error = ( ! isset($_FILES[$field]['error'])) ? 4 : $_FILES[$field]['error'];
            $this->setError($this->getErrors($error));
        }

            return FALSE;
    }
    
    function getErrors($errno){
        $str = '';
        switch($errno){
            case 1:    // UPLOAD_ERR_INI_SIZE
                $str = 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.';
                break;
            case 2: // UPLOAD_ERR_FORM_SIZE
                $str = 'The uploaded file exceeds the maximum size allowed by the submission form.';
                break;
            case 3: // UPLOAD_ERR_PARTIAL
               $str = 'The file was only partially uploaded.';
                break;
            case 4: // UPLOAD_ERR_NO_FILE
               $str = 'The temporary folder is missing.';
                break;
            case 6: // UPLOAD_ERR_NO_TMP_DIR
                $str = 'upload_no_temp_directory';
                break;
            case 7: // UPLOAD_ERR_CANT_WRITE
                $str = 'The file could not be written to disk.';
                break;
            case 8: // UPLOAD_ERR_EXTENSION
                $str = 'The file upload was stopped by extension.';
                break;
            default :  
               $str = 'You did not select a file to upload.';
               break;
        }
        return $str;
    }
    
    
    public function setError($errormessage){        
        if (is_array($errormessage)){
            foreach ($errormessage as $value){
                $this->errors[] = $msg;
            }        
        }else{
            $this->errors[] = $errormessage;
        }
    }// setError() ends
    
    
    public function displayErrors($open='<p>',$close='</p>'){
        $str = '';
        foreach($this->errors as $value){
            $str .= $open.$value.$close;
        }
        
        return $str;
    }
    

    public function CheckFileType($type)
    {
        $allowed[] = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        $allowed[] = "application/msword";
        $allowed[] = "application/pdf";
        $allowed[] = "application/x-pdf";
        $allowed[] = "application/vnd.ms-excel";
        $allowed[] = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function isValidDocFile($type){
        $allowed[] = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        $allowed[] = "application/msword";

        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function isValidPdfFile($type){
        $allowed[] = "application/pdf";
        $allowed[] = "application/x-pdf";

        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function isValidXlsFile($type){
        $allowed[] = "application/vnd.ms-excel";
        $allowed[] = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    
    public function CheckImageType($type){
        $allowed[] = "image/gif";
        $allowed[] = "image/jpeg";
        $allowed[] = "image/pjpeg"; 
        $allowed[] = "image/x-png"; 
        $allowed[] = "image/png"; 
    
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function CheckCompressedType($type){
        $allowed[] = "application/zip"; 
        $allowed[] = "application/x-rar-compressed"; 
        $allowed[] = "application/octet-stream";
        
           
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    
    
    public function CheckCsvType($type){
        $allowed[] = "application/vnd.ms-excel";
        
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function CheckAudioType($type){
        $allowed[] = "audio/x-mp3";
        $allowed[] = "audio/mpeg";
        
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    


    public function CheckBannerType($type){
        $allowed[] = "image/gif";
        $allowed[] = "image/jpeg";
        $allowed[] = "image/pjpeg"; 
        //$allowed[] = "image/x-png"; 
        $allowed[] = "application/x-shockwave-flash";
        
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function getExtensionByMime($mime){
        $allowed['image/gif'] = "gif";
        $allowed['image/jpeg'] = "jpg";
        $allowed['image/pjpeg'] = "jpg"; 
        $allowed['image/x-png'] = "png"; 
        $allowed['application/x-shockwave-flash'] = "swf";
        
        return $allowed[$mime];
    }
    

    public function is_fileOptional(){
        return $this->check_file_optional;
    }
    
    
    public function CleanFileName($filename){
        $bad = array(
                        "<!--",
                        "-->",
                        "'",
                        "<",
                        ">",
                        '"',
                        '&',
                        '$',
                        '=',
                        ';',
                        '?',
                        '/',
                        "%20",
                        "%22",
                        "%3c",        // <
                        "%253c",     // <
                        "%3e",         // >
                        "%0e",         // >
                        "%28",         // (
                        "%29",         // )
                        "%2528",     // (
                        "%26",         // &
                        "%24",         // $
                        "%3f",         // ?
                        "%3b",         // ;
                        "%3d"        // =
                    );
                    
        foreach ($bad as $val){
            $filename = str_replace($val, '', $filename);
        }
        
        $filename = preg_replace("/\s+/", "_", $filename);

        return stripslashes($filename);
    }
    
    function getExtension($filename,$returnStandardExtension=true){
        $data = explode('.', $filename);
        if($returnStandardExtension)
            return '.'.end($data);
        else
            return end($data);
    }    
    
    
    function encryptedFileName($extension){
        mt_srand();
        return md5(uniqid(mt_rand())).$extension;     
    }
    
    function uniqueFileName(){
        mt_srand();
        return md5(uniqid(mt_rand().time()));
    }
    
    function uploadFile($tmpname,$newname){
        if (is_uploaded_file($tmpname)) {
            if(move_uploaded_file($tmpname,$this->path.$newname)) {
                return true;
            }
        }else{
            return false;
        }
    }
    
    /*
        @file_size = file size bytes
        @limit = 1,2,3,4,5 MB
    */
    function check_size($file_size,$limit){
        if($this->bytes_to_mb($file_size) > $limit){
            return false;
        }else{
            return true;
        }
    }
    
    function bytes_to_mb($bytes){
        return intval(($bytes/1024)/1024);
    }
    

}


class Icevideo extends Iceupload {

	public $path;
	private $imgSrc;
	
	function __construct($path){
		$this->path = $path;
	}
	
	function convertToFLV($video,$videoName){
		$cmd = ""._FFMPEG_PATH." -i ".$this->path.$video."  -s 300x240 -ar 44100 -r 12 ".$this->path.$videoName.".flv ";
		exec($cmd,$output,$return); 
		if($return == 0 ){
			//inject meta data to FLV !important! else scrub/seek bar will not work at all
			exec(""._FLVMDI_PATH." ".$this->path.$videoName.".flv ");
			return true;
		}else{
			return false;
		}
	}
	
	function videoThumbnail($video,$thumbnail){
		$second  = 1;
		$cmd = ""._FFMPEG_PATH." -i ".$this->path.$video." 2>&1";
		if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', `$cmd`, $time)) {
			$total = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
			$second = rand(1, ($total - 1));
		}
		
		$cmd = ""._FFMPEG_PATH." -i ".$this->path.$video." -deinterlace -an -ss ".$second." -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg ".$this->path.$thumbnail.".jpg 2>&1";
		

		exec($cmd,$output,$return); 
		
		if($return == 0 ){
			return true;
		}else{
			return false;
		}
	}
	
	public function CheckVideoType($type,$only_flv_allowed=false){
	    if($only_flv_allowed){
            $allowed[] = "video/x-flv"; 
        }
        else
        {
		    $allowed[] = "video/x-msvideo"; 
		    $allowed[] = "video/quicktime";
		    $allowed[] = "video/mp4"; 
		    $allowed[] = "video/mpeg"; 
		    $allowed[] = "video/x-flv"; 
		    $allowed[] = "application/octet-stream"; 
		    $allowed[] = "video/avi"; 
		    $allowed[] = "video/3gpp";
		    //$allowed[] = "video/x-ms-wmv";
		}
		if(!in_array($type,$allowed)) {
			return false;
		}else{
			return true;
		}
	}
}//iceImage class ends