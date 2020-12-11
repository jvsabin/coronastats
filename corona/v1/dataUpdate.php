<?php
        include('simple_html_dom.php');
        include('toDB.php');
        $url="https://www.worldometers.info/coronavirus/";
        $html = file_get_html($url);
        //echo $html;
        $div= $html-> find('div[class="main_table_countries_div"]',0); //the content div
        //echo $list_bodyArray =$div->find('td', 0)->plaintext;
        $content_list=$div->find('td');
        for($i=0; $i<sizeof($content_list); $i++){
            if(($i%9)==0){
                //echo "<br>";
            }
            $content_list[$i]= $content_list[$i]->plaintext;
            if($content_list[$i]==null){
                $content_list[$i]="0";
            }
            $content_list[$i]= str_replace([',','+','*'], '', $content_list[$i]);
            //echo ($content_list[$i]);
            
        }
        for($i=0; $i<sizeof($content_list); $i++){
            //echo ($content_list[$i]);
            //echo "<br>";
        }
        $conn->query("Truncate table scrapedata");
        for($i=0; $i<sizeof($content_list); $i+=12){
            //$i=1575;
            $data0=$content_list[$i];
            $data1=$content_list[$i+1];
            $data2=$content_list[$i+2];
            $data3=$content_list[$i+3];
            $data4=$content_list[$i+4];
            $data5=$content_list[$i+5];
            $data6=$content_list[$i+6];
            $data7=$content_list[$i+7];
			$data8; $data9;
			if((int)$data1==0){
				$data8=0;
				$data9=0;
			}
			else{
				$data8=number_format((((int)$data5 * 100)/(int)$data1),2);
				$data9=number_format((((int)$data3 * 100)/(int)$data1),2);
			}
            
            if($conn->query("INSERT INTO scrapedata (country, totalcase, newcase, totaldeath, newdeath, totalrecover, activecase,critical,recoverperc,deathperc) VALUES('$data0','$data1','$data2','$data3','$data4','$data5','$data6','$data7','$data8','$data9')")){
                echo 'Data inserted';
				echo "data='$data0','$data1','$data2','$data3','$data4','$data5','$data6','$data7','$data8','$data9'";
                echo '<br/>';
            }
        }
        logger("Your msg in log ", "UpdateLOG", " ");


        function logger($logMsg="logger", $filename="logger", $logData=""){     
            $log  = date("j.n.Y h:i:s")." || $logMsg : ".print_r($logData,1).PHP_EOL .                  
            "-------------------------".PHP_EOL;
            file_put_contents('./log/'.$filename.date("j.n.Y").'.log', $log, FILE_APPEND);                      
        }
          
        //echo sizeof($list_bodyArray);
        
        //echo $div;
        //foreach($html-> find('div[class="main_table_countries_div"]',0) as $pdiv){
          //  echo $pdiv;
        //}
    ?>