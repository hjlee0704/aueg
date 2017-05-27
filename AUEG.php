<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Cache-Control: max-age=0, must-revalidate");
    header("Cache-Control: no-store");
    #String that will contain all of the html code that will be injected into the page
    $sensorData = '<h2>Current Weather Sensor Data</h2>';
    $images = '<h2>Security Cameras</h2>';
    #Makes an array of all of the files that end in ".txt"
    #If the files are in a different folder add that before the *.
    #Example: if they were in pictures you'd say ("textFiles/*.txt"), looking up regex stuff might help if stuck.
    $txtFiles = glob("*.txt");
    
    #makes an array of all the files that end in ".png", .jpg, or .jpeg (can be changed to whatever format is 
    #needed - make sure it's HTML image compatible!)
    #If the images are in a different folder add that before the *.
    #Example: if they were in pictures you'd say ("pictures/*.txt"), looking up regex stuff might help if stuck.
    $imgFiles = array_merge(glob("*.png"), glob("*.jpg"), glob("*.jpeg"));
    
    #loops through each of the text files
    foreach ($txtFiles as $txtFile) {
        #separates each of the files with a horizontal rule
        $sensorData .= '<hr />';
        #adds the name of the text file (h3 style added, makes it bold and bigger)
        $sensorData .= '<h3>' . $txtFile . ":" . '</h3>';
        
        #Makes an array of all of the lines in the current text file. This makes it possible
        #to print the files exactly as they are saved. (preserves the new lines, doesn't make it all one long string)
        $lines = file($txtFile, FILE_IGNORE_NEW_LINES); 
        #Puts the contents of each file in a paragraph tag
        $sensorData .= '<p>';
        #loops through all of the lines in each text file
        foreach ($lines as $line) {
            #adds the current line to be printed
            $sensorData .= $line;
            #moves to next line to match the output of the text file
            $sensorData .= '<br />';
        }
        $sensorData .= '</p>';

    }
    
    #Loops through all of the images in the directory and adds them to the masterString to be added to the page
    foreach ($imgFiles as $imgFile) {
        $images .= '<hr /><h3>' . $imgFile . ":" . '</h3><br />';
        $images .= '<img src = "' . $imgFile. "?" . date("h:i:s") . '"/>';
    }
    
    $masterString = array (
        "sensor" => $sensorData,
        "images" => $images
    );
    #specifies that the type of data returned is plain text, in this case a 
    #string containing everything in HTML format.
    header("Content-type: application/json");
    #prints out the masterString, which is then processed by the JavaScript
    print (json_encode($masterString));
?>
