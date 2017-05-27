//Ignore this, it's just good to wrap all JS code in this weird thing.
//Make sure to put any added code before the weird series of characters at the end.
(function() {
    
    //When the page loads it calls the load function
    window.onload = load;
    //comment out the next line if you would like the page to stop reloading the txt files and images every 30 seconds
    setInterval(load, 30000);
    
    //This function makes an AJAX call to the php file and gets a string of html code back.
    //This code is then inserted into the main "section" of the html page
    function load() {
  //  	document.getElementById("sensorData").innerHTML = "";
		// document.getElementById("images").innerHTML = "";
    	
    	//This is all the AJAX request stuff.
        var xhr = new XMLHttpRequest();
		xhr.open("GET", "AUEG.php");
		xhr.onload = function() {
			var data = JSON.parse(this.responseText);
		    //This is what happens if the AJAX request goes through. Adds all of
		    //the html generated in the masterString in the PHP file.
		    document.getElementById("sensorData").innerHTML = data["sensor"];
		    document.getElementById("images").innerHTML = data["images"];
		};
		xhr.onerror = function() {
		    //This is what happens if there is an error and the PHP had an error
		    //or the PHP was not called/couldn't be found.
			alert("ERROR - Likely an issue with your PHP not being called! (PHP requires a server)");
		};
		xhr.send();
    }
    
//Put all code before this, should be at bottom of doc
})();