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
    
     public function CheckType($type){
        $allowed[] = "image/gif";
        $allowed[] = "image/jpeg";
        $allowed[] = "image/pjpeg"; 
        $allowed[] = "image/x-png"; 
        $allowed[] = "image/png"; 
        $allowed[] = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        $allowed[] = "application/msword";
        $allowed[] = "application/pdf";
        $allowed[] = "application/x-pdf";
        $allowed[] = "application/vnd.ms-excel";
        $allowed[] = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
        /*$allowed[] = "video/x-msvideo"; 
        $allowed[] = "video/quicktime";
        $allowed[] = "video/mp4"; 
        $allowed[] = "video/mpeg"; 
        $allowed[] = "video/x-flv"; 
        $allowed[] = "application/octet-stream"; 
        $allowed[] = "video/avi"; 
        $allowed[] = "video/3gpp";
        $allowed[] = "video/x-ms-wmv";  */
    
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        } 
        
        return true;
    }
    
    public function OnlyPDFCheckType($type)
    {
        
        $allowed[] = "application/pdf";
        $allowed[] = "application/x-pdf";
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        } 
        
        return true;
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
    
    function getFilename($filename,$returnStandardExtension=true)
    {
        $data = explode('.', $filename);
        return $data[0];
    }    
    
    function encryptedFileName($extension)
    {
        mt_srand();
        return md5(uniqid(mt_rand())).$extension;     
    }
    
    function getFileencryptedFileName()
    {
        mt_srand();
        return md5(uniqid(mt_rand()));     
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


class Iceimage extends Iceupload {

	private $imgSrc;
	private $thumbnailName;
	private $new_width;
	private $new_height;
	private $thumbnailSize;
	private $originalFileName;
	
	function __construct($path=''){
		$this->path = $path;
	}
	
	function setthumbnail($thumbnail,$thumbnailsize){
		$this->thumbnailName = $thumbnail;
		$this->thumbnailSize = $thumbnailsize;
	}	

	function getDimensions($filename){
		$extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		if($extension=="jpg" ){
			$img = imagecreatefromjpeg($this->path.$filename);
		}elseif($extension=="gif" ){
			$img = imagecreatefromgif($this->path.$filename);
		}elseif($extension=="png" ){
			$img = imagecreatefrompng($this->path.$filename);
		}
		$array = '';
		if ($img) {
			$array['w'] = imagesx($img);
			$array['h'] = imagesy($img);
		}
		return $array;
	}
	
	function resize($filename,$newWidth=100,$newHeight=100,$output=false,$quality=100,$file_prefix=''){		
	    
        $new_filename = $file_prefix.$filename;
        
		$thumb_created = false;
		$extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

		if($extension=="jpg" ){
			$img = imagecreatefromjpeg($this->path.$filename);
		}elseif($extension=="gif" ){
			$img = imagecreatefromgif($this->path.$filename);
		}elseif($extension=="png" ){
			$img = imagecreatefrompng($this->path.$filename);
		}
	
		if ($img) {
			//get the dimension of source image 
			$width = imagesx($img);
			$height = imagesy($img);
			//aspect ratio to be maintained
			if ($width > $height) { 
				$scale = ($newWidth / $width); 
			} else { 
				$scale = ($newHeight / $height); 
			} 
			
			
			//thumbnail dimensions
			if($width <= $newWidth ){
				$new_width = $width;
			}else{
				$new_width = round($width * $scale); 
			}
			
			if($height <= $newHeight ){
				$new_height = $height;
			}else{
				$new_height = round($height * $scale); 
			}
            
            if($width <= $newWidth  || $height <= $newHeight){
                $new_height = $height;
                $new_width = $width;
            }
			
			# Create a new temporary image
			$tmp_img = imagecreatetruecolor($new_width, $new_height);
			if($extension=="png" ){ //transparent fix
				imagealphablending($tmp_img, false);
				imagesavealpha($tmp_img,true);
				
				$transparent = imagecolorallocatealpha($tmp_img, 255, 255, 255, 127);
				imagefilledrectangle($tmp_img, 0, 0, $new_width, $new_height, $transparent);
			}
			 imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,
								  $width, $height);

			imagedestroy($img);
			$img = $tmp_img;
		}// if ($img) {
		
		if($output == false){
			if($extension=="jpg" ){
					imagejpeg($img,$this->path.$new_filename,$quality);
					$thumb_created = true;
			}elseif($extension=="gif" ){
					imagegif($img,$this->path.$new_filename,$quality);
					$thumb_created = true;
			}elseif($extension=="png" ){
					imagepng($img,$this->path.$new_filename,9);
					$thumb_created = true;
			}
		}else{
			if($extension=="jpg" ){
				header('Content-type: image/jpeg');
				imagejpeg($img);
			}elseif($extension=="gif" ){
				header('Content-type: image/gif');
				imagegif($img);
			}elseif($extension=="png" ){
				header('Content-type: image/png');
				imagepng($img);
			}
		}

		if($thumb_created == false ){
			return false;
		}else{
			return true;
		}

	}// resize() ends
	
	function getImageDimensions($filename){
		$extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		if($extension=="jpg" ){
			$img = imagecreatefromjpeg($this->path.$filename);
		}elseif($extension=="gif" ){
			$img = imagecreatefromgif($this->path.$filename);
		}elseif($extension=="png" ){
			$img = imagecreatefrompng($this->path.$filename);
		}
		
		$arr['w'] = imagesx($img);
		$arr['h'] = imagesy($img);
		return $arr;
	}
	
	function resizeTo($filename,$newfilename,$newWidth=100,$newHeight=100,$output=false){		
		$thumb_created = false;
		$extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		if($extension=="jpg" ){
			$img = imagecreatefromjpeg($this->path.$filename);
		}elseif($extension=="gif" ){
			$img = imagecreatefromgif($this->path.$filename);
		}elseif($extension=="png" ){
			$img = imagecreatefrompng($this->path.$filename);
		}
	
		if ($img) {
			//get the dimension of source image 
			$width = imagesx($img);
			$height = imagesy($img);
			
			//aspect ratio to be maintained
			if ($width > $height) { 
				$scale = ($newWidth / $width); 
			} else { 
				$scale = ($newHeight / $height); 
			} 

			//thumbnail dimensions
			$new_width = round($width * $scale); 
			$new_height = round($height * $scale); 
		
			# Create a new temporary image
			$tmp_img = imagecreatetruecolor($new_width, $new_height);
	
			# Copy and resize old image into new image
			imagecopyresized($tmp_img, $img, 0, 0, 0, 0,
							 $new_width, $new_height, $width, $height);
			imagedestroy($img);
			$img = $tmp_img;
		}// if ($img) {
		
		if($output == false){
			if($extension=="jpg" ){
					imagejpeg($img,$this->path.$newfilename);
					$thumb_created = true;
			}elseif($extension=="gif" ){
					imagegif($img,$this->path.$newfilename);
					$thumb_created = true;
			}elseif($extension=="png" ){
					imagepng($img,$this->path.$newfilename);
					$thumb_created = true;
			}
		}else{
			if($extension=="jpg" ){
				header('Content-type: image/jpeg');
				imagejpeg($img);
			}elseif($extension=="gif" ){
				header('Content-type: image/gif');
				imagegif($img);
			}elseif($extension=="png" ){
				header('Content-type: image/png');
				imagepng($img);
			}
		}
		
		if($thumb_created == false ){
			return false;
		}else{
			return true;
		}

	}// resize() ends
	
	/* cropImage(225, 165, '/path/to/source/image.jpg', 'jpg', '/path/to/dest/image.jpg'); */
	function cropImage($nw, $nh, $source,$newfileName,$case='top') {
		$thumb_croped = false;
		
		$size = getimagesize($this->path.$source);
		$w = $size[0];
		$h = $size[1];
		
		$extension =  strtolower($this->getExtension($source,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		switch($extension) {
			case 'gif':
			$simg = imagecreatefromgif($this->path.$source);
			break;
			case 'jpg':
			$simg = imagecreatefromjpeg($this->path.$source);
			break;
			case 'png':
			$simg = imagecreatefrompng($this->path.$source);
			break;
		}
		

		$dimg = imagecreatetruecolor($nw, $nh);
		$wm = $w/$nw;
		$hm = $h/$nh;
		$h_height = $nh/2;
		$w_height = $nw/2;
		if($w> $h) {
			$adjusted_width = $w / $hm;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;
			imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
		} elseif(($w <$h) || ($w == $h)) {
			$adjusted_height = $h / $wm;
			$half_height = $adjusted_height / 2;
			$int_height = $half_height - $h_height;
			imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
		} else {
			imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
		}
		
		if($extension=="jpg" ){
			imagejpeg($dimg,$this->path.$newfileName,100);
			$thumb_croped = true;
		}elseif($extension=="gif" ){
			imagegif($dimg,$this->path.$newfileName,100);
			$thumb_croped = true;
		}elseif($extension=="png" ){
			imagepng($dimg,$this->path.$newfileName,100);
			$thumb_croped = true;
		}
		
		return $thumb_croped;
		
		//imagejpeg($dimg,$dest,100);
	}
	

	
	/*
		Works from top
	*/
	function myImageCrop($imgSrc,$newfilename,$thumbWidth=100,$output=false,$thumbHeight=0){
 	
		if($thumbHeight == 0) $thumbHeight = $thumbWidth;
		
		//getting the image dimensions
		list($width, $height) = getimagesize($this->path.$imgSrc); 
		
		
		$extension =  strtolower($this->getExtension($imgSrc,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		//saving the image into memory (for manipulation with GD Library)
		switch($extension) {
			case 'gif':
			$myImage = imagecreatefromgif($this->path.$imgSrc);
			break;
			case 'jpg':
			$myImage = imagecreatefromjpeg($this->path.$imgSrc);
			break;
			case 'png':
			$myImage = imagecreatefrompng($this->path.$imgSrc);
			break;
		}
		


		 ///--------------------------------------------------------  
		 //setting the crop size  
		 //--------------------------------------------------------  
		 if($width > $height){  
			 $biggestSide = $width;   
			 $cropPercent = .6;   
			 $cropWidth   = $biggestSide*$cropPercent;   
			 $cropHeight  = $biggestSide*$cropPercent;   
			 $c1 = array("x"=>($width-$cropWidth)/2, "y"=>($height-$cropHeight)/2);  
		 }else{  
			 $biggestSide = $height;   
			 $cropPercent = .6;   
			 $cropWidth   = $biggestSide*$cropPercent;   
			 $cropHeight  = $biggestSide*$cropPercent;   
			 $c1 = array("x"=>($width-$cropWidth)/2, "y"=>($height-$cropHeight)/7);  
		 }   
		 
		 //--------------------------------------------------------
		// Creating the thumbnail
		//--------------------------------------------------------
		$thumb = imagecreatetruecolor($thumbWidth, $thumbHeight); 
		imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $thumbWidth, $thumbHeight, $cropWidth, $cropHeight); 

		if($output == false){
			if($extension=="jpg" ){
				imagejpeg($thumb,$this->path.$newfilename,100);
			}elseif($extension=="gif" ){
				imagegif($thumb,$this->path.$newfilename,100);
			}elseif($extension=="png" ){
				imagepng($thumb,$this->path.$newfilename,9);
			}
		}else{
			//final output  
			//imagejpeg($thumb);
			if($extension=="jpg" ){
				header('Content-type: image/jpeg');
				imagejpeg($thumb);
			}elseif($extension=="gif" ){
				header('Content-type: image/gif');
				imagegif($thumb);
			}elseif($extension=="png" ){
				header('Content-type: image/png');
				imagepng($thumb);
			}
		} 
		imagedestroy($thumb);  
	}
	
	function generateCaptcha($sessionStr=''){
		if($sessionStr == '') return;
		
		//Let's generate a totally random string using md5
		$md5_hash = md5(rand(0,999)); 
		
		//We don't need a 32 character long string so we trim it down to 5 
		$security_code = substr($md5_hash, 15, 5); 
	
		//Set the session to store the security code
		$_SESSION[$sessionStr] = $security_code;
	
		//Set the image width and height
		$width = 100;
		$height = 20; 
	
		//Create the image resource 
		$image = imagecreate($width, $height);  
	
		//We are making three colors, white, black and gray
		$white = imagecolorallocate($image, 1, 1, 1);
		$black = imagecolorallocate($image, 255, 255, 255);
		$grey = imagecolorallocate($image, 120, 204, 204);
	
		//Make the background black 
		imagefill($image, 0, 0, $black); 
	
		//Add randomly generated string in white to the image
		imagestring($image, 3, 30, 3, $security_code, $white); 
	
		//Throw in some lines to make it a little bit harder for any bots to break 
		imagerectangle($image,0,0,$width-1,$height-1,$grey); 
	 
		//Tell the browser what kind of file is come in 
		header("Content-Type: image/jpeg"); 
	
		//Output the newly created image in jpeg format 
		imagejpeg($image);
	   
		//Free up resources
		imagedestroy($image);
	}
	
	function OutputCropMnb($imgSrc,$newfilename,$new_width=100,$new_height=100){
		
		if($new_height == NULL or $new_height == 0){
			$new_height = 100;
		}
		
		if($new_width == NULL or $new_width == 0){
			$new_width = 100;
		}
		
		$extension =  strtolower($this->getExtension($imgSrc,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		//saving the image into memory (for manipulation with GD Library)
		switch($extension) {
			case 'gif':
			$myImage = imagecreatefromgif($this->path.$imgSrc);
			break;
			case 'jpg':
			$myImage = imagecreatefromjpeg($this->path.$imgSrc);
			break;
			case 'png':
			$myImage = imagecreatefrompng($this->path.$imgSrc);
			break;
		}
		
		$thumb = $this->ResizeSemiAbstractTop($myImage,$new_width,$new_height);


		if($extension=="jpg" ){
			header('Content-type: image/jpeg');
			imagejpeg($thumb,'',100);
		}elseif($extension=="gif" ){
			header('Content-type: image/gif');
			imagegif($thumb);
		}elseif($extension=="png" ){
			header('Content-type: image/png');
			imagepng($thumb);
		}
	
		imagedestroy($thumb);  
	}
	
	/*
	images are pixellated. chck that
	*/
	function CropMnb($imgSrc,$newfilename,$new_width=100,$new_height=100,$quality=100){

		$extension =  strtolower($this->getExtension($imgSrc,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		//saving the image into memory (for manipulation with GD Library)
		switch($extension) {
			case 'gif':
			$myImage = imagecreatefromgif($this->path.$imgSrc);
			break;
			case 'jpg':
			$myImage = imagecreatefromjpeg($this->path.$imgSrc);
			break;
			case 'png':
			$myImage = imagecreatefrompng($this->path.$imgSrc);
			break;
		}
		
		$thumb = $this->ResizeSemiAbstractTop($myImage,$new_width,$new_height);

		if($extension=="jpg" ){
			imagejpeg($thumb,$this->path.$newfilename,$quality);
		}elseif($extension=="gif" ){
			imagegif($thumb,$this->path.$newfilename,$quality);
		}elseif($extension=="png" ){
			imagepng($thumb,$this->path.$newfilename,9);
		}
	
		imagedestroy($thumb);  
	}
    
    function generate_thumbnail($img_name,$filename,$new_width=100,$new_height=100,$ext)
    {
        $src_img ="";
        
        $ext = strtolower($ext);
        if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
        $src_img=imagecreatefromjpeg($img_name);
       
        if(!strcmp("png",$ext))
        $src_img=imagecreatefrompng($img_name);

        if(!strcmp("gif",$ext))
        $src_img=imagecreatefromgif($img_name);

        $old_x=imageSX($src_img);
        $old_y=imageSY($src_img);

        $ratio1=$old_x/$new_width;
        $ratio2=$old_y/$new_height;

        if($ratio1>$ratio2) 
        {
            $thumb_w=$new_width;
            $thumb_h=$old_y/$ratio1;
        }
        else 
        {
            $thumb_h=$new_height;
            $thumb_w=$old_x/$ratio2;
        }
    
        $dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
        
        imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
        
        if(!strcmp("png",$ext))
        imagepng($dst_img,$filename);
        else if(!strcmp("gif",$ext))
        imagegif($dst_img,$filename);
        else
        imagejpeg($dst_img,$filename);
        
        //destroys source and destination images.
        imagedestroy($dst_img);
        imagedestroy($src_img);
    }	

	function ResizeSemiAbstractTop($resource, $w = 100, $h = 100){
		$sw = imagesx($resource);
		$sh = imagesy($resource);
		$ar = $sw/$sh;
		$tar = $w/$h;
		if($ar >= $tar){
			$x1 = round(($sw - ($sw * ($tar/$ar)))/2);
			$x2 = round($sw * ($tar/$ar));
			$y1 = 0;
			$y2 = $sh;
		}else{
			$x1 = 0;
			$y1 = 0;
			$x2 = $sw;
			$y2 = round($sw/$tar);
		}
		
		if(!($slate = @imagecreatetruecolor($w, $h))) {
			return false;
		}
		imagecopyresampled($slate, $resource, 0, 0, $x1, $y1, $w, $h, $x2, $y2);
		return $slate;
	}
	
	function zoomCrop($imgSrc,$newfilename,$new_width=100,$new_height=100,$zoom_crop=1,$quality=80,$output=false){
		
		
		$extension =  strtolower($this->getExtension($imgSrc,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		//saving the image into memory (for manipulation with GD Library)
		switch($extension) {
			case 'gif':
			$image = imagecreatefromgif($this->path.$imgSrc);
			break;
			case 'jpg':
			$image = imagecreatefromjpeg($this->path.$imgSrc);
			break;
			case 'png':
			$image = imagecreatefrompng($this->path.$imgSrc);
			break;
		}
		
		list($width, $height) = getimagesize($this->path.$imgSrc); 
		//$width = imagesx( $this->path.$imgSrc);
		//$height = imagesy( $this->path.$imgSrc );
		
		// don't allow new width or height to be greater than the original
		if( $new_width > $width ) { $new_width = $width; }
		if( $new_height > $height ) { $new_height = $height; }
	
		// generate new w/h if not provided
		if( $new_width && !$new_height ) {
			$new_height = $height * ( $new_width / $width );
		}
		elseif($new_height && !$new_width) {
			$new_width = $width * ( $new_height / $height );
		}
		elseif(!$new_width && !$new_height) {
			$new_width = $width;
			$new_height = $height;
		}

		
		// create a new true color image
		$canvas = imagecreatetruecolor( $new_width, $new_height );
        
        if($extension == 'png'){
            imagealphablending( $canvas, false );
            imagesavealpha( $canvas, true );
        }


	  	if( $zoom_crop ) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width  / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source

		if ( $cmp_x > $cmp_y ) {

			$src_w = round( ( $width / $cmp_x * $cmp_y ) );
			$src_x = round( ( $width - ( $width / $cmp_x * $cmp_y ) ) / 2 );

		}elseif ( $cmp_y > $cmp_x ) {
	
				$src_h = round( ( $height / $cmp_y * $cmp_x ) );
				$src_y = round( ( $height - ( $height / $cmp_y * $cmp_x ) ) / 2 );
	
			}
			
			imagecopyresampled( $canvas, $image, 0, 0, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h );
	
		}else {
			// copy and resize part of an image with resampling
			imagecopyresampled( $canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
		}
		
	
		if($output == false){
			if($extension=="jpg" ){
				imagejpeg( $canvas,$this->path.$newfilename, $quality );
			}elseif($extension=="gif" ){
				imagegif( $canvas, $this->path.$newfilename );
			}elseif($extension=="png" ){
				imagepng( $canvas, $this->path.$newfilename,  9 );
			}
		}else{
			//final output  
			//imagejpeg($thumb);
			if($extension=="jpg" ){
				header('Content-type: image/jpeg');
				imagejpeg($canvas);
			}elseif($extension=="gif" ){
				header('Content-type: image/gif');
				imagegif($canvas);
			}elseif($extension=="png" ){
				header('Content-type: image/png');
				imagepng($canvas);
			}
		} 
		imagedestroy($canvas); 
	}
	
	function jcropSupport($cords,$currentfile,$newfilename,$boxSize,$quality){
		$targ_w = $targ_h = $boxSize;
		
		
		$img_r = imagecreatefromjpeg($this->path.$currentfile);
		$crop = imagecreatetruecolor( $targ_w, $targ_h );
	
		imagecopyresampled($crop,$img_r,0,0,$cords['x'],$cords['y'],
		$targ_w,$targ_h,$cords['w'],$cords['h']);
		
		$extension =  strtolower($this->getExtension($currentfile,false)); 
		if($extension=="jpg" ){
			imagejpeg( $crop,$this->path.$newfilename, $quality );
		}elseif($extension=="gif" ){
			imagegif( $crop, $this->path.$newfilename );
		}elseif($extension=="png" ){
			imagepng( $crop, $this->path.$newfilename, ceil( 9 ) );
		}
	}
	
	/**
		Helper for jCrop Plugin
	*/
	function jCrop($src,$x,$y,$w,$h,$file_prefix='',$output=false,$quality=100,$fresh_name=false){

		$extension =  strtolower($this->getExtension($src,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
		
		if($fresh_name == false){
			$newImgName = $file_prefix.$src;
		}else{
			$newImgName = $file_prefix; //file_prefix contains full fresh
		}
		//saving the image into memory (for manipulation with GD Library)
		switch($extension) {
			case 'gif':
			$img_r = imagecreatefromgif($this->path.$src);
			break;
			case 'jpg':
			$img_r = imagecreatefromjpeg($this->path.$src);
			break;
			case 'png':
			$img_r = imagecreatefrompng($this->path.$src);
			break;
		}
		
		$targ_w = $w;
		$targ_h = $h;
		$dst_r = imagecreatetruecolor( $targ_w, $targ_h );
	    if($extension == 'png'){
            imagealphablending( $dst_r, false );
            imagesavealpha( $dst_r, true );
        }
		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
		
		if($output){
			if($extension=="jpg" ){
				header('Content-type: image/jpeg');
				imagejpeg($dst_r);
			}elseif($extension=="gif" ){
				header('Content-type: image/gif');
				imagegif($dst_r);
			}elseif($extension=="png" ){
				header('Content-type: image/png');
				imagepng($dst_r);
			}
		}else{
			$return = false;
			if($extension=="jpg" ){
				imagejpeg( $dst_r,$this->path.$newImgName, $quality );
				$return = true;
			}elseif($extension=="gif" ){
				imagegif( $dst_r, $this->path.$newImgName );
				$return = true;
			}elseif($extension=="png" ){
				imagepng( $dst_r, $this->path.$newImgName, ceil( 9 ) );
				$return = true;
			}
			return $return;
		}
	}
    
    function QuickWaterMark($stamp_path,$image_path,$newfile_name_path='',$quality=100)
    {
                               
        $extensionStamp =  strtolower($this->getExtension($stamp_path,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

        switch($extensionStamp) {
            case 'gif':
            $stamp = imagecreatefromgif($stamp_path);
            break;
            case 'jpg':
            $stamp = imagecreatefromjpeg($stamp_path);
            break;
            case 'png':
            $stamp = imagecreatefrompng($stamp_path);
            break;
        }
        
        $extensionImg =  strtolower($this->getExtension($image_path,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P
        

        switch($extensionImg) {
            case 'gif':
            $im = imagecreatefromgif($image_path);
            break;
            case 'jpg':
            $im = imagecreatefromjpeg($image_path);
            break;
            case 'png':
            $im = imagecreatefrompng($image_path);
            break;
        }

        // Set the margins for the stamp and get the height/width of the stamp image
        //$marge_right = 10;
        //$marge_bottom = 10;
        
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);
        
        $position_center = ceil((imagesx($im) - $sx) / 2);
        $position_middle = ceil((imagesy($im) - $sy) / 2);

        // Copy the stamp image onto our photo using the margin offsets and the photo 
        // width to calculate positioning of the stamp. 
        //imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        
        imagecopy($im, $stamp, $position_center, $position_middle, 0, 0, imagesx($stamp), imagesy($stamp));


        $savedFilenamePath = $image_path;
        if($newfile_name_path != ""){
             $savedFilenamePath = $newfile_name_path;        
        }
        
        if($extensionImg=="jpg" ){
            imagejpeg( $im,$savedFilenamePath, $quality );
        }elseif($extensionImg=="gif" ){
            imagegif( $im, $savedFilenamePath );
        }elseif($extensionImg=="png" ){
            imagepng( $im, $savedFilenamePath,  9 );
        }
    }
    
	
	function makeIcons_MergeCenter($src, $dst, $dstx, $dsty){

//$src = original image location
//$dst = destination image location
//$dstx = user defined width of image
//$dsty = user defined height of image

$allowedExtensions = 'jpg jpeg gif png';

$name = explode(".", $src);
$currentExtensions = $name[count($name)-1];
$extensions = explode(" ", $allowedExtensions);

for($i=0; count($extensions)>$i; $i=$i+1){
if($extensions[$i]==$currentExtensions)
{ $extensionOK=1;
$fileExtension=$extensions[$i];
break; }
}

if($extensionOK){

$size = getImageSize($src);
$width = $size[0];
$height = $size[1];

if($width >= $dstx AND $height >= $dsty){

$proportion_X = $width / $dstx;
$proportion_Y = $height / $dsty;

if($proportion_X > $proportion_Y ){
$proportion = $proportion_Y;
}else{
$proportion = $proportion_X ;
}
$target['width'] = $dstx * $proportion;
$target['height'] = $dsty * $proportion;

$original['diagonal_center'] =
round(sqrt(($width*$width)+($height*$height))/2);
$target['diagonal_center'] =
round(sqrt(($target['width']*$target['width'])+
($target['height']*$target['height']))/2);

$crop = round($original['diagonal_center'] - $target['diagonal_center']);

if($proportion_X < $proportion_Y ){
$target['x'] = 0;
$target['y'] = round((($height/2)*$crop)/$target['diagonal_center']);
}else{
$target['x'] =  round((($width/2)*$crop)/$target['diagonal_center']);
$target['y'] = 0;
}

if($fileExtension == "jpg" OR $fileExtension=='jpeg'){
$from = ImageCreateFromJpeg($src);
}elseif ($fileExtension == "gif"){
$from = ImageCreateFromGIF($src);
}elseif ($fileExtension == 'png'){
 $from = imageCreateFromPNG($src);
}

$new = ImageCreateTrueColor ($dstx,$dsty);

imagecopyresampled ($new,  $from,  0, 0, $target['x'],
$target['y'], $dstx, $dsty, $target['width'], $target['height']);

 if($fileExtension == "jpg" OR $fileExtension == 'jpeg'){
imagejpeg($new, $dst, 70);
}elseif ($fileExtension == "gif"){
imagegif($new, $dst);
}elseif ($fileExtension == 'png'){
imagepng($new, $dst);
}
}
}
}

}//iceImage class ends