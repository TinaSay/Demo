<?php

namespace tina\news\models;

use krok\configure\ConfigureInterface;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;
use krok\storage\behaviors\StorageBehavior;
use krok\storage\dto\StorageDto;
use krok\storage\interfaces\StorageInterface;
use League\Flysystem\FilesystemInterface;
use tina\news\Configure;
use voskobovich\behaviors\ManyToManyBehavior;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use krok\extend\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property string $announce
 * @property string $text
 * @property integer $hidden
 * @property string $createdAt
 * @property string $updatedAt
 *
 *  * @property Group[] $groupRelation
 */
class News extends \yii\db\ActiveRecord implements StorageInterface, HiddenAttributeInterface
{
    use HiddenAttributeTrait;

    /**
     * @var UploadedFile|StorageDto
     */
    private $src;

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function behaviors()
    {
        return [
            'StorageBehaviorImage' => [
                'class' => StorageBehavior::class,
                'attribute' => 'src',
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
            ],
            'ManyToManyBehavior' => [
                'class' => ManyToManyBehavior::class,
                'relations' => [
                    'groupIds' => 'groupRelation',
                ],
            ],
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'groupIds'], 'required'],
            [['date', 'createdAt', 'updatedAt'], 'safe'],
            [['announce', 'text'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['hidden'], 'integer'],
            [
                ['src'],
                'image',
                'extensions' => 'png, jpg, jpeg, gif',
                'skipOnEmpty' => true,
            ],
            [['groupIds'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'date' => 'Дата',
            'announce' => 'Анонс',
            'src' => 'Изображение',
            'text' => 'Текст',
            'hidden' => 'Скрыто',
            'groupIds' => 'Группы новостей',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return static::class;
    }

    /**
     * @return int
     */
    public function getRecordId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getHint(): ?string
    {
        return null;
    }

    /**
     * @param $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return StorageDto|UploadedFile
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        if ($this->src instanceof StorageDto) {
            $configurable = Yii::createObject(ConfigureInterface::class)->get(Configure::class);
            $filesystem = Yii::createObject(FilesystemInterface::class);

            return $filesystem->getPublicUrl($this->src->getSrc(), [
                'w' => $configurable->width,
                'h' => $configurable->height,
                'fit' => $configurable->fit,
            ]);
        }

        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRelation()
    {
        return $this->hasMany(Group::class, ['id' => 'groupId'])
            ->viaTable(NewsRelation::tableName(),
                ['newsId' => 'id']);
    }

    /**
     * @return null|string
     */
    public function getGroupsString()
    {
        $list = ArrayHelper::getColumn($this->groupRelation, 'title');
        if (count($list) > 0) {
            return implode(', ', $list);
        } else {
            return null;
        }
    }
}
