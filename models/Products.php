<?php

namespace app\models;

use Yii;

use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $glass
 * @property string|null $mullion
 * @property string|null $color
 * @property float|null $depth
 * @property float|null $height
 * @property float|null $width
 * @property int $quantity
 * @property string|null $photo
 * @property string|null $name
 * @property string|null $options
 * @property string|null $description
 * @property float $price_netto
 * @property float $discount
 * @property int $is_template
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['depth', 'height', 'width', 'price_netto', 'discount'], 'number'],
            ['photo', 'file', 'extensions' => ['png', 'jpg', 'jpeg'], ],
            [['quantity', 'price_netto', 'is_template'], 'required'],
            [['quantity', 'is_template','offer_number'], 'integer'],
            [['glass', 'mullion', 'color', 'name', 'options', 'description','group'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offer_number' => 'Offer Number',
            'group' => 'Group',
            'glass' => 'Glass',
            'mullion' => 'Mullion',
            'color' => 'Color',
            'depth' => 'Depth',
            'height' => 'Height',
            'width' => 'Width',
            'quantity' => 'Quantity',
            'photo' => 'Photo',
            'name' => 'Name',
            'options' => 'Options',
            'description' => 'Description',
            'price_netto' => 'Price Netto',
            'discount' => 'Discount',
            'is_template' => 'Is Template',
        ];
    }
    public function isTemplate(){
        return $this->is_template == 1;
    }
   static public function getProductsTemplates(){
        $query = Products::find()->where(['is_template' => 1]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if ($this->photo instanceof UploadedFile) {
    //         $uploadetPhoto = UploadedFile::getInstance($this, 'photo');
    //         $fileContent = file_get_contents($uploadetPhoto->tempName);
    //         $this->photo = $fileContent;
    //     }
    //         return true;
          
    //     }
    //     return false;
    // }

}
