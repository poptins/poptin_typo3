<?php
declare(strict_types = 1);

namespace PoptinLtd\PoptinSmartPopupsAndContactForms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Core\Database\ConnectionPool;





class PostController extends ActionController
{
    
    public function initializePostsAction(): void
    {
          // $this->initializeDataTables();
    }
    
    public function initializeAction(): void
    {
        $this->moduleTemplate = GeneralUtility::makeInstance(ModuleTemplate::class);
        $this->iconFactory = $this->moduleTemplate->getIconFactory();
        $this->buttonBar = $this->moduleTemplate->getDocHeaderComponent()->getButtonBar();

        /* $pageRenderer = $this->moduleTemplate->getPageRenderer(); */
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
       
        $jsFile = '../typo3conf/ext/poptin_smart_popups_and_forms/Resources/Public/JavaScript/Src/sweetalert.min.js';
        $pageRenderer->addJsFile($jsFile, 'text/javascript', true, true, '', true);
        $jsFile = '../typo3conf/ext/poptin_smart_popups_and_forms/Resources/Public/JavaScript/Src/poptincustom.js';
        $pageRenderer->addJsFile($jsFile, 'text/javascript', true, true, '', true);
        $jsFile = '../typo3conf/ext/poptin_smart_popups_and_forms/Resources/Public/JavaScript/Src/jquery-2.1.4.min.js';
        $pageRenderer->addJsFile($jsFile, 'text/javascript', true, true, '', true);

        $pageRenderer->addCssFile('../typo3conf/ext/poptin_smart_popups_and_forms/Resources/Public/Css/bootstrap.min.css', 'stylesheet', 'all', '', false);
        $pageRenderer->addCssFile('../typo3conf/ext/poptin_smart_popups_and_forms/Resources/Public/Css/poptin.css', 'stylesheet', 'all', '', false);
    }
    
   
    public function postsAction(): string
    {
       
        $current_email = $GLOBALS['BE_USER']->user['email'];
        $site_name = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
        $row = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('poptin')->select(
        ['POPTIN_USER_ID', 'POPTIN_CLIENT_ID', 'POPTIN_ACCOUNT_EMAIL'], // fields to select
        'poptin', // from
        [ 'account_id' => $site_name ] // where
    )->fetch();
        $sh_status='';
        $dash_status='';
        $with_token='show';
        $without_token='hide';
        $show_dashboard = 'hide';
        $btm_section='';
        $client_id = '';
        if(isset($row) && !empty($row)){
            if(empty($row['POPTIN_USER_ID'])){
                $without_token = 'show';
                $with_token = 'hide';
                $dash_status = 'hide';
                $show_dashboard = 'show';
                $sh_status = 'hide';
                $btm_section='show';
                $client_id = $row['POPTIN_CLIENT_ID'];
                
            }
            elseif(!empty($row['POPTIN_CLIENT_ID'])){
                $without_token = 'hide';
                $with_token = 'show';
                $dash_status = 'hide';
                $show_dashboard = 'show';
                $sh_status = 'hide';
                $btm_section='show';
                $client_id = $row['POPTIN_CLIENT_ID'];
               
                
            }
        }else{
            $sh_status = 'show';
            $btm_section='show';
            $dash_status = 'hide';
            $show_dashboard = 'hide';
        }
        
        
        return $this->render('Backend/Front.html', [
            'sh_status' => $sh_status,
            'dash_status' => $dash_status,
            'with_token' => $with_token,
            'without_token' => $without_token,
            'show_dashboard' => $show_dashboard,
            'btm_section' => $btm_section,
            'client_id' => $client_id
        ]);
    }
    
    
    
