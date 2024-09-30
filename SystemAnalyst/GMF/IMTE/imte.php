<?php

 include("connection.php");

 

$imte=getConnectionOne();

$xml="<Data>\r\n";

 

$unit = $imte->Execute("SELECT

`unit_manager`.`USER_UNIT_MGR`,

                unit_manager.UNIT_DESC,

`unit_manager`.`MANAGER_NAME`,

`unit_manager`.`NOPEG`,

SUBSTRING(unit_manager.USER_UNIT_MGR,1,3),

`unit_master_gm`.`NOPEG`,

`unit_master_gm`.`NAME`,

`unit_master_gm`.`JABATAN`,

`unit_master_gm`.`UNIT`,

`unit_master_gm`.`EMAIL`

FROM

`master`

Inner Join `unit_manager` ON `master`.`USER_UNIT_MGR` = `unit_manager`.`USER_UNIT_MGR`

Inner Join `unit_master_gm` ON SUBSTRING(`unit_manager`.`USER_UNIT_MGR`,1,3) = SUBSTRING(`unit_master_gm`.`UNIT`,4,8)

WHERE master.CURRENT_POSITION='ON USER' AND master.ID_CUSTOMER='GMFAA' AND master.CAL_STATUS='CALIBRATED' AND master.NEXT_DUE_DATE!='0000-00-00'

AND (master.USER_UNIT_MGR LIKE 'T%' OR master.USER_UNIT_MGR LIKE 'W%') AND (master.USERLOCATION!='NF' AND master.USERLOCATION!='RAI' AND master.USERLOCATION!='NC')

AND unit_manager.USER_UNIT_MGR like '%%' AND DATEDIFF(master.NEXT_DUE_DATE,curdate()) < 6

GROUP BY unit_manager.USER_UNIT_MGR");

// AND DATEDIFF(master.NEXT_DUE_DATE,curdate()) > 0

 

while(!$unit->EOF){

                //email authorized         

                $name = $unit->fields[2];

                $nopeg = $unit->fields[3];

               

                $mail = $imte->Execute("SELECT

                `tabmail`.`EMAIL`

                FROM

                `unit_manager`

                Inner Join `tabmail` ON `tabmail`.`NOPEG` = `unit_manager`.`NOPEG`

                WHERE

                `unit_manager`.`NOPEG` = '".$nopeg."'");

               

                $destination = $nopeg.' | '.$name.' | '.$unit->fields[0];

                $temp_emp = $unit->fields[3].' | '.$unit->fields[2].' | '.$unit->fields[1];

                $data                     = str_replace(" ",'_',$unit->fields[0]);

                $subject               = "IMTE Remainder ";

/*             $body                  = "

<style>

pre {

    font-family: TimeNewRoman;

                font-size: 15px;

}

</style>";

*/          $body                   ="

<pre>Dengan hormat,

$temp_emp

 

Bersama ini kami sampaikan Calibration Remainder IMTE yang akan segera dan telah overdue.

Dengan adanya informasi secara otomatis ini diharapkan kerja sama Unit Produksi untuk segera mengirimkan IMTE tersebut ke Lab. Kalibrasi Workshop 2.

               

Kami informasikan bahwa Calibration Remainder IMTE ini akan terkirim ke unit produksi secara otomatis dan akan berhenti secara otomatis bila IMTE sudah dikirim ke Lab. Kalibrasi.           

 

Note : Batasan pengiriman Calibration Remainder IMTE secara otomatis adalah 5 hari menjelang overdue IMTE s.d IMTE dikirim ke unit TCY-2.

 

Anda juga dapat men-download file pada link berikut :

http://intra.gmf-aeroasia.co.id/IMTE/SendCalibration/php/createMessage.php?data=".$data."</pre>";

 

// update 20150826 http://abs.gmf-aeroasia.co.id/SendCalibration/php/createMessage.php?data=".$data."</pre>";

               

                // List IMTE =======================================================================================================================================================

                $result     = $data;

                $result_query1  = '';

                $result_query2  = '';

                $result_query3  = '';

                $result_query4  = '';

                $result_query5  = '';

                $result_query6  = '';

                $result_query7  = '';

                $result_query8  = '';

                $result_query9  = '';

                $result_query10 = '';

                                               

                $idx=0;

                $SQLi = "SELECT master.REGISTER_NUMBER,master.DESCRIPTION,master.MODEL,master.PARTNUMBER,master.SERIALNUMBER,unit_manager.USER_UNIT_MGR,unit_manager.UNIT_DESC,master.USERLOCATION,master.NEXT_DUE_DATE,DATEDIFF(master.NEXT_DUE_DATE,curdate()) AS OVERDUE, 

                unit_manager.MANAGER_NAME FROM master INNER JOIN unit_manager ON master.USER_UNIT_MGR=unit_manager.USER_UNIT_MGR WHERE master.CURRENT_POSITION='ON USER' AND master.ID_CUSTOMER='GMFAA' AND master.CAL_STATUS='CALIBRATED' AND master.NEXT_DUE_DATE!='0000-00-00'

                AND (master.USER_UNIT_MGR LIKE 'T%' OR master.USER_UNIT_MGR LIKE 'W%') AND (master.USERLOCATION!='NF' AND master.USERLOCATION!='RAI' AND master.USERLOCATION!='NC')

                AND unit_manager.USER_UNIT_MGR like '%%' AND DATEDIFF(master.NEXT_DUE_DATE,curdate()) < 6  AND unit_manager.USER_UNIT_MGR = '".$result."' ORDER BY unit_manager.MANAGER_NAME";

                // DATEDIFF(master.NEXT_DUE_DATE,curdate()) > 0 AND

                $plus = $SQLi;

                $query = $imte->Execute($plus);

                while(!$query->EOF)

                {

                                if($query->fields[0] == ''){$data1 = '-';}else{$data1 = $query->fields[0];}

                                if($query->fields[1] == ''){$data2 = '-';}else{$data2 = $query->fields[1];}

                                if($query->fields[2] == ''){$data3 = '-';}else{$data3 = $query->fields[2];}

                                if($query->fields[3] == ''){$data4 = '-';}else{$data4 = $query->fields[3];}

                                if($query->fields[4] == ''){$data5 = '-';}else{$data5 = $query->fields[4];}

                                if($query->fields[5] == ''){$data6 = '-';}else{$data6 = $query->fields[5];}

                                if($query->fields[6] == ''){$data7 = '-';}else{$data7 = $query->fields[6];}

                                if($query->fields[7] == ''){$data8 = '-';}else{$data8 = $query->fields[7];}

                                if($query->fields[8] == ''){$data9 = '-';}else{$data9 = $query->fields[8];}

                                if($query->fields[9] == ''){$data10 = '-';}else{$data10 = $query->fields[9];}

                                if($query->fields[10] == ''){$datamgr = '-';}else{$datamgr = $query->fields[10];}

                                if($idx==0){

                                                $result_query1 = $data1;

                                                $result_query2 = $data2;

                                                $result_query3 = $data3;

                                                $result_query4 = $data4;

                                                $result_query5 = $data5;

                                                $result_query6 = $data6;

                                                $result_query7 = $data7;

                                                $result_query8 = $data8;

                                                $result_query9 = $data9;

                                                $result_query10 = $data10;

                                }else{

                                                $result_query1 = $result_query1.'|'.$data1;

                                                $result_query2 = $result_query2.'|'.$data2;

                                                $result_query3 = $result_query3.'|'.$data3;

                                                $result_query4 = $result_query4.'|'.$data4;

                                                $result_query5 = $result_query5.'|'.$data5;

                                                $result_query6 = $result_query6.'|'.$data6;

                                                $result_query7 = $result_query7.'|'.$data7;

                                                $result_query8 = $result_query8.'|'.$data8;

                                                $result_query9 = $result_query9.'|'.$data9;

                                                $result_query10 = $result_query10.'|'.$data10;

                                }

                                $idx++;

                                $query->MoveNext();

                }

                // List IMTE =======================================================================================================================================================

                $fill= '';

                $rc1 = '';

                $rc2 = '';

                $rc3 = '';

                $rc4 = '';

                $rc5 = '';

                $rc6 = '';

                $rc7 = '';

                $rc8 = '';

                $rc9 = '';

                $rc10 = '';

               

                $rc1 = explode('|',$result_query1);

                $rc2 = explode('|',$result_query2);

                $rc3 = explode('|',$result_query3);

                $rc4 = explode('|',$result_query4);

                $rc5 = explode('|',$result_query5);

                $rc6 = explode('|',$result_query6);

                $rc7 = explode('|',$result_query7);

                $rc8 = explode('|',$result_query8);

                $rc9 = explode('|',$result_query9);

                $rc10 = explode('|',$result_query10);

                for($x=0;$x<$idx;$x++){

                                $fill  .= "<br>";

                                $fill  .= ($x+1).'  ============================='."<br>";

                                $fill  .= '<pre>Registration            :'.$rc1[$x]."<br>";

                                $fill  .= 'Description          :'.$rc2[$x]."<br>";

                                $fill  .= 'Model                   :'.$rc3[$x]."<br>";

                                $fill  .= 'P/N                         :'.$rc4[$x]."<br>";

                                $fill  .= 'S/N                         :'.$rc5[$x]."<br>";

                                $fill  .= 'Unit                        :'.$rc6[$x]."<br>";

                                $fill  .= 'Unit Desc             :'.$rc7[$x]."<br>";

                                $fill  .= 'Location                :'.$rc8[$x]."<br>";

                                $date  = substr($rc9[$x],8,2);

                                $month = substr($rc9[$x],5,2);

                                $year  = substr($rc9[$x],0,4);

                                if($month == '01'){$month = 'January';}

                                elseif($month == '01'){$month = 'January';}

                                elseif($month == '02'){$month = 'february';}

                                elseif($month == '03'){$month = 'march';}

                                elseif($month == '04'){$month = 'April';}

                                elseif($month == '05'){$month = 'May';}

                                elseif($month == '06'){$month = 'June';}

                                elseif($month == '07'){$month = 'July';}

                                elseif($month == '08'){$month = 'August';}

                                elseif($month == '09'){$month = 'September';}

                                elseif($month == '10'){$month = 'October';}

                                elseif($month == '11'){$month = 'November';}

                                elseif($month == '12'){$month = 'December';}

                                $fill  .= 'Next Due              :'.$date.'-'.$month.'-'.$year."<br>";

                                $fill  .= 'Over Due             :'.$rc10[$x]."</pre>";

                }

                $kirim       =  $fill;

                $body      .= $kirim;

                $body      .= "<br/>Terimakasih.<br/><br/>GM Calibration Services";

                //print_r($body);

               

                //$to = $mail->fields[0];

                $to = 'pahrus.salam@gmf-aeroasia.co.id';

                $mailcc = '';

                //$mailcc = $unit->fields[9];

                $mailcc                   .= 'yudi_e@gmf-aeroasia.co.id';

//echo $mailcc;

                // Require Pear Mail Packages

                require_once ("Mail.php");

                require_once ("Mail/mime.php");

                $recipients  = $to.", ".$mailcc;

                //$recipients  = $to;

                // Additional headers

                $headers["From"] = 'app.notif@gmf-aeroasia.co.id';

                $headers["Reply-To"]    = 'yudi_e@gmf-aeroasia.co.id';

                $headers["To"]    = $to;

                $headers["Cc"]    = $mailcc;

                $headers["Subject"] = $subject;

                $crlf = "\n";

                $mime = new Mail_mime($crlf);

 

                $mime->setHTMLBody($body);

                //$mime->addHTMLImage(file_get_contents('ftp://user-ts:aeroasia@192.168.240.85/foto/001.jpg'),'image/jpeg','img/image.jpg',false);

                //$mime->setHTMLBody('<html><body><img src="img/image.jpg"> <p>You dont see this image.</p></body></html>');

                //$mime->addHTMLImage('Desert.jpg', 'image/jpg');

 

                $message = $mime->get();

                $headers = $mime->headers($headers);

                /*$params["host"]    = 'smtp.office365.com';

                $params["auth"]    = TRUE; // note: there are *no delimiters*

 

                // note: there are *no delimiters* for DIGEST-MD5 either.

                // If you want to use PLAIN,

                // you have to use delimiters like this: 'PLAIN'

                //$params["auth"]    = DIGEST-MD5;

                $params["username"]    = 'app.notif';

                $params["password"]    = '@Ap.notif';

                $params["localhost"]= 'mail.gmf-aeroasia.co.id';

                // Debug so that we see what's happenning for the moment.

                $params["debug"]    = "True";

                */

                $params["host"]    = 'mail.gmf-aeroasia.co.id';

                $params["auth"]    = TRUE;

                $params["username"]    = 'app.notif';

                $params["password"]    = 'app.notif';

                $params["localhost"]   = 'mail.gmf-aeroasia.co.id';

                $params["debug"]       = "True";

               

                // create the mail object using the Mail::factory method

                $mail_message =& Mail::factory('smtp', $params);

                $mail_message->send ($recipients, $headers, $message);

                die;

                $unit->MoveNext();

}
