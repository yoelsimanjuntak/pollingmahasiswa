<?php

class PollingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array( 
                array('allow', // authenticated users are allowed 
                    'users' => array('@'), 
                    ),
                
                array('deny'), // unauthenticated users aredinied 
                );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
		$model = new Polling;
                $account = Account::model()->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Polling']))
		{
			$model->attributes = $_POST['Polling'];
                        $model->poll_status = 1;
			
                        if($model->save() && $account)
                        {
                            // Menambahkan semua account ke tabel peserta(voter)
                            foreach($account as $peserta)
                            {
                                $voter = new Voter;
                                $voter->poll_id = $model->poll_id;
                                $voter->username = $peserta->username;
                                $voter->status = 0;
                                
                                $voter->save();
                                if(!$voter->save())
                                    echo 'Gagal menambah peserta';
                            }
                            $this->redirect(array('view','id'=>$model->poll_id));
                        }
		}

		$this->render('create',array('model'=>$model,));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Polling']))
		{
			$model->attributes=$_POST['Polling'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->poll_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionUnchangedPassword($id)
        {
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            $model = Voter::model()->findAll(array('condition'=>'poll_id='.$id.' AND status=1'));
            foreach($model as $voter)
            {
                $account=Account::model()->find(array('condition'=>'username="'.$voter->username.'"'));
                if($account->password == MD5($account->username))
                {
                    echo $account->username.' passwordnya belum diganti. <br>';
                }
                else
                    continue;
            }
        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
                $voters = Voter::model()->findAll(array('condition'=>'poll_id='.$id));
                $pollResults = PollResult::model()->findAll(array('condition'=>'poll_id='.$id));
                $candidates = Candidate::model()->findAll(array('condition'=>'poll_id='.$id));
                
                // Hapus semua peserta polling
                foreach($voters as $voter)
                    $voter->delete();
                
                // Hapus semua pollResult
                foreach($pollResults as $pollResult)
                    $pollResult->delete();
                
                // Hapus semua kandidat
                foreach($candidates as $candidate)
                    $candidate->delete();
                
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
                
            $dataProvider = new CActiveDataProvider('Polling');
            $this->render('index',array('dataProvider'=>$dataProvider));
	}
        
        public function actionAllPolling()
        {
            if (!Yii::app()->user->checkAccess('vote')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            $dataProvider = new CActiveDataProvider('Polling');
            $this->render('allpollings',array('dataProvider'=>$dataProvider));
        }
        
        public function actionResult($id)    
        {
            if (!Yii::app()->user->checkAccess('vote')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            $poll_id = $id;
            $poll_title = Polling::model()->find(array('condition'=>'poll_id='.$id))->poll_title;
            $results = PollResult::model()->findAll(array('condition'=>'poll_id='.$id));
            $candidates = Candidate::model()->findAll(array('condition'=>'poll_id='.$id));
            $this->render('result', array('results'=>$results, 'candidates'=>$candidates, 'poll_id'=>$poll_id, 'poll_title'=>$poll_title));
        }
        
        public function actionVote($id)
        {
            if (!Yii::app()->user->checkAccess('vote')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            // PollResult object
            $pollResult = new PollResult;
            $pollResult->poll_id = $id;
            
            $candidates = Candidate::model()->findAll(array('condition'=>'poll_id='.$id));
            $voter = Voter::model()->find(array('condition'=>'poll_id='.$id.' AND username="'.Yii::app()->user->id.'"'));
            
            // Cek polling status
            if($pollResult->poll->poll_status == 0)
            {
                Yii::app()->user->setFlash('error','Maaf polling '.$pollResult->poll->poll_title.' telah ditutup.');
                $this->redirect(array('allPolling'));
            }
            
            // Cek peserta polling
            if(!$voter)
            {
                echo 'Anda tidak berhak mengikuti polling ini.';
                $this->redirect(array('site/index'));
            }
            
            if($voter->status == 1)
            {
                Yii::app()->user->setFlash('error','Maaf anda telah memilih sebelumnya dalam polling ini.');
                $this->redirect(array('allpolling'));
            }
            
            // Cek pilihan
            if(isset($_POST['kandidat']))
            {
                $pollResult->candidate_id = $_POST['kandidat'];
                $pollResult->user_id = $voter->username;
                
                if($pollResult->save())
                {
                    // Ubah status peserta polling
                    $voter->status = 1;
                    $voter->save();
                    
                    Yii::app()->user->setFlash('contact',
                            'Terima kasih telah atas partisipasinya dalam polling '.$pollResult->poll->poll_title.' :).');
                    $this->redirect(array('allpolling'));
                }
            }
            
            else if(!isset($_POST['kandidat']))
                $this->render('vote',array('pollResult'=>$pollResult,'candidates'=>$candidates));
        }
        
        public function actionUbahStatus($id)
        {
            if (!Yii::app()->user->checkAccess('vote')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            $polling = Polling::model()->find(array('condition'=>'poll_id='.$id));
            if($polling)
            {
                if($polling->poll_status == 1)
                {
                    $polling->poll_status = 0;
                    $polling->save();
                }
                else if($polling->poll_status == 0)
                {
                    $polling->poll_status = 1;
                    $polling->save();
                }
                
                $this->redirect(array('index'));
            }
        }
        
        public function actionViewGolput($id)
        {
            if (!Yii::app()->user->checkAccess('vote')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            $golput = Voter::model()->findAll(array('condition'=>'poll_id='.$id.' AND status=0'));
            $this->render('golput',array('golput'=>$golput, 'id'=>$id)); 
        }

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{
		$model=new Polling('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Polling']))
			$model->attributes=$_GET['Polling'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Polling the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Polling::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Polling $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='polling-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
