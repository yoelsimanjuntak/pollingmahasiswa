<?php

class CandidateController extends Controller
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
            if (!Yii::app()->user->checkAccess('vote')) { 
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
	public function actionCreate($id)
	{
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
		$model = new Candidate;
                
                $poll_id = $id;
                $model->poll_id = $poll_id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Candidate']))
		{
			$model->attributes = $_POST['Candidate'];
                        if(CUploadedFile::getInstance($model,'foto'))
                        {
                            $model->foto = CUploadedFile::getInstance($model,'foto');
                            $model->foto->saveAs(Yii::app()->basePath.'/../images/candidates/'.$model->nama.'.jpg');
                            $model->foto = $model->nama.'.jpg';
                        }
                        else
                            $model->foto = 'nofoto.jpg';
                        
			if($model->save())
                        {
                            $this->redirect(array('polling/view','id'=>$model->poll_id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Candidate']))
		{
			$model->attributes=$_POST['Candidate'];
                        if(CUploadedFile::getInstance($model,'foto'))
                        {
                            $model->foto = CUploadedFile::getInstance($model,'foto');
                            $model->foto->saveAs(Yii::app()->basePath.'/../images/candidates/'.$model->nama.'.jpg');
                            $model->foto = $model->nama.'.jpg';
                        }
                        else
                            $model->foto = 'nofoto.jpg';
                        
			if($model->save())
				$this->redirect(array('polling/view','id'=>$model->poll_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
            
		$this->loadModel($id);
                
	}
        
        public function actionRemove($id, $poll_id)
        {
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            $this->loadModel($id)->delete();
            $this->redirect(array('polling/view', 'id'=>$poll_id));
        }

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Candidate');
		$this->render('index',array('dataProvider'=>$dataProvider));
	}*/

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{
		$model=new Candidate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Candidate']))
			$model->attributes=$_GET['Candidate'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Candidate the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Candidate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Candidate $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='candidate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
