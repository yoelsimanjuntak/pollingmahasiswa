<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionUbahPassword()
        {
            $account = Account::model()->find(array('condition'=>'username="'.Yii::app()->user->name.'"'));
            
            if(isset($_POST['newpassword']) && isset($_POST['retype']))
            { 
                if($_POST['newpassword'] === $_POST['retype'])
                {
                    $account->password = MD5($_POST['newpassword']);
                    //echo MD5($_POST['newpassword']);
                    if($account->save())
                    {
                        //echo 'masuk';
                        Yii::app()->user->setFlash('contact','Ganti password berhasil!');
                        $this->redirect(array('index'));
                    }
                        
                }
                else
                    Yii::app()->user->setFlash('error','Password yang anda masukkan tidak sama.');
            }
            
            $this->render('ubahpassword');
        }
        
        public function actionBuildAuthItems()
        {
            try
            {
                $auth = Yii::app()->authManager;
                
                // Role
                $guest_role = $auth->createRole('guest', 'polling participant');
                $admin_role = $auth->createRole('admin', 'superuser');
                
                // Operation
                $auth->createOperation('vote', 'vote in polling');
                $auth->createOperation('manage', 'managa polling');
                
                // Add Child
                $guest_role->addChild('vote');
                $admin_role->addChild('manage');
                $admin_role->addChild('vote');
                
                $auth->assign('guest', 'admin');
                
                echo('Built  successfully.  This  is  a  one-time  execution.  Please remove or comment this action.'); 
            }
            
            catch (CDbException $cdbe)
            {
                throw  new  CException('You  already  have  the  auth  items  declared. Please remove or comment this action.');
            }
        }
}