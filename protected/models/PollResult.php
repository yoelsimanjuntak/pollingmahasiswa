<?php

/**
 * This is the model class for table "poll_result".
 *
 * The followings are the available columns in table 'poll_result':
 * @property integer $id
 * @property integer $poll_id
 * @property string $user_id
 * @property integer $candidate_id
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property Candidate $candidate
 * @property Polling $poll
 * @property Account $user
 */
class PollResult extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PollResult the static model class
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
		return 'poll_result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('poll_id, user_id, candidate_id', 'required'),
			array('poll_id, candidate_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, poll_id, user_id, candidate_id, timestamp', 'safe', 'on'=>'search'),
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
			'candidate' => array(self::BELONGS_TO, 'Candidate', 'candidate_id'),
			'poll' => array(self::BELONGS_TO, 'Polling', 'poll_id'),
			'user' => array(self::BELONGS_TO, 'Account', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'poll_id' => 'Poll',
			'user_id' => 'User',
			'candidate_id' => 'Candidate',
			'timestamp' => 'Timestamp',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('poll_id',$this->poll_id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('candidate_id',$this->candidate_id);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}