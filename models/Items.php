<?php

namespace artsoft\portfolio\models;

use Yii;
use artsoft\models\OwnerAccess;
use artsoft\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use himiklab\sortablegrid\SortableGridBehavior;
use artsoft\helpers\Html;
use artsoft\db\ActiveRecord;

/**
 * This is the model class for table "{{%portfolio_items}}".
 *
 * @property int $id
 * @property int $sortOrder
 * @property int $category_id 
 * @property string $link_href
 * @property string $thumbnail
 * @property string $img_alt
 * @property int $status
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by
 *
 */
class Items extends ActiveRecord implements OwnerAccess 
{
    

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%portfolio_items}}';
    }

     /**
     * @inheritdoc
     */
    public function behaviors() {
        return [            
            TimestampBehavior::className(),
            BlameableBehavior::className(),
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
            [['status', 'category_id', 'link_href', 'thumbnail'], 'required'],
            ['thumbnail', 'unique'],
            [['status'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['link_href', 'img_alt'], 'string', 'max' => 127],
            [['thumbnail'], 'string', 'max' => 255],            
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'category_id' => Yii::t('art', 'Category ID'),
            'link_class' => Yii::t('art', 'Link Class'),
            'link_href' => Yii::t('art/portfolio', 'Link Href'),
            'thumbnail' => Yii::t('art/portfolio', 'Thumbnail'),
            'img_alt' => Yii::t('art/portfolio', 'Img Alt'),
            'status' => Yii::t('art', 'Status'),
            'created_by' => Yii::t('art', 'Created By'),
            'created_at' => Yii::t('art', 'Created'),
            'updated_at' => Yii::t('art', 'Updated'),
            'updated_by' => Yii::t('art', 'Updated By'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
        
     /* Геттер для названия категории */
    public function getCategoryName()
    {
        return $this->category->name;
    }
    
    public function getThumbnail($options = ['class' => 'thumbnail pull-left', 'style' => 'width: 240px'])
    {
        if (!empty($this->thumbnail)) {
            return Html::img($this->thumbnail, $options);
        }

        return;
    }

    /**
     * 
     * @return type array
     */
     public static function getPortfolioItems()
    {
        return self::find()
                ->where(['in', 'status', self::STATUS_ACTIVE])
                ->orderBy(['sortOrder' => SORT_ASC, 'created_at' => SORT_ASC])
                ->asArray()->all();        
    } 
     /**
     *  @return type array to about page
     */
    public static function getPortfolioMasonryItems() {
        
      $data = array();

        foreach (self::getPortfolioItems() as $id => $item) :
            
            $data_cat = Category::getCategory($item['category_id']);
        
            switch ($data_cat['type']) {
                case Category::TYPE_IMAGE: $type = 'image';
                    $link_class = 'item-hover lightbox';
                    $content = '<strong>просмотр</strong> фото';
                    break;
                case Category::TYPE_IFRAME: $type = 'iframe';
                    $link_class = 'item-hover lightbox';
                    $content = '<strong>просмотр</strong> видео';
                    break;
                case Category::TYPE_LINK: $type = '';
                    $link_class = 'item-hover';
                    $content = '<strong>просмотр</strong> проекта';
                    break;
                default: $type = '';
                    $link_class = 'item-hover';
                    $content = '<strong>view</strong> content';
            }
            
            $data[] = [
                    'options' => [
                        'class' => 'isotope-item ' . $data_cat['slug'],
                    ],
                    'link' => [
                        'class' => $link_class,
                        'href' => $item['link_href'],
                        'data' => [
                            'plugin-options' => [
                                'type' => $type,
                            ],
                        ]
                    ],
                    'image' => [
                        'src' => $item['thumbnail'],
                        'options' => [
                            'class' => 'img-responsive',
                            'width' => '320',
                            'height' => '320',
                            'alt' =>  $item['img_alt'],
                        ],
                    ],
                    'content' => '<span class="uppercase">' . $content . '</span>',
            ];

        endforeach;

        return $data;
    }
    /**
     * {@inheritdoc}
     * @return \artsoft\portfolio\models\query\ItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \artsoft\portfolio\models\query\ItemsQuery(get_called_class());
    }
    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullPortfolioAccess';
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
