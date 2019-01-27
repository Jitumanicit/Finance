<?php
require_once(dirname(__FILE__).'/../config.php');


class upload{

	public $target_file;
	private $max_filesize = 500000;
	private $error;
	private $target_dir;

	private $tmp_name;
	private $file_name;
	private $file_size;
	private $file_type;
	private $full_name;
	private $thumb_name;
	private $target_thumb_file;


	private $image;
    private $width;
    private $height;
    private $imageResized;
 


	function __construct($file , $target_dir = 'upload'){
		
		$this->file = $file;
		$this->target_dir = $target_dir."/";
		$this->tmp_name = $_FILES[$file]["tmp_name"];
		$this->file_name = $_FILES[$file]["name"];
		$this->file_size = $_FILES[$file]["size"];
		$this->file_type = $_FILES[$file]["type"];

        $this->mkdir($this->target_dir);

		$this->target_file = $this->target_dir . basename($_FILES[$this->file]["name"]);
		$this->file_type = pathinfo($this->target_file,PATHINFO_EXTENSION);
        $this->set_filename(time());

	}

	
	function set_directory($dir_name = ""){
		if($dir_name){
		$this->target_dir = $dir_name."/";	
		}
		$this->mkdir($this->target_dir);
		$this->target_file = $this->target_dir . basename($_FILES[$this->file]["name"]);		
		$this->file_type = pathinfo($this->target_file,PATHINFO_EXTENSION);	
		$this->set_filename(time());	
	 
	}


	function set_filename($file_name = ""){
	 $file_name = $file_name.".";
	 $this->target_file = $this->target_dir . basename($file_name.$this->file_type);
     $this->set_thumb_name($file_name);
	}


	function set_thumb_name($thumb_name = "", $prefix = TRUE){
	 $thumb_name = $thumb_name;
	 if($prefix){
	 	 $thumb_name = "thumb_".$thumb_name;
	 }
	  $this->target_thumb_file = $this->target_dir . basename($thumb_name.$this->file_type);
	}


	function set_max_size($max_file = ""){
	 $this->max_filesize = $max_file;
	}


	function mkdir($dir, $mode = 0777){

	 if(!file_exists($dir)){
		  return  mkdir($dir, $mode);
		}else{			
			return FALSE;
        }

	}

	
	function error(){
	 return $this->error;
	}

 	function is_ok(){
	 if(isset($this->error))
	  return FALSE;
	 else
	  return TRUE;
	}


	function check(){

		$file_type = $this->file_type;
		
		if ($this->file_size > $this->max_filesize){
		    //echo "Sorry, your file is too large.";
		   $this->error = FALSE; echo "size";

		}elseif($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif" ){

			   $this->error = FALSE; echo "jpg";

			}else{

				return TRUE;
			}


	}

	function upload(){			

		if($this->check() == TRUE){
			$this->mkdir($this->target_dir);
			move_uploaded_file($this->tmp_name, $this->target_file);

		// return $this->target_file;
        return $this->return_path($this->target_file);
		}
	}


	function thumbnail($newWidth = 150, $newHeight = 100, $option="auto"){		
		
		$this->image = $this->openImage(); 
        // *** Get width and height //$this->thumb_name
        $this->width  = imagesx($this->image);
        $this->height = imagesy($this->image);

		$this->resizeImage($newWidth, $newHeight, $option); //(150, 100, 'crop');		
		$this -> saveImage($this->target_thumb_file , 100);

		// return $this->target_thumb_file;
        return $this->return_path($this->target_thumb_file);

	}


    public function return_path($path){
        $arr = explode('/', $path);

            foreach ($arr as  $value) {
                if($value === '..'){ unset($arr['0']);}   
            }

                return implode('/', $arr);
    }

##########################################################

private function openImage()
{
	   // *** Get extension
    $extension = strtolower(strrchr($this->target_file, '.'));
 
    switch($extension){
        case '.jpg':
        case '.jpeg':
            $img = @imagecreatefromjpeg($this->target_file);
            break;
        case '.gif':
            $img = @imagecreatefromgif($this->target_file);
            break;
        case '.png':
            $img = @imagecreatefrompng($this->target_file);
            break;
        default:
            $img = false;
            break;
    }
    return $img;
}

// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
public function resizeImage($newWidth, $newHeight, $option="auto")
{
 
    // *** Get optimal width and height - based on $option
    $optionArray = $this->getDimensions($newWidth, $newHeight, strtolower($option));
 
    $optimalWidth  = $optionArray['optimalWidth'];
    $optimalHeight = $optionArray['optimalHeight'];
 
    // *** Resample - create image canvas of x, y size
    $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
    imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);
 
