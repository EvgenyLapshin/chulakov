<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property string $id
 * @property string $create_time
 * @property string $change_time
 * @property string $pub_date
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $content
 * @property string $image
 * @property string $user_id
 * @property string $status
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_title
 * @property string $meta_image
 * @property integer $view_count
 * @property integer $is_important
 *
 * @property string url, сссылка на текущий продукт (относительная)
 * @property string absoluteUrl, сссылка на текущий продукт (абсолютная)
 *
 * The followings are the available model relations:
 * @property User $rUser
 *
 * The followings are Behaviors:
 * @mixin SeoBehavior
 * @mixin ModelUploaderBehavior
 */
class News extends StatusActiveRecord
{
    protected $_pageId = 14;

    private $_url;
    private $_absoluteUrl;

    public function tableName()
    {
        return 'news';
    }

    public function behaviors()
    {
        return array(
            'Seo' => array(
                'class' => 'SeoBehavior',
                'title' => 'title'
            ),

            'uploader' => array(
                'class' => 'laco.uploader.ModelUploaderBehavior',
                'attrList' => array(
                    'content' => array(
                        'uploadType' => 'redactor'
                    ),
                    'image' => array(
                        'convertOptions' => array(
                            'thumb' => array('h' => 150, 'q' => 95, 'f' => 'jpeg'),
                            'preview' => array('w' => 1020, 'h' => 280, 'zc' => 1, 'q' => 95, 'f' => 'jpeg'),
                            'basic' => array('w' => 739, 'h' => 493, 'zc' => 1, 'q' => 95, 'f' => 'jpeg')
                        ),
                        'validateRules' => array(
                            'typeAndSize' => array(
                                'allowEmpty' => false,
                                'mimeTypes' => 'image/jpeg,image/png,image/gif,image/pjpeg',
                                'wrongMimeType' => 'Данный тип файла загружать нельзя'
                            ),
                        ),
                        'uploadType' => 'image'
                    ),
                    'meta_image' => array(
                        'convertOptions' => array(
                            'thumb' => array('h' => 150),
                            'basic' => array('f' => 'jpeg', 'q' => 95),
                        ),
                        'validateRules' => array(
                            'dimension' => array('maxWidth' => 1980, 'maxHeight' => 1200, 'minWidth' => 200, 'minHeight' => 200)
                        ),
                        'uploadType' => 'image'
                    ),
                )
            )
        );
    }

    public function rules()
    {
        return array(
            array('title, alias', 'required'),
            array('view_count, is_important', 'numerical', 'integerOnly' => true),
            array('title, alias', 'length', 'max' => 255),
            array('description, meta_title', 'length', 'max' => 1000),
            array('meta_keywords, meta_description', 'length', 'max' => 3000),
            array('image, meta_image', 'length', 'max' => 300),
            array('pub_date', 'date', 'allowEmpty' => false, 'format' => 'yyyy-MM-dd hh:mm:ss'),
            array('status', 'length', 'max' => 9),
            array('content', 'safe'),

            array('pub_date, title, status, view_count, is_important', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'rUser' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->user_id = Yii::app()->user->id;
            $this->create_time = date('Y-m-d H:i:s');
        } else {
            $this->change_time = date('Y-m-d H:i:s');
        }

        if (!$this->pub_date) $this->pub_date = $this->create_time;

        return parent::beforeSave();
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'create_time' => 'Время создания',
            'change_time' => 'Время редактирования',
            'pub_date' => 'Дата публикации',
            'title' => 'Заголовок',
            'alias' => 'Alias',
            'description' => 'Описание',
            'content' => 'Содержание',
            'image' => 'Изображение',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_title' => 'Meta Title',
            'meta_image' => 'Meta Image',
            'view_count' => 'Количество просмотров',
            'is_important' => 'Важная!',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('pub_date', $this->pub_date);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('view_count', $this->view_count);
        $criteria->compare('is_important', $this->is_important);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20
            )
        ));
    }

    /**
     * @param array $years
     * @return mixed
     */
    public static function searchFrontend($years)
    {
        $criteria = new CDbCriteria;

        foreach ($years as $year => $months) {
            $counter = $criteria::$paramCount;
            $criteria->addInCondition('year(pub_date) = :year' . $counter . ' AND month(pub_date)', $months, 'OR');
            $criteria->params[':year' . $counter] = $year;
        }

        $criteria->compare('t.status', Article::STATUS_PUBLISHED);
        $criteria->order = 't.pub_date DESC';

        return $criteria;
    }

    /**
     * @return array
     */
    public static function getYearsWhitMonths()
    {
        $command = app()->db->createCommand();
        $command->select = 'DISTINCT MONTH(pub_date), YEAR(pub_date)';
        $command->where = 'status = "' . self::STATUS_PUBLISHED  . '"';
        $command->from = 'news';

        $dataReader = $command->query();
        $dataReader->bindColumn(1, $month); //- привязываем первое поле (month) к переменной $month
        $dataReader->bindColumn(2, $year); //- привязываем второе поле (year) к переменной $year

        $list = array();
        while ($dataReader->read() !== false) {
            $list[$year][$month] = app()->dateFormatter->format('LLLL', mktime(0, 0, 0, $month));
        }

        return $list;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Получить ссылку на документ
     * @return mixed
     */
    public function getUrl()
    {
        if (!$this->_url) {
            $this->setUrl();
        }
        return $this->_url;
    }

    /**
     * Установить ссылку на документ
     */
    public function setUrl()
    {
        return $this->_url = url('news/view/', array('alias' => $this->alias));
    }

    public function getAbsoluteUrl()
    {
        return $this->_absoluteUrl = $this->url ? app()->createAbsoluteUrl('/') . $this->url : '';
    }
}