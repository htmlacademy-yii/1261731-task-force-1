<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $address
 * @property string $description
 * @property int $category_id
 * @property int $current_executor_id
 * @property string $status
 * @property int|null $city_id
 * @property string|null $latitude
 * @property string|null $longitude
 * @property float|null $budget
 * @property string|null $date_finished
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Categories $category
 * @property Chats[] $chats
 * @property Cities $city
 * @property Comments[] $comments
 * @property Users $currentExecutor
 * @property Files[] $files
 * @property Replies[] $replies
 * @property Users $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'address', 'description', 'category_id', 'current_executor_id', 'status', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'category_id', 'current_executor_id', 'city_id'], 'integer'],
            [['title', 'description'], 'string'],
            [['budget'], 'number'],
            [['date_finished', 'created_at', 'updated_at'], 'safe'],
            [['address', 'status', 'latitude', 'longitude'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['current_executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['current_executor_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'address' => 'Address',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'current_executor_id' => 'Current Executor ID',
            'status' => 'Status',
            'city_id' => 'City ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'budget' => 'Budget',
            'date_finished' => 'Date Finished',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chats::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[CurrentExecutor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentExecutor()
    {
        return $this->hasOne(Users::className(), ['id' => 'current_executor_id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Replies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Replies::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
