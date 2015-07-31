<?php

/**
 * This is the model class for table "candidate".
 *
 * The followings are the available columns in table 'candidate':
 * @property integer $id
 * @property integer $poll_id
 * @property string $nama
 * @property string $nim
 * @property string $motivasi
 * @property string $foto
 *
 * The followings are the available model relations:
 * @property Polling $poll
 * @property PollResult[] $pollResults
 */
class Candidate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Candidate the static model class
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
		return 'candidate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('poll_id, nama, nim', 'required'),
			array('poll_id', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>64),
			array('nim', 'length', 'max'=>10),
                        array('foto', 'length', 'max'=>64),
                        //array('foto', 'file', 'allowEmpty'=>'true', 'types'=>'jpg, jpeg, gif, png'),
			array('motivasi, foto', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, poll_id, nama, nim, motivasi, foto', 'safe', 'on'=>'search'),
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
			'poll' => array(self::BELONGS_TO, 'Polling', 'poll_id'),
			'pollResults' => array(self::HAS_MANY, 'PollResult', 'candidate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'poll_id' => 'Polling ID',
			'nama' => 'Nama',
			'nim' => 'NIM',
			'motivasi' => 'Motivasi',
			'foto' => 'Foto',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('nim',$this->nim,true);
		$criteria->compare('motivasi',$this->motivasi,true);
		$criteria->compare('foto',$this->foto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}