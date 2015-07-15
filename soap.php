 <?php
 $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
 $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

 require_once "./MailingService.php";

 function getEmailID($service, $type)
 {
     $filter = new SystemAddressFilter();
     //$service->filter = $filter;

     $typeCondition = new ScalarStringFilterCondition();
     $typeCondition->operator = "EQUAL";
     $typeCondition->value = $type;

     $filter->typeCondition = $typeCondition;

     $request = new ListRequest();
     $request->filter = $filter;

     $response = $service->_list($request);
     $ids = $response->objectId;

     return $ids[0];
 }

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
 Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">QB9KW8C8U8</wsse:Password>
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
 $txnid->id = '6128';
 $txn->mailingId = $txnid;

 $handle = $service->getTxnMailingHandle($txn);

 $sq = new TxnSendRequest();
 $sq->handle = $handle->handle;

 $record = new SendRecord();

 $idCol = new NameValuePair();
 $idCol->name = "id";
 $idCol->value = "1";
 $record->field[] = $idCol;

 $emailCol = new NameValuePair();
 $emailCol->name = "email_address";
 $emailCol->value = "jeff@reanimated.net";
 $record->field[] = $emailCol;

 $nameCol = new NameValuePair();
 $nameCol->name = "username";
 $nameCol->value = "omicron";
 $record->field[] = $nameCol;

 $passCol = new NameValuePair();
 $passCol->name = "password";
 $passCol->value = "183060976392a383037633a2e3f701e6c7987ebec50fe95752";
 $record->field[] = $passCol;

 $sdateCol = new NameValuePair();
 $sdateCol->name = "signup_date";
 $sdateCol->value = "02/22/2011";
 $record->field[] = $sdateCol;

 $ipCol = new NameValuePair();
 $ipCol->name = "ip_address";
 $ipCol->value = "173.170.52.218";
 $record->field[] = $ipCol;
 
 $fuserCol = new NameValuePair();
 $fuserCol->name = "from_username";
 $fuserCol->value = "TestUser";
 $record->field[] = $fuserCol;

 $favatarCol = new NameValuePair();
 $favatarCol->name = "from_avatar";
 $favatarCol->value = "http://www.swurve.com/assets/photos/t/trustme/4b162f646ba8c_m.png";
 $record->field[] = $favatarCol;
 
 
 /* ######## Swurve Email 
 $txn = new GetTxnMailingHandleRequest();
 $txnid = new TransactionalMailingId();
 $txnid->id = '6522';
 $txn->mailingId = $txnid;

 $handle = $service->getTxnMailingHandle($txn);

 $sq = new TxnSendRequest();
 $sq->handle = $handle->handle;

 $record = new SendRecord();

 $idCol = new NameValuePair();
 $idCol->name = "id";
 $idCol->value = "1";
 $record->field[] = $idCol;

 $emailCol = new NameValuePair();
 $emailCol->name = "email_address";
 $emailCol->value = "jeff@reanimated.net";
 $record->field[] = $emailCol;

 $nameCol = new NameValuePair();
 $nameCol->name = "username";
 $nameCol->value = "omicron";
 $record->field[] = $nameCol;

 $passCol = new NameValuePair();
 $passCol->name = "password";
 $passCol->value = "183060976392a383037633a2e3f701e6c7987ebec50fe95752";
 $record->field[] = $passCol;

 $sdateCol = new NameValuePair();
 $sdateCol->name = "signup_date";
 $sdateCol->value = "02/22/2011";
 $record->field[] = $sdateCol;

 $ipCol = new NameValuePair();
 $ipCol->name = "ip_address";
 $ipCol->value = "173.170.52.218";
 $record->field[] = $ipCol;
 
 $fuserCol = new NameValuePair();
 $fuserCol->name = "from_username";
 $fuserCol->value = "TestUser";
 $record->field[] = $fuserCol;

 $favatarCol = new NameValuePair();
 $favatarCol->name = "from_avatar";
 $favatarCol->value = "http://www.swurve.com/assets/photos/t/trustme/4b162f646ba8c_m.png";
 $record->field[] = $favatarCol;
*/
 
 /* ######## Activation Email
 $txn = new GetTxnMailingHandleRequest();
 $txnid = new TransactionalMailingId();
 $txnid->id = '6520';
 $txn->mailingId = $txnid;

 $handle = $service->getTxnMailingHandle($txn);

 $sq = new TxnSendRequest();
 $sq->handle = $handle->handle;

 $record = new SendRecord();

 $idCol = new NameValuePair();
 $idCol->name = "id";
 $idCol->value = "1";
 $record->field[] = $idCol;

 $emailCol = new NameValuePair();
 $emailCol->name = "email_address";
 $emailCol->value = "jeff@reanimated.net";
 $record->field[] = $emailCol;

 $nameCol = new NameValuePair();
 $nameCol->name = "username";
 $nameCol->value = "omicron";
 $record->field[] = $nameCol;

 $passCol = new NameValuePair();
 $passCol->name = "password";
 $passCol->value = "183060976392a383037633a2e3f701e6c7987ebec50fe95752";
 $record->field[] = $passCol;

 $sdateCol = new NameValuePair();
 $sdateCol->name = "signup_date";
 $sdateCol->value = "02/22/2011";
 $record->field[] = $sdateCol;

 $ipCol = new NameValuePair();
 $ipCol->name = "ip_address";
 $ipCol->value = "173.170.52.218";
 $record->field[] = $ipCol;
*/
 $sq->sendRecord = $record;

 $results = $service->txnSend($sq);

 print_r($results);

 exit();

 $bounce = getEmailID($service, 'BOUNCE');  $from = getEmailID($service, 'FROM');  $reply = getEmailID($service, 'REPLY');

 $filter = new DataSourceFilter();
 //$service->filter = $filter;

 $nameCondition = new ScalarStringFilterCondition();  $nameCondition->operator = "EQUAL";  $nameCondition->value = 'Swurve List';

 $filter->nameCondition = $nameCondition;

 $typeCondition = new ScalarStringFilterCondition();  $typeCondition->operator = "EQUAL";  $typeCondition->value = 'INTERNAL';

 $filter->typeCondition = $typeCondition;

 $request = new ListRequest();
 $request->filter = $filter;

 $response = $service->_list($request);
 $data_source = $response->objectId;

 $addRecordsRequest = new AddDataSourceRecordsRequest();  $addRecordsRequest->dataSourceId = $data_source[0];

 // Create records based on the datasource schema created in createIDS()
 $record1 = new DataSourceRecord();
 $record1->field = array();

 $idCol = new NameValuePair();
 $idCol->name = "id";
 $idCol->value = "1";
 $record1->field[] = $idCol;

 $emailCol = new NameValuePair();
 $emailCol->name = "email_address";
 $emailCol->value = "jeff@reanimated.net";  $record1->field[] = $emailCol;

 $nameCol = new NameValuePair();
 $nameCol->name = "name";
 $nameCol->value = "Jeff Wilbert";
 $record1->field[] = $nameCol;

 /*
 // Wait for data source status to be idle before adding  $end = time() + 60; // up to one minute

 while (time() < $end)
 {
   try
   {
     $data_source = $service->get($data_source[0]);
 
     if ($data_source[0]->operationStatus != "IDLE")
     {
       sleep(2);
     }
     else
     {
       break;
     }
   }
   catch (Exception $e)
   {
     // ok
   }
 }
 */
 // Add record to request and make call
 $addRecordsRequest->dataSourceRecord = array($record1);

 $test = $service->addRecords($addRecordsRequest);

 // ------------
 /*
 $filter = new TargetFilter();
 //$service->filter = $filter;


 $nameCondition = new ScalarStringFilterCondition();  $nameCondition->operator = "EQUAL";  $nameCondition->value = 'some target';

 $filter->nameCondition = $nameCondition;

 //$typeCondition = new ScalarStringFilterCondition();  //$typeCondition->operator = "EQUAL";  //$typeCondition->value = 'INTERNAL';

 //$filter->typeCondition = $typeCondition;

 $request = new ListRequest();
 $request->filter = $filter;

 $response = $service->_list($request);
 print_r($response);

 exit();
 $ids = $response->objectId;

 return $ids[0];
 */
 // ------------

 /*
 $target = new TargetId();
 $target->id = 5308;

 $hmm = new Target();
 $hmm->objectId = $target;

 $request = new GetRequest();
 $request->objectId = new SoapVar($target, SOAP_ENC_OBJECT, 'TargetId',  $schema, NULL, NULL);

 //$response = $service->create($request);

 $data = $service->get($request);

 print_r($data);
 exit;

 */
 $target = new Target();

 // Fill in the target
 $target->name = "some targets";
 $target->dataSourceId = $data_source[0];  $target->type = "ADVANCED";  $target->description = "Target from PHP";
 $target->emailAddressFieldName = "email_address";   // From the data 
 
 $target->bounceFieldName = "email_address_status";  // system generated  based on email column  $target->excludeBounce = true;  $target->unsubscribeFieldName = "unsub";  // system generated  $target->excludeUnsubscribe = true;  $target->advancedQuery = "SELECT * FROM ds_internal_5814 WHERE (  ds_internal_5814.email_address = 'jeff@reanimated.net' )";  //SELECT * FROM ds_internal_5814 WHERE ( ds_internal_5814.email_address  = 'jeff@reanimated.net' ) AND  ds_internal_5814.email_address_status='VALID' AND  ds_internal_5814.unsub= 'N'
 // Wait for data source status to be idle before adding  //$this->helper->waitForIdle($dataSourceId);

 $request = new CreateRequest();
 $request->baseObject = new SoapVar($target, SOAP_ENC_OBJECT, 'Target',  $schema, NULL, NULL);

 $response = $service->create($request);

 print_r($response);
 $targetid = $response->createResponse[0]->objectId;


 print_r($targetid);


 exit();

 $template = new Template();

 $template->bodyEncoding = "BASE64";
 $template->description = "Template from PHP";  $template->fromAddressId = $from;  $template->bounceAddressId = $bounce;  $template->replyAddressId = $reply;  $template->fromName = "Swurve Support Team";  $template->headerEncoding = "EIGHT_BIT";  $template->isApproved = true;  $template->name = 'Some test';  $template->outputBodyCharSet = "ASCII";  $template->outputHeaderCharSet = "UTF-8";  $template->subject = "PHP subject";  $template->attachmentId = array();  $template->contentBlockId = array();  $template->header = array(); //array("PHP template header");  //$template->forward2FriendOfferTrackingOption = "NONE";

 // Create a message part
 $messagePart = new MessagePart();
 $messagePart->content = "<html><body>hello, HTML  message</body></html>";  $messagePart->format = "HTML";  $messagePart->isXsl = false;

 $template->messagePart = array($messagePart);

 // Make call
 $request = new CreateRequest();
 $request->baseObject = new SoapVar($template, SOAP_ENC_OBJECT,  'Template', $schema, NULL, NULL);

 $response = $service->create($request);

 $templateid = $response->createResponse[0]->objectId;
 //print_r($response->createResponse[0]->objectId);

 $mailing = new TransactionalMailing();

 $mailing->description = "TransactionalMailing from PHP";  $mailing->type = "TRANSACTIONAL";  $test = new Target();



 //$mailing->targetId = new TargetId();  //SampleHelper::getSoapEntityIdObject(new TargetId(),
 //                                                         
 //                                                         "TargetId");

 $mailing->bodyEncoding = "BASE64";
 $mailing->bounceAddressId = $bounce;
 $mailing->fieldDelimiter = "::";
 $mailing->fromAddressId = $from;
 $mailing->fromName = "Swurve Support Team";  $mailing->headerEncoding = "EIGHT_BIT";  $mailing->isApproved = true;  $mailing->isCompliant = true;  $mailing->name = 'some test mailing';  $mailing->outputBodyCharSet = "UTF-8";  $mailing->outputHeaderCharSet = "ASCII";  $mailing->priority = "NORMAL";  $mailing->replyAddressId = $reply;  $mailing->rowDelimiter = "\n";  $mailing->subject = "mailing subject";  $mailing->templateId = $templateid;  $mailing->format = array();  $mailing->format[] = "HTML";  $mailing->header = array();


 //$mailing->forward2FriendOfferTrackingOption = "NONE";  $mailing->messageType="EMAIL";

 $request = new CreateRequest();
 $request->baseObject = new SoapVar($mailing, SOAP_ENC_OBJECT,  'TransactionalMailing', $schema, NULL, NULL);

 $response = $service->create($request);

 print_r($response);
 $mailingid = $response->createResponse[0]->objectId;

 print_r($mailingid);
 ?>
