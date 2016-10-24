<?php
namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Class for managing Sdm application assets.
 */
class SdmAsset extends AssetBundle
{
    public $sourcePath = '@npm';
    public $js = [
        'aes-js/index.js',
        'js-md5/build/md5.min.js',
    ];
}
