<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class Portfolio extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%Portfolio}}';
    }

    public function rules()
    {
        return [
            [
                ['ProjectName','ProjectDescription', 'ProjectImg', 'ProjectImgThumbnail'], 
                'string'
            ],
            [
                ['TempImg'], 
                'file', 
                'skipOnEmpty' => true, 
                'extensions' => 'png, jpg, jpeg, gif, svg, webp',
            ],

        ];
    }

    public function upload()
    {
        if ($this->validate()){

            $this->ProjectImg = str_replace(' ', '_', $this->TempImg->baseName) . "-". substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;

            $this->ProjectImgThumbnail = str_replace(' ', '_', $this->TempImg->baseName) . "-thumbnail-". substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;

            $this->TempImg->saveAs(Yii::$app->basePath.'/../img/portfolio/'.$this->ProjectImg);

            copy(Yii::$app->basePath.'/../img/portfolio/'.$this->ProjectImg, Yii::$app->basePath.'/../img/portfolio/'.$this->ProjectImgThumbnail);

            //$this->resize_image(Yii::$app->basePath.'/../img/portfolio/'.$this->ProjectImgThumbnail, 400, 300);
            
            $this->TempImg = null;

            return true;
        }else{
            return false;
        }
    }

    public function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        var_dump(getimagesize($file));exit;
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $dst;
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

}
?>