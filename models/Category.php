<?php

namespace artsoft\portfolio\models;

use Yii;

use artsoft\models\OwnerAccess;
use artsoft\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use artsoft\behaviors\SluggableBehavior;
use artsoft\db\ActiveRecord;

/**
 * This is the model class for table "{{%portfolio_category}}".
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $status
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by
 *
 */
class Category extends ActiveRecord implements OwnerAccess
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    const TYPE_IMAGE = 0;
    const TYPE_IFRAME = 1;
    const TYPE_LINK = 2;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%portfolio_category}}';
    }

     /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),         
            [
                'class' => SluggableBehavior::className(),
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true           
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'status'], 'required'],
            [['name', 'slug'], 'unique'],
            [['type', 'status'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['name', 'slug', 'description'], 'string', 'max' => 127],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

     
     public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public function getUpdatedDatetime()
    {
        return "{$this->updatedDate} {$this->updatedTime}";
    }
     
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
     /**
     * getStatusList
     * @return array
     */
    public static function getStatusList()
    {
        return array(
            self::STATUS_ACTIVE => Yii::t('art', 'Active'),
            self::STATUS_INACTIVE => Yii::t('art', 'Inactive'),
        );
    } 
    
    /**
     * getTypeList
     * @return array
     */
    public static function getTypeList()
    {
        return array(
            self::TYPE_IMAGE => 'Image',
            self::TYPE_IFRAME => 'Iframe',
            self::TYPE_LINK => 'Link',
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'name' => Yii::t('art', 'Name'),
            'slug' => Yii::t('art', 'Slug'),
            'description' => Yii::t('art', 'Description'),
            'status' => Yii::t('art', 'Status'),
            'created_by' => Yii::t('art', 'Created By'),
            'created_at' => Yii::t('art', 'Created'),
            'updated_at' => Yii::t('art', 'Updated'),
            'updated_by' => Yii::t('art', 'Updated By'),
        ];
    }
     /**
     * @inheritdoc
     */
    
    public static function getCategories()
    {
        return \yii\helpers\ArrayHelper::map(static::find()
                ->andWhere(['in', 'status', self::STATUS_ACTIVE])
                ->select('id, name')
                ->asArray()->all(), 'id', 'name');
        
    } 
     /**
     * 
     * @return type string
     */
     public static function getPortfolioMenuOptions($menu_id)
    {
        $options = array();
        $items = self::find()
                ->innerJoin('portfolio_menu_category', 'portfolio_menu_category.category_id = portfolio_category.id')
                ->where(['portfolio_menu_category.menu_id' => $menu_id])
                ->asArray()->all();
        
            foreach ($items as $id => $item) { 
                    $options[] = '.' . $item['slug'];
            } 
            
            return implode(",", $options);
    }

    /**
     * 
     * @return type string
     */
    public static function getCategory($category_id) {

        $data = self::find()
                        ->where(['id' => $category_id])
                        ->asArray()->one();
        return $data;
    }
   /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullPortfolioCategoryAccess';
    }
    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }
}
