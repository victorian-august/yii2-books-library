<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    public $date_from;
    public $date_to;

    public function getAuthorName()
    {
        $a = Authors::findOne(['id' => $this->author_id]);
        $author = $a->getAttribute('firstname') . ' ' . $a->getAttribute('lastname');

        return $author;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'preview', 'date', 'author_id'], 'required'],
//            [['date_create', 'date_update'], 'default', 'value' => new Expression('NOW()'), 'on' => 'insert'],
//            ['date_update', 'default', 'value' => new Expression('NOW()'), 'on' => 'update'],
            ['author_id', 'integer'],
            ['name', 'string', 'min' => 1, 'max' => 128],
            ['preview', 'string', 'min' => 5, 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Дата обновления',
            'preview' => 'Превью обложки',
            'date' => 'Дата выхода книги',
            'author_id' => 'Автор'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }
}