    protected function getFluidTemplateObject(string $templateNameAndPath): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths([GeneralUtility::getFileAbsFileName('EXT:poptin_smart_popups_and_forms/Resources/Private/Layouts')]);
        $view->setPartialRootPaths([GeneralUtility::getFileAbsFileName('EXT:poptin_smart_popups_and_forms/Resources/Private/Partials')]);
        $view->setTemplateRootPaths([GeneralUtility::getFileAbsFileName('EXT:poptin_smart_popups_and_forms/Resources/Private/Templates')]);
        $view->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName('EXT:poptin_smart_popups_and_forms/Resources/Private/Templates/' . $templateNameAndPath));
        $view->setControllerContext($this->getControllerContext());
        $view->getRequest()->setControllerExtensionName('Blog');

        return $view;
    }
    
    protected function render(string $templateNameAndPath, array $values): string
    {
        $view = $this->getFluidTemplateObject($templateNameAndPath);
        $view->assign('_template', $templateNameAndPath);
        $view->assign('action', $this->actionMethodName);
        $view->assignMultiple($values);
        $this->moduleTemplate->setContent($view->render());

        return $this->moduleTemplate->renderContent();
    }
    
    public function loginAction(){
        $token='';
        $cid=$_POST['userid'];
        $uid = '';
        $login_url='';
        $email='';
        $d=date('m/d/Y h:i:s a', time());
        $site_name = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
        if($cid){
            $account_id=$site_name;
            /* $sql="INSERT INTO poptin (POPTIN_USER_ID, POPTIN_CLIENT_ID,POPTIN_TOKEN,POPTIN_LOGIN_URL,POPTIN_ACCOUNT_EMAIL,POPTIN_REGISTRATION_DATE,account_id)
            VALUES ('$uid','$cid','$token','$login_url','$email','$d','$account_id')"; */
            
            GeneralUtility::makeInstance(ConnectionPool::class)
           ->getConnectionForTable('poptin')
           ->insert(
              'poptin',
              [
                 'POPTIN_USER_ID' => $uid,
                 'POPTIN_CLIENT_ID' => $cid,
                 'POPTIN_TOKEN' => $token,
                 'POPTIN_LOGIN_URL' => $login_url,
                 'POPTIN_ACCOUNT_EMAIL' => $email,
                 'POPTIN_REGISTRATION_DATE' => $d,
                 'account_id' => $account_id
                 
                 
              ]
           );
            
            $return_data['store_id'] = $account_id;
            $return_data['status'] = 1;
              
            $return_data['message'] = "user inserted successfully";
        }
        else{
            $return_data['status'] = 0;
                $return_data['message'] = "No user id";
        }
        echo json_encode($return_data);die;
    }
    
    public function registerAction(){
        $api_url="https://app.popt.in/api/marketplace/";
        $marketplace="typo3";
        $email=$_POST['email'];
	
	
        $data = "email=" . $email. "&marketplace=" . $marketplace;
        $url = $api_url."register";
        $return_data = array();
	
	
        $response=$this->call_curl($url,$data);
        $site_name = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
	
         if ($response)
         {
            
            $result = json_decode($response);
            
            
                if (isset($result->success) && ($result->success == '1')) {

                    $return_data['status'] = 1;
                    $return_data['user_id'] = $result->user_id;
                    $return_data['client_id'] = $result->client_id;
                    $return_data['token'] = $result->token;
                    $return_data['login_url'] = $result->login_url;
                    $return_data['email'] = $email;


                    include 'savedb.php';
                    $uid=$result->user_id;
                    $cid=$result->client_id;
                    $token=$result->token;
                    $login_url=$result->login_url;
                    $account_id=$site_name;
                    $d=date('m/d/Y h:i:s a', time());
                    /* $sql="INSERT INTO poptin(POPTIN_USER_ID, POPTIN_CLIENT_ID,POPTIN_TOKEN,POPTIN_LOGIN_URL,POPTIN_ACCOUNT_EMAIL,POPTIN_REGISTRATION_DATE,account_id)
                    VALUES ('$uid','$cid','$token','$login_url','$email','$d','$account_id')"; */
                    
                     GeneralUtility::makeInstance(ConnectionPool::class)
                       ->getConnectionForTable('poptin')
                       ->insert(
                          'poptin',
                          [
                             'POPTIN_USER_ID' => $uid,
                             'POPTIN_CLIENT_ID' => $cid,
                             'POPTIN_TOKEN' => $token,
                             'POPTIN_LOGIN_URL' => $login_url,
                             'POPTIN_ACCOUNT_EMAIL' => $email,
                             'POPTIN_REGISTRATION_DATE' => $d,
                             'account_id' => $account_id
                             
                             
                          ]
                       );
                        
                    
                    
                    /* mysqli_query($con, $sql);
                    $key = 'public';
                    $accessToken = getToken($account_id);
                    $url = "https://app.ecwid.com/api/v3/".$account_id."/storage/".$key."?token=".$accessToken;
                    AddStorage($url,$cid); */
                    
                    $return_data['status'] = 1;
                    $return_data['user_id'] = $cid;
                    $return_data['message'] = "user inserted successfully";
                    
                    
        
                    
                    
                } else {
                    $return_data['status'] = 0;
                    $return_data['message'] = $result->message;
                }
                echo json_encode($return_data);
                die();
           
             
         }
    }
    
    public function call_curl($url,$data){
		$curl = curl_init();
		curl_setopt_array($curl, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "POST", CURLOPT_POSTFIELDS => $data, CURLOPT_HTTPHEADER => array("cache-control: no-cache", "content-type: application/x-www-form-urlencoded", "postman-token: 16ba048a-499c-06c8-517c-cea2abb11945")));
		$response = curl_exec($curl);
		
		
		$err = curl_error($curl);
		curl_close($curl);
		
		if ($err) {
			echo "cURL Error #:" . $err;
			die;
		 }
		 else{
			 return $response;
		 }
	}
    
    public function updateTokenAction(){
        $api_url="https://app.popt.in/api/marketplace/";

        $account_id=$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
        $permission_msg="you don't have permission to access.";
         $row = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('poptin')->select(
            ['POPTIN_USER_ID', 'POPTIN_CLIENT_ID', 'POPTIN_ACCOUNT_EMAIL','POPTIN_TOKEN'], // fields to select
            'poptin', // from
            [ 'account_id' => $account_id ] // where
        )->fetch();
       
        if(isset($row) && !empty($row)){
            $POPTIN_USER_ID = $row['POPTIN_USER_ID'];
            $POPTIN_TOKEN = $row['POPTIN_TOKEN'];
        }
       
         if (empty($POPTIN_USER_ID)) {
            die($permission_msg);
        } 
        
        $url = $api_url."auth";
        $data = "token=" . $POPTIN_TOKEN . "&user_id=" . $POPTIN_USER_ID; 
        $response=$this->call_curl($url,$data);
        
         $result = json_decode($response);
       
         
         if (isset($result->success) && ($result->success == true)) {
            
            $return_data['status'] = 1;
            $return_data['token'] = $result->token;
            $return_data['login_url'] = $result->login_url;
        
           

            GeneralUtility::makeInstance(ConnectionPool::class)
           ->getConnectionForTable('poptin')
           ->update(
              'poptin',
              ['POPTIN_TOKEN' => $result->token,'POPTIN_LOGIN_URL' => $result->login_url],
              ['account_id' => $account_id]
           );
            
            $final_url=$result->login_url."&utm_source=typo3";
            
            header('Location:'.$final_url);
            exit(); 
        } else {
            $return_data['status'] = 0;
            $return_data['message'] = $result->message;
            echo json_encode($return_data);
            die;
        }
    }
    
    public function logoutAction(){
        $u_id=$_POST['user_id'];
        $return_data=array();
        
        $account_id=$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
        if(GeneralUtility::makeInstance(ConnectionPool::class)
       ->getConnectionForTable('poptin')
       ->delete(
          'poptin',
          ['POPTIN_CLIENT_ID' => $u_id,'account_id' => $account_id]
        )){
            $return_data['status'] = 1;
            $return_data['message'] = "User deleted successfully";
        }else{
            $return_data['status'] = 0;
            $return_data['message'] = "User Not found";
        }
     
        echo json_encode($return_data);
        die;
    }
   
    
}