<?php
namespace msvdev\widgets\mappicker;

use yii\web\AssetBundle;

/**
 * Class MapYandexAsset
 * @package msvdev\widgets\mappicker
 */
class MapYandexAsset extends AssetBundle{
    /**
     * @var string map language
     */
    public static $language = 'en_US';
    /**
     * @var string yandex maps api key
     * @see https://developer.tech.yandex.ru/services/3
     */
    public static $apiKey;
    /**
     * @var string yandex map api version
     */
    public static $version = '2.1';
    /**
     * @var string service url
     */
    public $serviceUrl = 'https://api-maps.yandex.ru';
    /**
     * @var string assets source path
     */
    public $sourcePath = '@msvdev/widgets/mappicker/assets';
    /**
     * @var array js options
     */
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    /**
     * @var array need js array
     */
    public $js = [
        'js/yandex-map.js'
    ];

    /**
     * Register service library
     */
    public function init(){
        parent::init();
        $this->js[] = $this->getMapLibrary();
    }

    /**
     * @return string build service library url
     */
    protected function getMapLibrary(){
        $libraryUrl = $this->serviceUrl.'/'.self::$version.'/?';

        $queryData = [
            'lang' => self::$language
        ];
        if (!empty(self::$apiKey)) {
            $queryData['apikey'] = self::$apiKey;
        }

        $libraryUrl .= http_build_query($queryData);
        return $libraryUrl;
    }
}
