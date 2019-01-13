<?php

/**
 * Image Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Image extends Model
{
    protected $image;

    function load($filename)
    {
        $image_info = getimagesize($filename);
        $image_type = $image_info[2];
        if( $image_type == IMAGETYPE_JPEG ) {
           $this->image = imagecreatefromjpeg($filename);
        } elseif( $image_type == IMAGETYPE_GIF ) {
           $this->image = imagecreatefromgif($filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {
           $this->image = imagecreatefrompng($filename);
        }
        return $this;
    }
    
    function loadFromString($string)
    {
        $this->image = imagecreatefromstring($string);
        return $this;
    }

    function save($filename, $image_type=IMAGETYPE_JPEG, $compression=100, $permissions=null)
    {
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image,$filename,$compression);
        } elseif( $image_type == IMAGETYPE_GIF ) {
            imagealphablending($this->image, false);
            imagesavealpha($this->image, true);
            imagegif($this->image,$filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {
            imagealphablending($this->image, false);
            imagesavealpha($this->image, true);
            imagepng($this->image,$filename);
        }
        else return false;
        if( $permissions != null) {
            chmod($filename,$permissions);
        }
        return true;
    }

    function output($image_type=IMAGETYPE_JPEG)
    {
        if( $image_type == IMAGETYPE_JPEG ) {
           imagejpeg($this->image);
        } elseif( $image_type == IMAGETYPE_GIF ) {
           imagegif($this->image);
        } elseif( $image_type == IMAGETYPE_PNG ) {
           imagepng($this->image);
        }
    }

    function getWidth()
    {
        return imagesx($this->image);
    }

    function getHeight()
    {
        return imagesy($this->image);
    }

    function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        return $this->resize($width,$height);
    }

    function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getHeight() * $ratio;
        return $this->resize($width,$height);
    }

    function shrinkToHeight($height)
    {
        return ($this->getHeight() > $height) ? $this->resizeToHeight($height) : $this;
    }

    function shrinkToWidth($width)
    {
        return ($this->getWidth() > $width) ? $this->resizeToWidth($width) : $this;
    }

    function scale($scale)
    {
        $width = $this->getWidth() * $scale/100;
        $height = $this->getheight() * $scale/100;
        return $this->resize($width,$height);
    }

    function resize($width,$height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagealphablending($new_image, false);
        imagesavealpha($new_image,true);
        imagefilledrectangle($new_image, 0, 0, $width, $height, imagecolorallocatealpha($new_image, 255, 255, 255, 127));
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
        return $this;
    }

    function shrink($width,$height)
    {
        if ($this->getWidth()/$width > $this->getHeight()/$height)
            return $this->shrinkToWidth($width);
        else
            return $this->shrinkToHeight($height);
    }

    /**
     * Cropping
     *
     * @param int $x
     * @param int $y
     * @param int $w
     * @param int $h
     */
    function crop($x, $y, $w, $h)
    {
        $new_image = imagecreatetruecolor($w, $h);
        imagealphablending($new_image, false);
        imagesavealpha($new_image,true);
        imagefilledrectangle($new_image, 0, 0, $w, $h, imagecolorallocatealpha($new_image, 255, 255, 255, 127));
        imagecopyresampled($new_image, $this->image, 0, 0, $x, $y, $w, $h, $w, $h);
        $this->image = $new_image;
        return $this;
    }

    function cropAuto()
    {
        $w = $this->getWidth();
        $h = $this->getHeight();
        $x = 0;
        $y = 0;
        if ($w > $h)
        {
            $x = $w/2-$h/2;
            $w = $h;
        }
        elseif ($h > $w)
        {
            $y = $h/2-$w/2;
            $h = $w;
        }
        return $this->crop($x, $y, $w, $h);
    }

    function cropToHeight($h)
    {
        if ($h > $this->getHeight())
            return $this;

        $w = $this->getWidth();
        $x = 0;
        $y = $this->getHeight()/2-$h/2;
        return $this->crop($x, $y, $w, $h);
    }

    function cropToWidth($w)
    {
        if ($w > $this->getWidth())
            return $this;

        $h = $this->getHeight();
        $x = $this->getWidth()/2-$w/2;
        $y = 0;
        return $this->crop($x, $y, $w, $h);
    }

    function make($w,$h)
    {
        if ($this->getWidth()/$w > $this->getHeight()/$h)
            return $this->shrinkToHeight($h)->cropToWidth($w);
        else
            return $this->shrinkToWidth($w)->cropToHeight($h);
    }

    function framing($width, $height)
    {
        $this->shrink($width, $height);
        $w = $this->getWidth();
        $h = $this->getHeight();
        $x = $width/2-$w/2;
        $y = $height/2-$h/2;
        $new_image = imagecreatetruecolor($width, $height);
        imagealphablending($new_image, false);
        imagesavealpha($new_image,true);
        imagefilledrectangle($new_image, 0, 0, $width, $height, imagecolorallocatealpha($new_image, 255, 255, 255, 127));
        imagecopyresampled($new_image, $this->image, $x, $y, 0, 0, $w, $h, $w, $h);
        $this->image = $new_image;
        return $this;
    }
    
    function watermark($imgpath)
    {
        $x = $this->getWidth();
        $y = $this->getHeight();
        
        $wm = clone $this;
        $wm->load($imgpath);
        
        //imagecolortransparent($wm->image, imagecolorallocate($wm->image,255,255,255));
        //imagealphablending($wm->image, true);
        //imagesavealpha($wm->image, false);
        imagecopymerge($this->image, $wm->image, $x-$wm->getWidth(), $y-$wm->getHeight(), 0, 0, $x, $y, 30);
        
        return $this;
    }
    
    function watermark2($imgpath)
    {
        $x = $this->getWidth();
        $y = $this->getHeight();
        
        $wm = clone $this;
        $wm->load($imgpath);
        
        $wmx = $wm->getWidth();
        $wmy = $wm->getHeight();
        $distance = $wm->getWidth()*2;
        
        //imagecolortransparent($wm->image, imagecolorallocate($wm->image,255,255,255));
        //imagealphablending($wm->image, true);
        //imagesavealpha($wm->image, true);
        for ($i=0;$i<ceil($x/$distance);$i++)
        {
            for ($j=0;$j<ceil($y/$distance);$j++)
            {
                imagecopymerge($this->image, $wm->image, (($j % 2==1)?$distance/2:0)+$distance*$i+$wmx, $distance*$j+$wmx, 0, 0, $wmx, $wmy, 30);
            }
        }
        return $this;
    }
    
    function watermark3($imgpath)
    {
        $x = $this->getWidth();
        $y = $this->getHeight();
        
        $wm = clone $this;
        $wm->load($imgpath);
        
        $wm->image = imagerotate($wm->image, 45, 0);
        imagealphablending($wm->image, true); 
        imagesavealpha($wm->image, true); 

        $wmx = $wm->getWidth();
        $wmy = $wm->getHeight();
        $distance = $wm->getWidth()*2;
        
        for ($i=0;$i<ceil($x/$distance);$i++)
        {
            for ($j=0;$j<ceil($y/$distance);$j++)
            {
                imagecopymerge($this->image, $wm->image, (($j % 2==1)?$distance/2:0)+$distance*$i+$wmx, $distance*$j+$wmx, 0, 0, $wmx, $wmy, 30);
            }
        }
        return $this;
    }
}