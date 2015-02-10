<?php
$xml = file_get_contents("php://input");

define('APPLICATION', 'chat7'); //Allowed values: chat7, messenger7

require_once "./module/cms.config.handler.php";
require_once "./module/db.class.php";

trace($xml);

/*Db::dbConnect();

if (!$result) {
    die('Invalid query: ' . mysql_error());
}
*/
trace($xml);

switch (APPLICATION)
{
    case 'chat7': chat7_log_pro($xml);
        /**
        CREATE TABLE `chat7_LP` (
        `log_id` int(11) unsigned NOT NULL auto_increment,
        `action` char(30) default NULL,
        `ip` char(30) default NULL,
        `ts` int(11) default NULL,
        `uid` char(64) default NULL,
        `userName` char(64) default NULL,
        `hasCam` char(15) default NULL,
        `id` int(11) default NULL,
        `error` char(128) default NULL,
        `roomID` char(64) default NULL,
        `roomName` char(128) default NULL,
        `receiverID` char(32) default NULL,
        `fileSize` char(32) default NULL,
        `fileName` char(64) default NULL,
        `senderID` char(64) default NULL,
        `isAccept` char(64) default NULL,
        `fileID` char(64) default NULL,
        `color` char(64) default NULL,
        `avatarID` char(64) default NULL,
        `status` char(128) default NULL,
        `video` char(32) default NULL,
        `audio` char(32) default NULL,
        `pause` char(32) default NULL,
        `publisherID` char(32) default NULL,
        `accepted` char(32) default NULL,
        `userID` char(32) default NULL,
        PRIMARY KEY  (`log_id`)
        )
         */
        break;

}


function objectsIntoArray($arrObjData, $arrSkipIndices = array())
{
        $arrData = array();
       
        // if input is object, convert into array
        if (is_object($arrObjData)) {
            $arrObjData = get_object_vars($arrObjData);
        }
       
        if (is_array($arrObjData)) {
            foreach ($arrObjData as $index => $value) {
                if (is_object($value) || is_array($value)) {
                    $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
                }
                if (in_array($index, $arrSkipIndices)) {
                    continue;
                }
                $arrData[$index] = $value;
            }
        }
        return $arrData;
}
    
    function trace($message, $isWriteLog = true)
    {
        $content = print_r($message, true);
        if($isWriteLog)
        {
            //var_dump(LOG_DIR.'log.txt');
            $handle = @fopen($_SERVER['DOCUMENT_ROOT'].'log_pro.txt', 'a');
            //var_dump(error_get_last());
            @fwrite($handle, date("Y-m-d H:i:s")."\r\n".$content."\r\n\r\n");
            @fclose($handle);
        }
        else echo "<pre>".$content."</pre><br>";
    }

function logQuery($rows, $values)
{
    		$mainSql = 'INSERT INTO 
                                '.APPLICATION.'_LP ('.$rows.') 
                               VALUES (\''.$values.'\')';
                               
            mysql_query($mainSql);
            //trace($mainSql);

}

function CollectLogProData($unitArray, $key, &$rows, &$values)
{
                unset($rows);
                unset($values);
                
                $rows[] = 'action';
                $values[] = $key;
                
                foreach ($unitArray as $log_unit_key=>$log_unit)
                {
                    //debug line
                    //var_dump($log_unit['@attributes']);
                        if (is_array($log_unit))
                        {
                            foreach ($log_unit as $subkey=>$subvalue)
                            {
                                $rows[] = $subkey;
                                $values[] = $subvalue;
                            }
                        }
                        else
                        {
                            $rows[] = $log_unit_key;
                            $values[] = $log_unit;
                        } 

                } 
                
                $rows = implode(", ", $rows);
                $values = implode("', '", $values);
        		logQuery($rows, $values);
                //trace(logQuery($rows,$values));
}
        
function chat7_log_pro($xml)
{
    $testXML ='<logPro ts="1283351509">
                	<autoLogin uid="d5b0ef4c8c51f303ecbaed81a6e078c5" hasCam="false" ip="127.0.0.1" ts="1283351406" />
                    <autoLogin uid="d5b0ef4c8cffdsfecbfaed81a6e078c5" hasCam="true" ip="127.0.0.1" ts="1283351406" />
                    <autoLogin uid="d5b0ef4c8cfxgnhfxfbaed81a6e078c5" hasCam="false" ip="127.0.0.1" ts="1283351406" />
                	<chatLogin hasCam="false" ip="127.0.0.1" ts="1283352053">
                		<userName>Guest</userName>
                	</chatLogin>
                    <chatLogin hasCam="false" ip="127.0.0.2"="null" ts="1283787434">
                		<userName>Login</userName>
                	</chatLogin>
                	<adminLogin hasCam="false" ip="127.0.0.1"="null" ts="1283352053">
                		<userName>admin</userName>
                	</adminLogin>
                	<guestLogin hasCam="false" ip="127.0.0.1" ts="1283352020">
                		<userName>guest</userName>
                	</guestLogin>
                	<loginResult ip="127.0.0.1" id="1" error="" ts="1283351406" />
                	<joinRoom id="1" roomID="z11283351417236" ts="1283351417" />
                	<leaveRoom id="1" roomID="room1" ts="1283351426" />
                	<createRoom id="1" ts="1283351417">
                		<roomName>test</roomName>
                	</createRoom>
                	<sendFile id="2" receiverID="1" fileID="1283351441141" fileSize="6Kb" ts="1283351441">
                		<fileName>script.txt</fileName>
                	</sendFile>
                	<acceptFile id="1" senderID="2" isAccept="true" fileID="1283351441141" ts="1283351444" />
                	<changeColor id="1" color="6684876" ts="1283351406" />
                	<changeAvatar id="1" avatarID="02" ts="1283351406" />
                	<changeStatus id="2" status="1" ts="1283351383" />
                	<publish id="1" video="false" audio="true" pause="false" ts="1283351421" />
                	<subscribe id="1" publisherID="2" roomID="proom2000" ts="1283351998" />
                	<unsubscribe id="1" publisherID="2" roomID="proom2000" ts="1283351998" />
                	<sendInvitation id="1" receiverID="2" roomID="null" ts="1283351494" />
                	<answerInvitation id="2" senderID="1" roomID="null" accepted="true" ts="1283351499" />
                	<startRecordVideo userID="1" ts="1283351499" />
                	<videoSaved userID="1" fileName="someFile.flv" ts="1283351499" />
                </logPro>';
                
    if ($_REQUEST['test'] == 1)
    {
       $xml =  $testXML;
    }
    
    Db::dbConnect();


    if (substr($xml, 1, 6) == "logPro")
    {
    
        $xmlArray = objectsIntoArray(simplexml_load_string($xml));
        
        //debug line
        trace($xmlArray);
        
        foreach ($xmlArray as $key=>$value)
        {
            if ($key != '@attributes')
            {
                //debug line
                //trace("-------------------------");
                //trace($xmlArray[$key]);
                //var_dump('----------------------------------');
                if (!empty($xmlArray[$key]['@attributes']))
                {
                    //debug line
                    //var_dump($xmlArray[$key]);
                    CollectLogProData($xmlArray[$key], $key, $rows, $values);
                }
                else
                {
                    //debug line
                    //trace($xmlArray[$key]);
                    foreach ($xmlArray[$key] as $subunit)
                    CollectLogProData($subunit, $key, $rows, $values);
                }
                
            }
        }
    	
    }
    
    echo 'Done';
 }


?>