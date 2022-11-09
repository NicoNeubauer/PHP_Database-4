<?php


function readFromFile($fileName){
    $filederect = "database/$fileName";
    $fh = fopen($filederect, 'r') 
        or die ('Failed! Could not open file!');
    
    $idx = 0;
    $firstLineExtracted = FALSE;
    while (!feof($fh)){
    $line = fgets($fh); // read line
        
        if($firstLineExtracted == FALSE){
            // extract first line as keys
            $headersArray = explode(',',$line);
            $firstLineExtracted = TRUE;
            continue;
            
        }
            
        $lineArray = explode(',',$line);
        if(is_null($lineArray[1])){
            // check if entry in array is null.
        }else{
            $valuesArray[$idx] = $lineArray;
            $idx++;
        }

    }

    fclose($fh);

    //return array('keysArray' => $keysArray, 'valuesArray' => $valueArray);
    return array('headersArray' => $headersArray, 'valuesArray' => $valuesArray);
}


//function to read thais file and return headers and entries
function readThisFile($fileName){
    $filederect = "database/$fileName";
    $file = fopen($filederect, "r") or die("Unable to");

    //output one line untill end-pf-file
    $idx = 0;
    while(!feof($file)){

        if ($idx == 0) {
            $headersArray = fgetcsv($file);
        
        } else {
            $line = fgetcsv($file);

            if (!(is_null($line[1]))) {
                $valuesArray[$idx-1] = $line;
            }
        }

        $idx++;   
    }

    fclose($file);

    return array('headersArray' => $headersArray, 'valuesArray' => $valuesArray);

}

function createAssocArray($headersArray,$valuesArray){
    // create an associative Array given headers and Values
    foreach ((array)$valuesArray as $item => $value){
    //print_r($item);print_r($value);echo "<br>";
    $idx = 0;
        foreach ((array)$headersArray as $key){
            $resArray[$item][$key] = $value[$idx];         
            $idx++;
        }
    }
    
    return $resArray;
    
} 

function createTable($resArray){

    echo "<table>";
        
    foreach ($resArray as $item){
        
        
        
        if ($isFirstRow = FALSE){
            // first print headers
            echo "<tr>";
            foreach ($item as $key => $value){
                echo "<th> $key </th>";
            }
            echo "</tr>";
            
            //then print first row of values
            echo "<tr>";
            foreach ($item as $key => $value){
                echo "<td> $value </td>";
            }
            echo "</tr>";
            
            $isFirstRow = TRUE;
            
        }else {
            // then print every subsequent row of values
            echo "<tr>";
            foreach ($item as $key => $value){
                echo "<td> $value </td>";
            }
            echo "</tr>";
        }
        
        

    }    
    echo "</table>";
       
}

function initializeData($headers, $databasename){






    
}

?>