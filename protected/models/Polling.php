<?php

/**
 * This is the model class for table "polling".
 *
 * The followings are the available columns in table 'polling':
 * @property integer $poll_id
 * @property string $poll_title
 * @property string $poll_desc
 * @property integer $poll_status
 * @property integer $winner
 *
 * The followings are the available model relations:
 * @property Candidate[] $candidates
 * @property PollResult[] $pollResults
 * @property Account[] $accounts
 */
class Polling extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Polling the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'polling';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('poll_title, poll_desc, poll_status', 'required'),
			array('poll_status, winner', 'numerical', 'integerOnly'=>true),
			array('poll_title', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('poll_id, poll_title, poll_desc, poll_status, winner', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'candidates' => array(self::HAS_MANY, 'Candidate', 'poll_id'),
			'pollResults' => array(self::HAS_MANY, 'PollResult', 'poll_id'),
			'accounts' => array(self::MANY_MANY, 'Account', 'voter(poll_id, username)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'poll_id' => 'Polling ID',
			'poll_title' => 'Judul Polling',
			'poll_desc' => 'Deskripsi Polling',
			'poll_status' => 'Status',
			'winner' => 'Pemenang',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('poll_id',$this->poll_id);
		$criteria->compare('poll_title',$this->poll_title,true);
		$criteria->compare('poll_desc',$this->poll_desc,true);
		$criteria->compare('poll_status',$this->poll_status);
		$criteria->compare('winner',$this->winner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}