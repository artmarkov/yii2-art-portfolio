<?php

namespace artsoft\portfolio\models;

use Yii;
use artsoft\models\OwnerAccess;
use artsoft\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use himiklab\sortablegrid\SortableGridBehavior;
use artsoft\db\ActiveRecord;

/**
 * This is the model class for table "{{%portfolio_menu}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property int $sortOrder
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property PortfolioMenuCategory[] $portfolioMenuCategories
 */
class Menu extends ActiveRecord implements OwnerAccess 
{
    public $gridCategorySearch;     
         
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%portfolio_menu}}';
    }

     /**
     * @inheritdoc
     */
    public function behaviors() {
        return [                       
            TimestampBehavior::className(),
            BlameableBehavior::className(), 
            [
                'class' => \artsoft\behaviors\ManyHasManyBehavior::className(),
                'relations' => [
                    'categories' => 'categories_list',
                ],
            ],            
            'grid-sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sortOrder',
            ],     
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['name'], 'unique'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'categories_list'], 'safe'],            
            [['description'], 'string'],
            [['status', 'sortOrder'], 'integer'],
            [['name'], 'string', 'max' => 32],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'name' => Yii::t('art', 'Name'),
            'description' => Yii::t('art', 'Description'),
            'status' => Yii::t('art', 'Status'),
            'sortOrder' => Yii::t('art', 'Sort'),
            'created_by' => Yii::t('art', 'Created By'),
            'created_at' => Yii::t('art', 'Created'),
            'updated_at' => Yii::t('art', 'Updated'),
            'updated_by' => Yii::t('art', 'Updated By'),
            'categories_list' => Yii::t('art/portfolio', 'Portfolio Category'),
            'gridCategorySearch' => Yii::t('art/portfolio', 'Portfolio Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
                    ->viaTable('{{%portfolio_menu_category}}', ['menu_id' => 'id']);
    }

     /**
     * 
     * @return type array 
     */
     public static function getPortfolioMenuList()
    {
        return self::find()
                ->where(['in', 'status', self::STATUS_ACTIVE])
                ->orderBy('sortOrder')
                ->asArray()->all();        
    } 
    /**
     *  @return type array to about page
     */
    public static function getPortfolioMenuItems() {
        
        $menuItems[] = [
            'label' => Yii::t('art/portfolio', 'Все материалы'),
            'options' => ['class' => 'active', 'data-option-value' => '*'],
            'template' => '<a href="#">{label}</a>'
        ];


        foreach (self::getPortfolioMenuList() as $id => $item) :

            $menuItems[] = [
                'label' => Yii::t('art/portfolio', $item['name']),
                'options' => ['data-option-value' => Category::getPortfolioMenuOptions($item['id'])],
                'template' => '<a href="#">{label}</a>'
            ];

        endforeach;

        return $menuItems;
    }

    public function getCategoriesLinks()
    {
        return \yii\helpers\ArrayHelper::getColumn($this->categories, 'id');
    }
    
    /**
     * {@inheritdoc}
     * @return \artsoft\portfolio\models\query\MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \artsoft\portfolio\models\query\MenuQuery(get_called_class());
    }
    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullPortfolioMenuAccess';
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
