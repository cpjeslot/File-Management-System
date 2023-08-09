<?php 
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * @author Chetan Patel <cpjeslot@gmail.com>>
*/
class Upload extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;
    public $files_data;
    public $filepath;

    public function rules()
    {
        return [
            [['files'], 'file', 'extensions' => 'xlsx, xls, png, jpg, jpeg, pdf'],
            [['files'], 'file', 'skipOnEmpty' => false],
            [['files'], 'file', 'maxSize' => 5000000, 'message' => 'You are not allowed to upload file more then 5MB'], /// Filesize in KB
            [['files'], 'file', 'minFiles' => '1', 'message' => 'You must upload atleast 1 file.'],
            [['files_data', 'filepath'], 'safe'],
        ];
    }

    public function getFolder($path, $id, $create = true) {

        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }

        $dirarr = [];
		for ($i=0; $i < strlen($id); $i++) {
			$dirarr[] = substr($id, $i, 1);
		}
		$dir = $path . '/' . implode('/', $dirarr);
		
		if (! file_exists($dir) AND $create) {
			$cdir = $path;
			foreach ($dirarr as $dir) {
				$cdir .= '/'.$dir;
				if (! file_exists($cdir))
					mkdir($cdir, 0775);
			}
		}

		return implode('/', $dirarr) . '/';
	}
}