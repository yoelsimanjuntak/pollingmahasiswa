<?php

class AccountController extends Controller
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
            
		$model=new Account;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->username));
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

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->username));
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
            
		$dataProvider=new CActiveDataProvider('Account');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionBuatUser()
        {
            if (!Yii::app()->user->checkAccess('manage')) { 
                        throw new CHttpException(403,'You are not authorized to perform this action.');        
            }
            
            // Buat user D3 tingkat 3
            for($i=1; $i<=112; $i++)
            {
                if($i==2 || $i==4 || $i==6 || $i==9 || $i==11 || $i==14 || $i==17 
                         || $i==18 || $i==19 || $i==21 || $i==27 || $i==29 || $i==41 
                         || $i==45 || $i==52 || $i==56 || $i==62 || $i==64 
                         || $i==73 || $i==84 || $i==85 || $i==86 || $i==92 || $i==98
                         || $i==102 || $i==106 || $i==111)
                    continue;
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'if312'.$buntut;
                $password = 'if312'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
            
            // Buat user D4 tingkat 3
            for($i=1; $i<=33; $i++)
            {
                if($i==15 || $i==16 || $i==23)
                    continue;
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'if412'.$buntut;
                $password = 'if412'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
            
            // Buat user D3 tingkat 2
            for($i=1; $i<=109; $i++)
            {
                if($i==4 || $i==6 || $i==19 || $i==24 || $i==26 || $i==27
                         || $i==29 || $i==31 || $i==34 || $i==36 || $i==37
                         || $i==42 || $i==44 || $i==46 || $i==48 || $i==49
                         || $i==73 || $i==74 || $i==87 || $i==91 || $i==98
                         || $i==101)
                    continue;
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'if313'.$buntut;
                $password = 'if313'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
            
            // Buat user D4 tingkat 2
            for($i=1; $i<=79; $i++)
            {
                if($i==2 || $i==3 || $i==8 || $i==10 || $i==12 || $i==13 || $i==14
                         || $i==15 || $i==18 || $i==20 || $i==21 || $i==23 || $i==26
                         || $i==28 || $i==31 || $i==32 || $i==35 || $i==38 || $i==41
                         || $i==43 || $i==45 || $i==48 || $i==50 || $i==51 || $i==53
                         || $i==56 || $i==57 || $i==58 || $i==74)
                    continue;
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'if413'.$buntut;
                $password = 'if413'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
            
            
            			// Buat user D4 Teknik Informatika Tingkat 1
            for($i=1; $i<=30; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'if414'.$buntut;
                $password = 'if414'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
			
			// Buat user D3 Tingkat 1
            for($i=1; $i<=61; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'if314'.$buntut;
                $password = 'if314'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
			
			// Buat user D3 TK Tingkat 1
            for($i=1; $i<=30; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'ce314'.$buntut;
                $password = 'ce314'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
			
			// Buat user IS S1 Tingkat 1
            for($i=1; $i<=56; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'iss14'.$buntut;
                $password = 'iss14'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
			
			// Buat user Elektro S1 Tingkat 1
            for($i=1; $i<=30; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'els14'.$buntut;
                $password = 'els14'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
			
			// Buat user Bioproses S1 Tingkat 1
            for($i=1; $i<=29; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'bps14'.$buntut;
                $password = 'bps14'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
			
			// Buat user Manajemen Rekayasa S1 Tingkat 1
            for($i=1; $i<=30; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'mrs14'.$buntut;
                $password = 'mrs14'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
			
			// Buat user TI S1 Tingkat 1
            for($i=1; $i<=60; $i++)
            {
                
                // Account
                $account = new Account;
                
                // Authassignment
                $authassignment = new Authassignment;
                
                // Buntut angka
                $buntut = sprintf('%03d', $i);
                
                // Username & password
                $username = 'ifs14'.$buntut;
                $password = 'ifs14'.$buntut;
                
                // Create Account
                $account->username = $username;
                $account->password = MD5($password);
                
                // Create AuthAsssignment
                $authassignment->itemname = 'voter';
                $authassignment->userid = $username;
                
                if($account->save() && $authassignment->save())
                    echo $username.' Sukses <br>';
                
                //echo $username.'<br>';
            }
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
