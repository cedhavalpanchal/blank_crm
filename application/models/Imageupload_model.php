<?php

/*
  @Description: Image Upload Model
  @Author: Mit Makwana
  @Date: 26-11-2016
 */

class Imageupload_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
      @Description: Function for Big Image Upload
      @Author: Mit Makwana
      @Output: Image will upload on perticular folder
      @Date: 26-11-2016
     */

    function uploadBigImage($uploadFile, $bigImgPath, $thumb, $existImage, $small_image_size,$maintain_ratio = '')
    {
        //echo $bigImgPath;
        if(!empty($bigImgPath) && !file_exists($bigImgPath))
        {
            $pos = strpos($bigImgPath, 'uploads');
            if ($pos !== false) {
               
               $splitString = substr($bigImgPath,$pos+8);

               if(!empty($splitString))
               {
                    $exp = explode('/',$splitString);
                    foreach ($exp as $key => $value) {
                        if(!empty($value))
                        {
                            $dirPath = './uploads/';
                            for($i = 0; $i <= $key;$i++){
                                $dirPath .= $exp[$i];
                                if($i-1 != $key){
                                    $dirPath .= '/';
                                } 
                            }
                            mkdir($dirPath, 0777);
                        }
                    }
               }
            }
        }
        
        
        
        if(!empty($existImage))
        {
            $path = $bigImgPath . $existImage;
            @unlink($path);
            
            if(!empty($small_image_size))
            {
                foreach ($small_image_size as $row)            
                {
                    $thumbPath = $row['imagepath'];
                    
                    $path_thumb = $thumbPath . $existImage;            
                    @unlink($path_thumb);
                }
            }
        }
      
        $upload_name = $uploadFile;
        $config['upload_path'] = $bigImgPath; /* NB! create this dir! */        
        $config['allowed_types'] = '*';        
        $random = substr(md5(rand()), 0, 100);
        $config['file_name'] = $random . "_" . date('ymdhsm');
        $config['overwrite'] = false;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload($upload_name))
        {
            $data = $this->upload->data();
        }else{
            echo $this->upload->display_errors();
            exit;
        }
        
        $sourcePath = $data['full_path'];
        $fileName = $data['file_name'];

        list($width, $height, $type, $attr) = getimagesize($bigImgPath . $fileName);
        
        if (!empty($thumb) && $thumb == 'thumb' && !empty($small_image_size))
        {   
            foreach ($small_image_size as $row)            
            {   

                $thumbPath      = $row['imagepath'];
                $thumbwidth     = $row['width'];
                $thumbHeight    = $row['Height'];
                
                if (!file_exists($thumbPath))
                {
                   
                    mkdir($thumbPath, 0777);
                }
               
                
                $basename = explode('.', $_FILES[$uploadFile]['name']);
                $filename = $basename[0];                
                
                //for create small image
                if ($data['file_type'] == 'image/bmp' || $basename[1] == 'bmp') {
                    $sourceImgBig = base_url() . $bigImgPath . $fileName;
                    copy($sourceImgBig, $thumbPath . $filename . ".jpeg");
                    $imgurl = base_url() . $thumbPath . $filename . ".jpeg";
                    //$width = 150;
                    $this->make_thumb($imgurl, $thumbPath . $fileName, $thumbwidth);
                    @unlink($thumbPath . $filename . ".jpeg");
                } else {
                    $filename = $this->uploadSmallImage($sourcePath, $thumbPath, $fileName, $thumbwidth, $thumbHeight,$maintain_ratio);
                }
                
                unset($row);
            }
        }
        return $fileName;
    }

    
     /*
      @Description: Function for Big Image Upload
      @Author: Pradeep khot
      @Output: File will upload on perticular folder
      @Date: 08-08-2016
     */

    function uploadBigImage_file($uploadFile, $bigImgPath, $thumb, $existImage, $small_image_size)
    {
        //echo $smallImgPath;exit;
		if (!file_exists($bigImgPath)) {
			mkdir($bigImgPath, 0777);
		} 
		
		if(!empty($existImage)){
			$path = $bigImgPath.$existImage;
			$path_thumb = $smallImgPath.$existImage;
			@unlink($path);
			@unlink($path_thumb);
		}
	
                $upload_name = $uploadFile;
		$config['upload_path'] = $bigImgPath; /* NB! create this dir! */  
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg|csv|doc|docx|txt|pdf|xls|xlsx|mov|mp4';
		//$config['allowed_types'] = '*';
		
		$random = substr(md5(rand()),0,7);
		$config['file_name'] = $random."-".(strtolower($_FILES[$uploadFile]['name']));
		$config['overwrite'] = false;  
		
		$this->load->library('upload', $config);  
		$this->upload->initialize($config);
		
		if($this->upload->do_upload($upload_name))
			$data = $this->upload->data();
		else
		{
			echo $this->upload->display_errors();
			exit;
		}
		$sourcePath = $data['full_path'];
		$thumbPath = $smallImgPath;
		//$thumbPath1 = $this->config->item('temp_medium_img_path');
		$fileName = $data['file_name'];
		
		if(!empty($thumb) && ($thumb=='thumb' || $thumb=='thumb1')){
			if (!file_exists($smallImgPath)) {
				mkdir($bigImgPath, 0777);
			}
			
			$basename = explode('.', $_FILES[$uploadFile]['name']);
			$filename =$basename[0];
			//for create small image
			if($data['file_type'] == 'image/bmp' || $basename[1] == 'bmp')
			{
			$sourceImgBig = base_url().$bigImgPath.$fileName;
			copy($sourceImgBig,$smallImgPath.$filename.".jpeg"); 
			$imgurl = base_url().$smallImgPath.$filename.".jpeg";
			if($thumb == 'thumb1')
				$width = 20;
			else
				$width = 150;
			$this->make_thumb($imgurl,$smallImgPath.$fileName, $width);
			@unlink($smallImgPath.$filename.".jpeg");
			}
			else
			{
				if($thumb == 'thumb1')
					$filename1 = $this->uploadSmallImage1($sourcePath,$thumbPath,$fileName);	
				else
					$filename = $this->uploadSmallImage($sourcePath,$thumbPath,$fileName);	
			}
			//
			
		}
           
		return $fileName; 
    }
    
    function make_thumb($src, $dest, $desired_width) {
        $param = getimagesize($src);
        if ($param['mime'] == "image/png") {
            $source_image = imagecreatefrompng($src);
        } else if ($param['mime'] == "image/x-ms-bmp") {
            $source_image = $this->imagecreatefrombmp($src);
        } else if ($param['mime'] == "image/gif") {
            $source_image = imagecreatefromgif($src);
        } else {
            $source_image = imagecreatefromjpeg($src);
        }
        //$source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        $desired_height = floor($height * ($desired_width / $width));
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
        imagejpeg($virtual_image, $dest);
    }

    function imagecreatefrombmp($p_sFile) {
        $file = fopen($p_sFile, "rb");
        $read = fread($file, 10);
        while (!feof($file) && ($read <> ""))
            $read .= fread($file, 1024);

        $temp = unpack("H*", $read);
        $hex = $temp[1];
        $header = substr($hex, 0, 108);

        if (substr($header, 0, 4) == "424d") {
            $header_parts = str_split($header, 2);

            $width = hexdec($header_parts[19] . $header_parts[18]);

            $height = hexdec($header_parts[23] . $header_parts[22]);

            unset($header_parts);
        }

        $x = 0;
        $y = 1;

        $image = imagecreatetruecolor($width, $height);

        $body = substr($hex, 108);

        $body_size = (strlen($body) / 2);
        $header_size = ($width * $height);

        $usePadding = ($body_size > ($header_size * 3) + 4);

        for ($i = 0; $i < $body_size; $i+=3) {
            if ($x >= $width) {
                if ($usePadding)
                    $i += $width % 4;

                $x = 0;

                $y++;

                if ($y > $height)
                    break;
            }
            $i_pos = $i * 2;
            $r = hexdec($body[$i_pos + 4] . $body[$i_pos + 5]);
            $g = hexdec($body[$i_pos + 2] . $body[$i_pos + 3]);
            $b = hexdec($body[$i_pos] . $body[$i_pos + 1]);

            $color = imagecolorallocate($image, $r, $g, $b);
            imagesetpixel($image, $x, $height - $y, $color);

            $x++;
        }

        unset($body);

        return $image;
    }

    /*
      @Description: Function for Small Image Upload
      @Author: Mit Makwana
      @Input:
      @Output: Image will upload on perticular folder
      @Date: 26-11-2016
     */
    
    public function uploadSmallImage($sourceImgPath, $thumbPath, $fileName = '', $thumbwidth = '', $thumbHeight = '',$maintain_ratio = '')
    {
        $configThumb = array();
        $configThumb['image_library'] = 'gd2';
        $configThumb['thumb_marker'] = FALSE;
        $configThumb['source_image'] = '';
        $configThumb['create_thumb'] = TRUE;
        $configThumb['maintain_ratio'] = !empty($maintain_ratio)?$maintain_ratio:'TRUE';
        $configThumb['width'] = !empty($thumbwidth)?$thumbwidth:150;
        $configThumb['height'] = !empty($thumbHeight)?$thumbHeight:150;
        $this->load->library('image_lib');
        $configThumb['source_image'] = $sourceImgPath;
        $configThumb['new_image'] = $thumbPath;
        $this->image_lib->initialize($configThumb);
        $this->image_lib->resize();
    }
    
    /*
      @Description: Function for Delete image Profile By Admin
      @Author: Mit Makwana
      @Input: - tips id which is delete by admin
      @Output: - Delete recodrs from folder with match image name
      @Date: 26-11-2016
     */

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {

        //echo $thumb_image_name.$image.$width.$height.$start_width.$start_height.$scale;exit;

        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);

        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_image_name, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_image_name);
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }
    
    
    /*
      @Description: Function for Copy file
      @Author: Mit Makwana
      @Date: 07-10-2016
     */
    function copyfile($bgImgPath,$image,$file_name,$sourceImgBig='')
    {
        $this->load->helper("file");
        $sourceImgBig=$sourceImgBig.$file_name;
        $destinationImgBig = $bgImgPath.$file_name;
        copy($sourceImgBig,$destinationImgBig);
     
    }

}