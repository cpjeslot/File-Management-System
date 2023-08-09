<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "attachment".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string|null $file_name
 * @property string|null $temp_name
 * @property string|null $path
 * @property string|null $size
 * @property string|null $mime
 * @property string|null $type
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property string|null $isDeleted
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 *
 * @property Customer $parent
 *
 *
 * @author Chetan Patel <cpjeslot@gmail.com>>
 */
class Attachment extends \yii\db\ActiveRecord
{
    public $files;
    public $filepath;
    public $uploads;
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attachment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['name'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['type', 'isDeleted', 'filepath'], 'string'],
            [['name', 'file_name', 'temp_name', 'path', 'mime'], 'string', 'max' => 255],
            [['size', 'uploads'], 'safe'],

            [['filepath'], 'required'],

            [['files'], 'file', 'extensions' => 'xlsx, xls, png, jpg, jpeg, pdf'],
            [['files'], 'file', 'skipOnEmpty' => true],
            [['files'], 'file', 'maxSize' => 5000000, 'message' => 'You are not allowed to upload file more then 5MB'], /// Filesize in KB
            [['files'], 'file', 'minFiles' => '1', 'message' => 'You must upload atleast 1 file.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Company Name',
            'file_name' => 'File Name',
            'temp_name' => 'Temp Name',
            'path' => 'Path',
            'size' => 'Size',
            'mime' => 'Mime',
            'type' => 'Type',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'isDeleted' => 'Is Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\active\Attachment the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\active\Attachment(get_called_class());
    }
}
