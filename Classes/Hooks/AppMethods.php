<?php 

namespace PoptinLtd\PoptinSmartPopupsAndContactForms\Hooks;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use PoptinLtd\PoptinSmartPopupsAndContactForms\Controller\PostController;


class AppMethods
{
        /**
     * Adds a new menu item.
     *
     * @param Menu $menu
     * @return Menu
     */
  
    public function removeApp()
    {
        $account_id=$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
        GeneralUtility::makeInstance(ConnectionPool::class)
       ->getConnectionForTable('poptin')
       ->delete(
          'poptin',
          ['account_id' => $account_id]
        );
        
       
    }
    
    public function addApp()
    {
        $api_url="https://app.popt.in/api/marketplace/";
        $marketplace="typo3";
        $email = $GLOBALS['BE_USER']->user['email'];
	
	
        $data = "email=" . $email. "&marketplace=" . $marketplace;
        $url = $api_url."register";
        $return_data = array();
	
	
        $response=PostController::call_curl($url,$data);
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
                   
                    
                    $return_data['status'] = 1;
                    $return_data['user_id'] = $cid;
                    $return_data['message'] = "user inserted successfully";
                    
                    
        
                    
                    
                } else {
                    $return_data['status'] = 0;
                    $return_data['message'] = $result->message;
                }
               
           
             
         }
        
       
    }
}