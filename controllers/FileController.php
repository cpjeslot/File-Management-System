<?php
namespace app\controllers;

use app\components\Helper;
use app\models\Attachment;
use kaabar\jwt\JwtHttpBearerAuth;
use yii;
use yii\helpers\FileHelper;
use yii\rest\ActiveController;
use yii\web\UploadedFile;

/**
 * @author Chetan Patel <cpjeslot@gmail.com>>
*/
class FileController extends ActiveController
{
    public $modelClass = 'app\models\Upload';
    
    public function behaviors() {
    	$behaviors = parent::behaviors();

		$behaviors['authenticator'] = [
			'class' => JwtHttpBearerAuth::class,
			'except' => [],
		];

		return $behaviors;
	}

	public function actionUpload()
	{
		$model = new Attachment();
		
		if ($this->request->isPost) {

			if(null == $this->request->post('filepath')){
				Yii::$app->response->statusCode = 412;
                Yii::$app->response->statusText = 'Not Found';
				return [
					'status' => 'error',
					'msg' => 'Filepath not Found...!',
				];
			}

			if(null == $this->request->post('type')){
				Yii::$app->response->statusCode = 412;
                Yii::$app->response->statusText = 'Not Found';
				return [
					'status' => 'error',
					'msg' => 'Project name not Found...!',
				];
			}

			$uploads =  \yii\web\UploadedFile::getInstanceByName('uploads');
			
			if(empty($uploads)){
				Yii::$app->response->statusCode = 412;
                Yii::$app->response->statusText = 'Not Found';
				return [
					'status' => 'error',
					'msg' => 'Files not Found...!',
				];
			}

			$response = [];
			//foreach ($uploads as $index => $file) {
			$model->filepath = $this->request->post('filepath');
			$model->files = $uploads;

			if ($model->validate()) { 
				
				////// Get Upload Path
				$path = Yii::getAlias('@webroot/documents/');
				$folder = $this->request->post('filepath');

				////// Check Upload Path if not available then Create
				FileHelper::createDirectory($path.$folder);

				////// Generat new file name
				$filename = Helper::generateRandomString(20).time(). '.' . $model->files->extension;
				
				if(! is_file($path.$folder.'/'.$filename)){
					if($model->files->saveAs($path.$folder.'/'.$filename)){

						$model->name = $uploads->name;
						$model->file_name = $uploads->name;
						$model->temp_name = $filename;
						$model->path = $path.$folder;
						$model->size = $uploads->size;
						$model->mime = $uploads->type;
						$model->type = $this->request->post('type');
						$model->save(false);

						return [
							'id' => $model->id,
							'name' => $model->temp_name,
							'status' => 'success',
							'msg' => 'File uploaded successfully...!',
						];
					}
					else
					{
						Yii::$app->response->statusCode = 422;
						Yii::$app->response->statusText = 'Data Validation Failed';
						return [
							'status' => 'error',
							'msg' => 'File Not upload, Try again...!',
						];
					}
				}
				else
				{
					Yii::$app->response->statusCode = 422;
					Yii::$app->response->statusText = 'Data Validation Failed';
					return [
						'status' => 'error',
						'msg' => 'File allready exist, Try again...!',
					];
				}
			}
			else
			{
				Yii::$app->response->statusCode = 422;
				Yii::$app->response->statusText = 'Data Validation Failed';
				foreach ($model->getErrors() as $indx => $error) {
					return [
						'status' => 'error',
						'msg' => implode(', ', $error),
					];
				};
			}
			//}


		}
		else
		{
			Yii::$app->response->statusCode = 403;
            Yii::$app->response->statusText = 'unAuthorised Access';
			return [
				'status' => 'error',
				'msg' => 'Request method not allowed',
			];
		}
	}
}