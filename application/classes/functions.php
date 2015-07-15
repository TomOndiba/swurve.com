<?php defined('SYSPATH') or die('No direct script access.');

class Functions
{
		public static function rand_numbers($from, $to, $count)
		{
			$numbers = array();

			for($i = 0; $i < $count; $i++)
			{
				do {
					$num = rand($from, $to);
				} while (in_array($num, $numbers));

				$numbers[] = $num;
			}

			return implode(',', $numbers);
		}

    public static function daily_limit()
    {
        return 4;
    }

    public static function calc_hours($minutes)
    {
    	//if ($minutes == '0')
    	//{
    		//return '0m';
    	//}

    	$hours = floor($minutes / 60);
    	$minutes = $minutes % 60;

    	if ($hours > 0)
    	{
    		return $hours.'h'.$minutes.'m';
    	}
    	else
    	{
    		return $minutes.'m';
    	}
    }

    public static function testlist()
    {
        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);
        $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));
        $filter = new SuppressionFilter();
        //$filter->

        $list = new ListRequest();

        $list->filter = $filter;

        $response = new ListResponse();

        $response = $service->_list($list);

        $suppressionlistid = new SuppressionListId();

        $suppressionlistid = $response->objectId;

        $supplistid = new ExportSuppressionListRecordsRequest();

        $supplistid->suppressionListId = $suppressionlistid[0];

        //print_r($supplistid);
        //$request3 = new ExportRecordsRequest();
        //$request3->
         //exit();
        $response = new ExportRecordsResponse();
        $response = $service->exportRecords($supplistid);

        print_r($response);
    }

    public static function send_activation($to)
    {
        if ($to->mailstatus > 0)
        {
            return;
        }

        file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'ACTIVATION - ' . date('H:i:s') . "\n", FILE_APPEND);

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);
        $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));

        $txn = new GetTxnMailingHandleRequest();
        $txnid = new TransactionalMailingId();
        $txnid->id = '2172601';
        $txn->mailingId = $txnid;

        $handle = null;

        for ($retries = 0; !$handle and $retries < 3; $retries++) {
            try {
                $handle = $service->getTxnMailingHandle($txn);
            }
            catch(Exception $e)
            {
                //echo "retries number:".$retries."<br>";
                if ($retries < 2) {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'ACTIVATION - ' . date('H:i:s') . ' - Failed Retrying (' . $retries . ') - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    sleep(1);
                } else {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'ACTIVATION - ' . date('H:i:s') . ' - Max Retries Reached (' . $retries . ') SKIPPING - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    //echo "MESSAGE: " .$e->getMessage();
                }
            }
        }

        if ($handle) {
            $sq = new TxnSendRequest();
            $sq->handle = $handle->handle;

            $record = new SendRecord();

            $idCol = new NameValuePair();
            $idCol->name = "id";
            $idCol->value = $to->id;
            $record->field[] = $idCol;

            $emailCol = new NameValuePair();
            $emailCol->name = "email_address";
            $emailCol->value = $to->email;
            $record->field[] = $emailCol;

            $nameCol = new NameValuePair();
            $nameCol->name = "username";
            $nameCol->value = strtolower($to->username);
            $record->field[] = $nameCol;

            $passCol = new NameValuePair();
            $passCol->name = "password";
            $passCol->value = $to->password;
            $record->field[] = $passCol;

            $sdateCol = new NameValuePair();
            $sdateCol->name = "signup_date";
            $sdateCol->value = date('m/d/Y', $to->signup_date);
            $record->field[] = $sdateCol;

            $ipCol = new NameValuePair();
            $ipCol->name = "ip_address";
            $ipCol->value = $to->signup_ip;
            $record->field[] = $ipCol;

            $sq->sendRecord = $record;

            $results = $service->txnSend($sq);

            //sleep(1);
        }
    }

    public static function send_rdpromo($to)
    {
        if ($to->mailstatus > 0)
        {
            return;
        }

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);
        $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));

        $txn = new GetTxnMailingHandleRequest();
        $txnid = new TransactionalMailingId();
        $txnid->id = '1083398';
        $txn->mailingId = $txnid;

        $handle = $service->getTxnMailingHandle($txn);

        $sq = new TxnSendRequest();
        $sq->handle = $handle->handle;

        $record = new SendRecord();

        $idCol = new NameValuePair();
        $idCol->name = "id";
        $idCol->value = $to->id;
        $record->field[] = $idCol;

        $emailCol = new NameValuePair();
        $emailCol->name = "email_address";
        $emailCol->value = $to->email;
        $record->field[] = $emailCol;

        $nameCol = new NameValuePair();
        $nameCol->name = "username";
        $nameCol->value = strtolower($to->username);
        $record->field[] = $nameCol;

        $passCol = new NameValuePair();
        $passCol->name = "password";
        $passCol->value = $to->password;
        $record->field[] = $passCol;

        $sdateCol = new NameValuePair();
        $sdateCol->name = "signup_date";
        $sdateCol->value = date('m/d/Y', $to->signup_date);
        $record->field[] = $sdateCol;

        $ipCol = new NameValuePair();
        $ipCol->name = "ip_address";
        $ipCol->value = $to->signup_ip;
        $record->field[] = $ipCol;

        $sq->sendRecord = $record;

        $results = $service->txnSend($sq);
    }

    public static function send_email($to, $from)
    {
        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > Functions::daily_limit() OR $to->membership_id == 1)
        {
            return;
        }

        file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'EMAIL - ' . date('H:i:s') . "\n", FILE_APPEND);

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);  $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));

        $txn = new GetTxnMailingHandleRequest();
        $txnid = new TransactionalMailingId();
        $txnid->id = '2172697';
        $txn->mailingId = $txnid;

        $handle = null;

        for ($retries = 0; !$handle and $retries < 3; $retries++) {
            try {
                $handle = $service->getTxnMailingHandle($txn);
            }
            catch(Exception $e)
            {
                //echo "retries number:".$retries."<br>";
                if ($retries < 2) {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'EMAIL - ' . date('H:i:s') . ' - Failed Retrying (' . $retries . ') - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    sleep(1);
                } else {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'EMAIL - ' . date('H:i:s') . ' - Max Retries Reached (' . $retries . ') SKIPPING - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    //echo "MESSAGE: " .$e->getMessage();
                }
            }
        }

        if ($handle) {
            $sq = new TxnSendRequest();
            $sq->handle = $handle->handle;

            $record = new SendRecord();

            $idCol = new NameValuePair();
            $idCol->name = "id";
            $idCol->value = $to->id;
            $record->field[] = $idCol;

            $emailCol = new NameValuePair();
            $emailCol->name = "email_address";
            $emailCol->value = $to->email;
            $record->field[] = $emailCol;

            $nameCol = new NameValuePair();
            $nameCol->name = "username";
            $nameCol->value = strtolower($to->username);
            $record->field[] = $nameCol;

            $passCol = new NameValuePair();
            $passCol->name = "password";
            $passCol->value = $to->password;
            $record->field[] = $passCol;

            $sdateCol = new NameValuePair();
            $sdateCol->name = "signup_date";
            $sdateCol->value = date('m/d/Y', $to->signup_date);
            $record->field[] = $sdateCol;

            $ipCol = new NameValuePair();
            $ipCol->name = "ip_address";
            $ipCol->value = $to->signup_ip;
            $record->field[] = $ipCol;

            $fuserCol = new NameValuePair();
            $fuserCol->name = "from_username";
            $fuserCol->value = $from->username;
            $record->field[] = $fuserCol;

            $favatarCol = new NameValuePair();
            $favatarCol->name = "from_avatar";
            $favatarCol->value = URL::base(FALSE, 'http') . Content::factory($from->username)->get_photo($from->avatar, 'm');
            $record->field[] = $favatarCol;

            $sq->sendRecord = $record;

            $results = $service->txnSend($sq);

            //sleep(1);
        }
    }

    public static function send_fave($to, $from)
    {
        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > Functions::daily_limit() OR $to->membership_id == 1)
        {
            return;
        }

        file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'FAV - ' . date('H:i:s') . "\n", FILE_APPEND);

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);  $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));

        $txn = new GetTxnMailingHandleRequest();
        $txnid = new TransactionalMailingId();
        $txnid->id = '2172301';
        $txn->mailingId = $txnid;

        $handle = null;

        for ($retries = 0; !$handle and $retries < 3; $retries++) {
            try {
                $handle = $service->getTxnMailingHandle($txn);
            }
            catch(Exception $e)
            {
                //echo "retries number:".$retries."<br>";
                if ($retries < 2) {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'FAV - ' . date('H:i:s') . ' - Failed Retrying (' . $retries . ') - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    sleep(1);
                } else {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'FAV - ' . date('H:i:s') . ' - Max Retries Reached (' . $retries . ') SKIPPING - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    //echo "MESSAGE: " .$e->getMessage();
                }
            }
        }

        if ($handle) {
            $sq = new TxnSendRequest();
            $sq->handle = $handle->handle;

            $record = new SendRecord();

            $idCol = new NameValuePair();
            $idCol->name = "id";
            $idCol->value = $to->id;
            $record->field[] = $idCol;

            $emailCol = new NameValuePair();
            $emailCol->name = "email_address";
            $emailCol->value = $to->email;
            $record->field[] = $emailCol;

            $nameCol = new NameValuePair();
            $nameCol->name = "username";
            $nameCol->value = strtolower($to->username);
            $record->field[] = $nameCol;

            $passCol = new NameValuePair();
            $passCol->name = "password";
            $passCol->value = $to->password;
            $record->field[] = $passCol;

            $sdateCol = new NameValuePair();
            $sdateCol->name = "signup_date";
            $sdateCol->value = date('m/d/Y', $to->signup_date);
            $record->field[] = $sdateCol;

            $ipCol = new NameValuePair();
            $ipCol->name = "ip_address";
            $ipCol->value = $to->signup_ip;
            $record->field[] = $ipCol;

            $fuserCol = new NameValuePair();
            $fuserCol->name = "from_username";
            $fuserCol->value = $from->username;
            $record->field[] = $fuserCol;

            $favatarCol = new NameValuePair();
            $favatarCol->name = "from_avatar";
            $favatarCol->value = URL::base(FALSE, 'http') . Content::factory($from->username)->get_photo($from->avatar, 'm');
            $record->field[] = $favatarCol;

            $sq->sendRecord = $record;

            $results = $service->txnSend($sq);

            //sleep(1);
        }
    }

    public static function send_flirt($to, $from)
    {
        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > Functions::daily_limit() OR $to->membership_id == 1)
        {
            return;
        }

        file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'FLIRT - ' . date('H:i:s') . "\n", FILE_APPEND);

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);  $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));

        $txn = new GetTxnMailingHandleRequest();
        $txnid = new TransactionalMailingId();
        $txnid->id = '1048504';
        $txn->mailingId = $txnid;

        $handle = null;

        for ($retries = 0; !$handle and $retries < 3; $retries++) {
            try {
                $handle = $service->getTxnMailingHandle($txn);
            }
            catch(Exception $e)
            {
                //echo "retries number:".$retries."<br>";
                if ($retries < 2) {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'FLIRT - ' . date('H:i:s') . ' - Failed Retrying (' . $retries . ') - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    sleep(1);
                } else {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'FLIRT - ' . date('H:i:s') . ' - Max Retries Reached (' . $retries . ') SKIPPING - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    //echo "MESSAGE: " .$e->getMessage();
                }
            }
        }

        if ($handle) {
            $sq = new TxnSendRequest();
            $sq->handle = $handle->handle;

            $record = new SendRecord();

            $idCol = new NameValuePair();
            $idCol->name = "id";
            $idCol->value = $to->id;
            $record->field[] = $idCol;

            $emailCol = new NameValuePair();
            $emailCol->name = "email_address";
            $emailCol->value = $to->email;
            $record->field[] = $emailCol;

            $nameCol = new NameValuePair();
            $nameCol->name = "username";
            $nameCol->value = strtolower($to->username);
            $record->field[] = $nameCol;

            $passCol = new NameValuePair();
            $passCol->name = "password";
            $passCol->value = $to->password;
            $record->field[] = $passCol;

            $sdateCol = new NameValuePair();
            $sdateCol->name = "signup_date";
            $sdateCol->value = date('m/d/Y', $to->signup_date);
            $record->field[] = $sdateCol;

            $ipCol = new NameValuePair();
            $ipCol->name = "ip_address";
            $ipCol->value = $to->signup_ip;
            $record->field[] = $ipCol;

            $fuserCol = new NameValuePair();
            $fuserCol->name = "from_username";
            $fuserCol->value = $from->username;
            $record->field[] = $fuserCol;

            $favatarCol = new NameValuePair();
            $favatarCol->name = "from_avatar";
            $favatarCol->value = URL::base(FALSE, 'http') . Content::factory($from->username)->get_photo($from->avatar, 'm');
            $record->field[] = $favatarCol;

            $sq->sendRecord = $record;

            $results = $service->txnSend($sq);

            //sleep(1);
        }
    }

    public static function send_match($to, $from)
    {
        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > Functions::daily_limit() OR $to->membership_id == 1)
        {
            return;
        }

        file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'MATCH - ' . date('H:i:s') . "\n", FILE_APPEND);

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);  $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));

        $txn = new GetTxnMailingHandleRequest();
        $txnid = new TransactionalMailingId();
        $txnid->id = '2172603';
        $txn->mailingId = $txnid;

        $handle = null;

        for ($retries = 0; !$handle and $retries < 3; $retries++) {
            try {
                $handle = $service->getTxnMailingHandle($txn);
            }
            catch(Exception $e)
            {
                //echo "retries number:".$retries."<br>";
                if ($retries < 2) {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'MATCH - ' . date('H:i:s') . ' - Failed Retrying (' . $retries . ') - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    sleep(1);
                } else {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'MATCH - ' . date('H:i:s') . ' - Max Retries Reached (' . $retries . ') SKIPPING - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    //echo "MESSAGE: " .$e->getMessage();
                }
            }
        }

        if ($handle) {
            $sq = new TxnSendRequest();
            $sq->handle = $handle->handle;

            $record = new SendRecord();

            $idCol = new NameValuePair();
            $idCol->name = "id";
            $idCol->value = $to->id;
            $record->field[] = $idCol;

            $emailCol = new NameValuePair();
            $emailCol->name = "email_address";
            $emailCol->value = $to->email;
            $record->field[] = $emailCol;

            $nameCol = new NameValuePair();
            $nameCol->name = "username";
            $nameCol->value = strtolower($to->username);
            $record->field[] = $nameCol;

            $passCol = new NameValuePair();
            $passCol->name = "password";
            $passCol->value = $to->password;
            $record->field[] = $passCol;

            $sdateCol = new NameValuePair();
            $sdateCol->name = "signup_date";
            $sdateCol->value = date('m/d/Y', $to->signup_date);
            $record->field[] = $sdateCol;

            $ipCol = new NameValuePair();
            $ipCol->name = "ip_address";
            $ipCol->value = $to->signup_ip;
            $record->field[] = $ipCol;

            $fuserCol = new NameValuePair();
            $fuserCol->name = "from_username";
            $fuserCol->value = $from->username;
            $record->field[] = $fuserCol;

            $favatarCol = new NameValuePair();
            $favatarCol->name = "from_avatar";
            $favatarCol->value = URL::base(FALSE, 'http') . Content::factory($from->username)->get_photo($from->avatar, 'm');
            $record->field[] = $favatarCol;

            $sq->sendRecord = $record;

            $results = $service->txnSend($sq);

            //sleep(1);
        }
    }

    public static function send_request($to, $from)
    {
        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > Functions::daily_limit() OR $to->membership_id == 1)
        {
            return;
        }

        file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'REQUEST - ' . date('H:i:s') . "\n", FILE_APPEND);

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">L0otCrat377!</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken
        xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);  $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));

        $txn = new GetTxnMailingHandleRequest();
        $txnid = new TransactionalMailingId();
        $txnid->id = '2172602';
        $txn->mailingId = $txnid;

        $handle = null;

        for ($retries = 0; !$handle and $retries < 3; $retries++) {
            try {
                $handle = $service->getTxnMailingHandle($txn);
            }
            catch(Exception $e)
            {
                //echo "retries number:".$retries."<br>";
                if ($retries < 2) {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'REQUEST - ' . date('H:i:s') . ' - Failed Retrying (' . $retries . ') - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    sleep(1);
                } else {
                    file_put_contents('/var/www/html/application/logs/' . date('Y-m-d') . '.log', 'REQUEST - ' . date('H:i:s') . ' - Max Retries Reached (' . $retries . ') SKIPPING - Err: ' . $e->getMessage() . "\n", FILE_APPEND);
                    //echo "MESSAGE: " .$e->getMessage();
                }
            }
        }

        if ($handle) {
            $sq = new TxnSendRequest();
            $sq->handle = $handle->handle;

            $record = new SendRecord();

            $idCol = new NameValuePair();
            $idCol->name = "id";
            $idCol->value = $to->id;
            $record->field[] = $idCol;

            $emailCol = new NameValuePair();
            $emailCol->name = "email_address";
            $emailCol->value = $to->email;
            $record->field[] = $emailCol;

            $nameCol = new NameValuePair();
            $nameCol->name = "username";
            $nameCol->value = strtolower($to->username);
            $record->field[] = $nameCol;

            $passCol = new NameValuePair();
            $passCol->name = "password";
            $passCol->value = $to->password;
            $record->field[] = $passCol;

            $sdateCol = new NameValuePair();
            $sdateCol->name = "signup_date";
            $sdateCol->value = date('m/d/Y', $to->signup_date);
            $record->field[] = $sdateCol;

            $ipCol = new NameValuePair();
            $ipCol->name = "ip_address";
            $ipCol->value = $to->signup_ip;
            $record->field[] = $ipCol;

            $fuserCol = new NameValuePair();
            $fuserCol->name = "from_username";
            $fuserCol->value = $from->username;
            $record->field[] = $fuserCol;

            $favatarCol = new NameValuePair();
            $favatarCol->name = "from_avatar";
            $favatarCol->value = URL::base(FALSE, 'http') . Content::factory($from->username)->get_photo($from->avatar, 'm');
            $record->field[] = $favatarCol;

            $sq->sendRecord = $record;

            $results = $service->txnSend($sq);

            //sleep(1);
        }
    }

     public static function array_implode2($arrays, &$target = array()) {
        foreach ($arrays as $key => $value) {
            if (is_array($value)) {
                Functions::array_implode($value, $target);
            } else {
                $target[] = $value;
            }
        }
        return $target;
    }

    public static function array_implode($glue, $keyname, $pieces)
    {
        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($pieces));
        $arr = array();

        foreach($it AS $element) {
            if ($it->key() == $keyname) {
                $arr[] = $it->current();
            }
        }

        return implode($glue, $arr);
    }

    public static function get_age($birth)
    {
        $t = time();
        $age = date('Y', $t) - date('Y', $birth);

        if (date('z', $t) < date('z', $birth))
        {
            $age--;
        }

        return $age;
    }

    public static function get_months()
    {
        for($i = 1; $i <= 12; $i++)
        {
            $months[$i] = $i;
        }

        $months = array('' => 'Month') + $months;

        return $months;
    }

    public static function get_days()
    {

        for($i = 1; $i <= 31; $i++)
        {
            $days[$i] = $i;
        }

        $days = array('' => 'Day') + $days;

        return $days;
    }

    public static function get_years()
    {
        for($i = date('Y') - 18; $i >= date('Y') - 118; $i--)
        {
            $years[$i] = $i;
        }

        $years = array('' => 'Year') + $years;

        return $years;
    }

    public static function get_height($height)
    {
        if (empty($height) OR $height == 0)
        {
            return '0"0\'';
        }
        else
        {
            return floor($height / 12) . '"' . $height % 12 . '\'';
        }
    }

    public static function ImplodeToEnglish ($array) {
        if (!$array OR ! count($array))
            return '';

        $last = array_pop($array);

        if ( ! count($array))
            return $last;

        return implode (', ', $array) . ' and ' . $last;
    }

    public static function isnull($data, $default = '&nbsp;')
    {
        if ( ! isset($data) OR empty($data))
        {
            return $default;
        }
        else
        {
            return $data;
        }
    }

    public static function template_replace($data, $from, $to)
    {
        $find = array('|to|');
        $replace = array($to->username);

        $columns = $from->list_columns();

        foreach($columns as $column => $cdata)
        {
            switch($column)
            {
                case 'username':
                    array_push($find, '|from|');
                    array_push($replace, $from->$column);
                    break;

                case 'birthdate':
                    array_push($find, '|age|');
                    array_push($replace, Functions::get_age($from->$column));
                    break;

                case 'city_id':
                    array_push($find, '|city|');
                    array_push($replace, $from->city->full_name);
                    break;

                case 'region_id':
                    array_push($find, '|region|');
                    array_push($replace, $from->region->name);
                    break;

                default:
                    array_push($find, '|' . $column . '|');
                    array_push($replace, $from->$column);
                    break;
            }
        }

        array_push($find, '|interests|');
        array_push($replace, Functions::ImplodeToEnglish($from->relationship_types->find_all()->as_array('type', 'type')));

        $data = str_replace($find, $replace, $data);

        return $data;
    }

    public static function check_loggedin($redirect = TRUE, $checkadmin = FALSE)
    {
        if ( ! Core::$user)
        {
            if ($redirect)
            {
                Notify::set('info', 'Please login to access this page');

                $lang = NULL;
                $uri = Request::instance()->uri;

                if (strpos($uri, '://') === FALSE && $uri[0] !== '#' && I18n::$lang != 'en-us')
                {
                    $lang = substr(I18n::$lang, 0, 2);
                }

                Request::instance()->redirect($lang . '/user/login/' . $uri);
            }

            return FALSE;
        }

        if ($checkadmin == TRUE AND Core::$user->membership->type != 'Admin')
        {
            Notify::set('fail', 'You do not have permission to access this page');

            Request::instance()->redirect('/home');
        }

        return TRUE;
    }

    public static function check_paidmember($redirect = TRUE)
    {
        if ( ! Core::$user OR ! Core::$user->membership->paid)
        {
            if ($redirect)
            {
                Notify::set('info', 'You must ' . HTML::anchor('user/upgrade', 'upgrade') . ' to a paid membership to access this page.');

                Request::instance()->redirect(Request::$referrer);
            }

            return FALSE;
        }

        return TRUE;
    }

    public static function check_maildailylimit($redirect = TRUE)
    {
        if ( ! Core::$user OR ! Core::$user->membership->paid OR (ORM::factory('message', Core::$user)->where('from_id', '=', Core::$user)->where('message_type_id', '=', ORM::factory('message_type', array('type' => 'Mail')))->where('date_sent', '>=', strtotime('est today'))->where('date_sent', '<=', strtotime('now'))->find_all()->count() >= 25 AND Core::$user->membership->type == 'Silver' AND Core::$user->membership->id != 10 AND Core::$user->membership->id != 17))
        {
            if ($redirect)
            {
                Notify::set('info', 'You have exceeded the 25 messages daily limit for Silver members.<br />Please ' . HTML::anchor('user/upgrade', 'Upgrade') . ' to a higher membership level to send more.');

                Request::instance()->redirect('/');
            }

            return TRUE;
        }

        if ( ! Core::$user OR ! Core::$user->membership->paid OR (ORM::factory('message', Core::$user)->where('from_id', '=', Core::$user)->where('message_type_id', '=', ORM::factory('message_type', array('type' => 'Mail')))->where('date_sent', '>=', strtotime('est today'))->where('date_sent', '<=', strtotime('now'))->find_all()->count() >= 50 AND Core::$user->membership->type == 'Gold' AND Core::$user->membership->id != 11))
        {
            if ($redirect)
            {
                Notify::set('info', 'You have exceeded the 50 messages daily limit for Gold members.<br />Please ' . HTML::anchor('user/upgrade', 'Upgrade') . ' to a higher membership level to send more.');

                Request::instance()->redirect('/');
            }

            return TRUE;
        }

        return FALSE;
    }

    public static function RelativeTime($timestamp){
        $difference = time() - $timestamp;
        $periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");

        if ($difference > 0) { // this was in the past
            $ending = "ago";
        } else { // this was in the future
            $difference = -$difference;
            $ending = "to go";
        }

        for($j = 0; $difference >= $lengths[$j]; $j++)
            $difference /= $lengths[$j];

        $difference = round($difference);

        if ($difference != 1)
            $periods[$j].= "s";

        if ($j < 3)
        {
            if ($j == 0 AND $difference == 0)
            {
                $text = 'Now';
            }
            else
            {
                $text = "$difference $periods[$j] $ending";
            }
        }
        elseif ($j == 3 AND $difference == 1)
        {
            $text = 'Yesterday @ ' . date('g:i A'. $timestamp);
        }
        else
        {
            $text = date('M j', $timestamp) . ' @ ' . date('g:i A', $timestamp);
        }


        return $text;
    }

    public static function calculateHowLong($date) {
    // start by converting to unix time
    $when = $date;
    $isPast = ($when < time());

    $how_long = abs(time() - $when);
    if ($how_long < 60) {
    $return = "{$how_long} seconds";
    if ($isPast) $return .= " ago"; else $return = "In {$return}";

    } elseif ($how_long < 60 * 60) {
    $return = (int) ($how_long / 60) . " minutes";
    if ($isPast) $return .= " ago"; else $return = "In {$return}";

    } elseif ($how_long < 60 * 60 * 24) {
    $return = (int) ($how_long / (60 * 60)) . " hours";
    if ($isPast) $return .= " ago"; else $return = "In {$return}";

    } elseif ($how_long < 60 * 60 * 24 * 2) {
    if ($isPast) $return = "Yesterday"; else $return = "Tomorrow";

    } elseif ($how_long < 60 * 60 * 24 * 7) {
    $return = (int) ($how_long / (60 * 60 * 24)) . " days";
    if ($isPast) $return .= " ago"; else $return = "In {$return}";

    } elseif ($how_long < 60 * 60 * 24 * 13) {
    if ($isPast) $return = "Last week"; else $return = "Next week";

    } elseif ($how_long < 60 * 60 * 24 * 7 * 4) {
    $return = (int) ($how_long / (60 * 60 * 24 * 7)) . " weeks";
    if ($isPast) $return .= " ago"; else $return = "In {$return}";

    } elseif ($how_long < 60 * 60 * 24 * 30 * 2) {
    if ($isPast) $return = "Last month"; else $return = "Next month";

    } elseif ($how_long < 60 * 60 * 24 * 30 * 12) {
    $return = (int) ($how_long / (60 * 60 * 24 * 30)) . " months";
    if ($isPast) $return .= " ago"; else $return = "In {$return}";

    } else {
    if ($isPast) $return = "More than 1 year ago"; else $return = "In more than 1 year";
    }

    return $return;
    }

    public static function createDateRangeArray($start, $end) {
        $range = array();

        if ( ! is_numeric($start)) $start = strtotime($start);
        if ( ! is_numeric($end)) $end = strtotime($end);

        if ($start > $end) return Functions::createDateRangeArray($end, $start);

        do {
            $range[date('Y-m-d', $start)] = 0;
            $start = strtotime("+ 1 day", $start);
        }
        while($start <= $end);

        return $range;
    }

    public static function array_search_key($needle_key, $array) {
        $count = 0;

        foreach ($array AS $key => $value){
            $count++;

            if ($key == $needle_key)
            {
                return $count;
            }

            if (is_array($value))
            {
                if (($result = Functions::array_search_key($needle_key, $value)) !== false)
                {
                    return $count;
                }
            }
        }

        return false;
    }

    public static function calc_pps_flatrate_commission($data, $program, $today = TRUE)
    {
        if ($today)
        {
            $average_range = array_slice($data, 0, Functions::array_search_key(date('Y-m-d'), $data));
        }
        else
        {
            $average_range = $data;
        }

        switch($program)
        {
            case 'PPS45':
                return array_sum($average_range) * 45;
                break;

            case 'PPS50':
                return array_sum($average_range) * 50;
                break;

            case 'PPS55':
                return array_sum($average_range) * 55;
                break;

            case 'PPS60':
                return array_sum($average_range) * 60;
                break;

            case 'PPS100':
                return array_sum($average_range) * 100;
                break;
        }
    }

    public static function calc_pps_commission($data, $today = TRUE)
    {
        if ($today)
        {
            $average_range = array_slice($data, 0, Functions::array_search_key(date('Y-m-d'), $data));
        }
        else
        {
            $average_range = $data;
        }

        $average = ceil(array_sum($average_range) / count($average_range));

        if ($average <= 9)
        {
                return array_sum($average_range) * 35;
        }
        elseif ($average >= 10 and $average <= 24)
        {
                return array_sum($average_range) * 45;
        }
        elseif ($average >= 25)
        {
                return array_sum($average_range) * 55;
        }
    }

    public static function calc_revshare_flatrate_commission($memberships, $rebillingamount, $membershipamount, $program, $today = TRUE)
    {
        if ($today)
        {
            $average_range_memberships = array_slice($memberships, 0, Functions::array_search_key(date('Y-m-d'), $memberships));
            $average_range_rebillingamount = array_slice($rebillingamount, 0, Functions::array_search_key(date('Y-m-d'), $rebillingamount));
            $average_range_membershipamount = array_slice($membershipamount, 0, Functions::array_search_key(date('Y-m-d'), $membershipamount));
        }
        else
        {
            $average_range_memberships = $memberships;
            $average_range_rebillingamount = $rebillingamount;
            $average_range_membershipamount = $membershipamount;
        }

        $average = ceil(array_sum($average_range_memberships) / count($average_range_memberships));

        switch($program)
        {
            case 'Revshare75':
                return (array_sum($average_range_rebillingamount) * .75) + (array_sum($average_range_membershipamount) * .75);
                break;
        }
    }

    public static function calc_revshare_commission($memberships, $rebillingamount, $membershipamount, $today = TRUE)
    {
        if ($today)
        {
            $average_range_memberships = array_slice($memberships, 0, Functions::array_search_key(date('Y-m-d'), $memberships));
            $average_range_rebillingamount = array_slice($rebillingamount, 0, Functions::array_search_key(date('Y-m-d'), $rebillingamount));
            $average_range_membershipamount = array_slice($membershipamount, 0, Functions::array_search_key(date('Y-m-d'), $membershipamount));
        }
        else
        {
            $average_range_memberships = $memberships;
            $average_range_rebillingamount = $rebillingamount;
            $average_range_membershipamount = $membershipamount;
        }

        //print_r($average_range_membershipamount);

        $average = ceil(array_sum($average_range_memberships) / count($average_range_memberships));

        if ($average <= 9)
        {
            return (array_sum($average_range_rebillingamount) * .50) + (array_sum($average_range_membershipamount) * .50);
        }
        elseif ($average >= 10 and $average <= 24)
        {
            return (array_sum($average_range_rebillingamount) * .60) + (array_sum($average_range_membershipamount) * .60);
        }
        elseif ($average >= 25)
        {
            return (array_sum($average_range_rebillingamount) * .75) + (array_sum($average_range_membershipamount) * .75);
        }
    }

    public static function affiliate_landings()
    {
        return array(
            0 => array('Default Home Page' => URL::site('/', 'http')),
            1 => array('Registration Page' => URL::site('user/register', 'https')),
            2 => array('Home Page 2' => URL::site('2', 'http')),

            50 => array('Default Home Page' => 'http://www.kruze.com/'),

            60 => array('Default Home Page' => 'http://www.russiandesire.com/'),

            99 => array('Random Landing Page' => URL::site('rnd', 'http'))
        );
    }

    public static function random_seeking_type()
    {
        $types = array('Anyone for Anything', 'Cyber Flirting', 'Discreet Encounters', 'Fantasy Fullfillment', 'Friends with Benefits',' Full Time Lover', 'Group Fun', 'Sex on the Side');

        return $types[array_rand($types)];
    }

    public static function is_online($last_active)
    {
        if ($last_active > strtotime('now -5 minutes'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function is_mobile(){
        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
        $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
        $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
        $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
        $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
        $regex_match.=")/i";
        return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
    }

    public static function can_chat($user)
    {
        $blocked_memberships = array('10', '11', '12', '13', '14', '15', '17');

        if ( ! in_array(Core::$user->membership_id, $blocked_memberships))
        {
            return true;
        }
        else
        {
            if (in_array($user->membership_id, $blocked_memberships))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    }


    public static function detect() {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        // Identify the browser. Check Opera and Safari first in case of spoof. Let Google Chrome be identified as Safari.
        if (preg_match('/opera/', $userAgent)) {
            $name = 'opera';
        }
        elseif (preg_match('/webkit/', $userAgent)) {
            $name = 'safari';
        }
        elseif (preg_match('/msie/', $userAgent)) {
            $name = 'msie';
        }
        elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent)) {
            $name = 'mozilla';
        }
        else {
            $name = 'unrecognized';
        }

        // What version?
        if (preg_match('/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches)) {
            $version = $matches[1];
        }
        else {
            $version = 'unknown';
        }

        // Running on what platform?
        if (preg_match('/linux/', $userAgent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/', $userAgent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/', $userAgent)) {
            $platform = 'windows';
        }
        else {
            $platform = 'unrecognized';
        }

        return array(
            'name'      => $name,
            'version'   => $version,
            'platform'  => $platform,
            'userAgent' => $userAgent
        );
    }

	public static function src_file($src)
	{
		if (file_exists($src)) {
			$modified_time = filemtime($src);
			return $src . '?_=' . $modified_time;
		} else {
			return $src . '?_=' . 'file_not_found';
		}
	}

}
