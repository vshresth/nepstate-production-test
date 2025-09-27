<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PayPal Pro Library for CodeIgniter 3.x
 *
 * Library for PayPal Pro payment gateway. It helps to integrate PayPal Pro payment gateway
 * in the CodeIgniter application.
 *
 * It requires PayPal configuration file and it should be placed in the config directory.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      CodexWorld
 * @license     http://www.codexworld.com/license/
 * @link        http://www.codexworld.com
 * @version     2.0
 */
class PaypalPro
{
    //Configuration Options
    var $apiUsername;
    var $apiPassword ;
    var $apiSignature;
    var $apiEndpoint;
    var $subject = '';
    var $authToken = '';
    var $authSignature = '';
    var $authTimestamp = '';
    var $useProxy = FALSE;
    var $proxyHost = '127.0.0.1';
    var $proxyPort = 808;
    var $paypalURL;
    var $version = '65.1';
    var $ackSuccess = 'SUCCESS';
    var $ackSuccessWarning = 'SUCCESSWITHWARNING';
	var $CI;
    
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->config('paypal');
		
		$sanbox = $this->CI->config->item('sandbox');
        $this->paypalURL = ($sanbox == TRUE)?'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=':'https://www.paypal.com/webscr&cmd=_express-checkout&token=';
		$this->apiEndpoint = ($sanbox == TRUE)?'https://api-3t.sandbox.paypal.com/nvp':'https://api-3t.paypal.com/nvp';
		
		$this->apiUsername = $this->CI->config->item('paypal_api_username');
		$this->apiPassword = $this->CI->config->item('paypal_api_password');
		$this->apiSignature = $this->CI->config->item('paypal_api_signature');
		
        ob_start();
        session_start();
    }
	
    public function nvpHeader(){
        $nvpHeaderStr = "";
    
        if((!empty($this->apiUsername)) && (!empty($this->apiPassword)) && (!empty($this->apiSignature)) && (!empty($subject))) {
            $authMode = "THIRDPARTY";
        }else if((!empty($this->apiUsername)) && (!empty($this->apiPassword)) && (!empty($this->apiSignature))) {
            $authMode = "3TOKEN";
        }elseif (!empty($this->authToken) && !empty($this->authSignature) && !empty($this->authTimestamp)) {
            $authMode = "PERMISSION";
        }elseif(!empty($subject)) {
            $authMode = "FIRSTPARTY";
        }
        
        switch($authMode) {
            case "3TOKEN" : 
                $nvpHeaderStr = "&PWD=".urlencode($this->apiPassword)."&USER=".urlencode($this->apiUsername)."&SIGNATURE=".urlencode($this->apiSignature);
                break;
            case "FIRSTPARTY" :
                $nvpHeaderStr = "&SUBJECT=".urlencode($this->subject);
                break;
            case "THIRDPARTY" :
                $nvpHeaderStr = "&PWD=".urlencode($this->apiPassword)."&USER=".urlencode($this->apiUsername)."&SIGNATURE=".urlencode($this->apiSignature)."&SUBJECT=".urlencode($subject);
                break;		
            case "PERMISSION" :
                $nvpHeaderStr = $this->formAutorization($this->authToken,$this->authSignature,$this->authTimestamp);
                break;
        }
        return $nvpHeaderStr;
    }
    
    /**
      * hashCall: Function to perform the API call to PayPal using API signature
      * @methodName is name of API  method.
      * @nvpStr is nvp string.
      * returns an associtive array containing the response from the server.
    */
    public function hashCall($methodName,$nvpStr){
        // form header string
        $nvpheader = $this->nvpHeader();

        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->apiEndpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
    
        //turning off the server and peer verification(TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        //in case of permission APIs send headers as HTTPheders
        if(!empty($this->authToken) && !empty($this->authSignature) && !empty($this->authTimestamp))
         {
            $headers_array[] = "X-PP-AUTHORIZATION: ".$nvpheader;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_array);
            curl_setopt($ch, CURLOPT_HEADER, false);
        }
        else 
        {
            $nvpStr = $nvpheader.$nvpStr;
        }
        //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
       //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
        if($this->useProxy)
            curl_setopt ($ch, CURLOPT_PROXY, $this->proxyHost.":".$this->proxyPort); 
    
        //check if version is included in $nvpStr else include the version.
        if(strlen(str_replace('VERSION=', '', strtoupper($nvpStr))) == strlen($nvpStr)) {
            $nvpStr = "&VERSION=" . urlencode($this->version) . $nvpStr;	
        }
        
        $nvpreq="METHOD=".urlencode($methodName).$nvpStr;
        //setting the nvpreq as POST FIELD to curl
        curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
    
        //getting response from server
        $response = curl_exec($ch);
        
        //convrting NVPResponse to an Associative Array
        $nvpResArray = $this->deformatNVP($response);
        $nvpReqArray = $this->deformatNVP($nvpreq);
        $_SESSION['nvpReqArray']=$nvpReqArray;
    
        if (curl_errno($ch)) {
            die("CURL send a error during perform operation: ".curl_error($ch));
        } else {
            //closing the curl
            curl_close($ch);
        }
    
        return $nvpResArray;
    }
    
    /** This function will take NVPString and convert it to an Associative Array and it will decode the response.
     * It is usefull to search for a particular key and displaying arrays.
     * @nvpstr is NVPString.
     * @nvpArray is Associative Array.
     */
    public function deformatNVP($nvpstr){
        $intial=0;
        $nvpArray = array();
    
        while(strlen($nvpstr)){
            //postion of Key
            $keypos = strpos($nvpstr,'=');
            //position of value
            $valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);
    
            /*getting the Key and Value values and storing in a Associative Array*/
            $keyval = substr($nvpstr,$intial,$keypos);
            $valval = substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
            //decoding the respose
            $nvpArray[urldecode($keyval)] =urldecode( $valval);
            $nvpstr = substr($nvpstr,$valuepos+1,strlen($nvpstr));
         }
        return $nvpArray;
    }
    
    public function formAutorization($auth_token,$auth_signature,$auth_timestamp){
        $authString="token=".$auth_token.",signature=".$auth_signature.",timestamp=".$auth_timestamp ;
        return $authString;
    }
    
    public function paypalCall($params){
        /*
         * Construct the request string that will be sent to PayPal.
         * The variable $nvpstr contains all the variables and is a
         * name value pair string with & as a delimiter
         */
        
        //payment details item fields
        $itemStr = !empty($params['itemName'])?'&L_NAMEn='.$params['itemName']:'';
        $itemStr .= !empty($params['itemNumber'])?'&L_NUMBERn='.$params['itemNumber']:'';
        
        //indicate a recurring transaction
		$recurringStr = (array_key_exists("recurring",$params) && $params['recurring'] == 'Y')?'&RECURRING=Y':'';
        
        $nvpstr = "&PAYMENTACTION=".$params['paymentAction']."&AMT=".$params['amount']."&CREDITCARDTYPE=".$params['creditCardType']."&ACCT=".$params['creditCardNumber']."&EXPDATE=".$params['expMonth'].$params['expYear']."&CVV2=".$params['cvv']."&FIRSTNAME=".$params['firstName']."&LASTNAME=".$params['lastName']."&CITY=".$params['city']."&ZIP=".$params['zip']."&COUNTRYCODE=".$params['countryCode']."&CURRENCYCODE=".$params['currencyCode'].$itemStr.$recurringStr;
    
        /* Make the API call to PayPal, using API signature.
           The API response is stored in an associative array called $resArray */
        $resArray = $this->hashCall("DoDirectPayment",$nvpstr);
    
        return $resArray;
    }
}
?>