    // *** if option is 'crop', then crop too
    if ($option == 'crop') {
        $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
    }
}






private function getDimensions($newWidth, $newHeight, $option)
{
 
   switch ($option)
    {
        case 'exact':
            $optimalWidth = $newWidth;
            $optimalHeight= $newHeight;
            break;
        case 'portrait':
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
            break;
        case 'landscape':
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
            break;
        case 'auto':
            $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
            $optimalWidth = $optionArray['optimalWidth'];
            $optimalHeight = $optionArray['optimalHeight'];
            break;
        case 'crop':
            $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
            $optimalWidth = $optionArray['optimalWidth'];
            $optimalHeight = $optionArray['optimalHeight'];
            break;
    }
    return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
}




########################################

private function getSizeByFixedHeight($newHeight)
{
    $ratio = $this->width / $this->height;
    $newWidth = $newHeight * $ratio;
    return $newWidth;
}
 
private function getSizeByFixedWidth($newWidth)
{
    $ratio = $this->height / $this->width;
    $newHeight = $newWidth * $ratio;
    return $newHeight;
}
 
private function getSizeByAuto($newWidth, $newHeight)
{
    if ($this->height < $this->width)
    // *** Image to be resized is wider (landscape)
    {
        $optimalWidth = $newWidth;
        $optimalHeight= $this->getSizeByFixedWidth($newWidth);
    }
    elseif ($this->height > $this->width)
    // *** Image to be resized is taller (portrait)
    {
        $optimalWidth = $this->getSizeByFixedHeight($newHeight);
        $optimalHeight= $newHeight;
    }
    else
    // *** Image to be resizerd is a square
    {
        if ($newHeight < $newWidth) {
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
        } else if ($newHeight > $newWidth) {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
        } else {
            // *** Sqaure being resized to a square
            $optimalWidth = $newWidth;
            $optimalHeight= $newHeight;
        }
    }
 
    return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
}
 
private function getOptimalCrop($newWidth, $newHeight)
{
 
    $heightRatio = $this->height / $newHeight;
    $widthRatio  = $this->width /  $newWidth;
 
    if ($heightRatio < $widthRatio) {
        $optimalRatio = $heightRatio;
    } else {
        $optimalRatio = $widthRatio;
    }
 
    $optimalHeight = $this->height / $optimalRatio;
    $optimalWidth  = $this->width  / $optimalRatio;
 
    return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
}

######################################



private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
{
    // *** Find center - this will be used for the crop
    $cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
    $cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );
 
    $crop = $this->imageResized;
    //imagedestroy($this->imageResized);
 
    // *** Now crop from center to exact requested size
    $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
    imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
}



public function saveImage($savePath, $imageQuality="100")
{
    // *** Get extension
    $extension = strrchr($savePath, '.');
    $extension = strtolower($extension);
 
    switch($extension)
    {
        case '.jpg':
        case '.jpeg':
            if (imagetypes() & IMG_JPG) {
                imagejpeg($this->imageResized, $savePath, $imageQuality);
            }
            break;
 
        case '.gif':
            if (imagetypes() & IMG_GIF) {
                imagegif($this->imageResized, $savePath);
            }
            break;
 
        case '.png':
            // *** Scale quality from 0-100 to 0-9
            $scaleQuality = round(($imageQuality/100) * 9);
 
            // *** Invert quality setting as 0 is best, not 9
            $invertScaleQuality = 9 - $scaleQuality;
 
            if (imagetypes() & IMG_PNG) {
                imagepng($this->imageResized, $savePath, $invertScaleQuality);
            }
            break;
 
        // ... etc
 
        default:
            // *** No extension - No save.
            break;
    }
 
    imagedestroy($this->imageResized);
}







}
/*class ends*/


?>