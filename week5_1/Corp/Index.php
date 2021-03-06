<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <style type="text/css">
            input{
                position: relative;
                left:45%;
            }
            p{
              position:relative;
              left:45%;
            }
            button{
                position: relative;
                left:50%;
            }
            select{
                position: relative;
                left:45%;                
            }
            textArea{
                position: relative;
                left:45%;
                width: 20%;     
            }
            textArea[name="results"]{
                position: relative;
                left:45%;
                height: 300px;   
            }
            h2{
                position: relative;
                left:45%;

            }

        </style>
    </head>
    <body>

        <h2>Corporations</h2>
        
        <p>Source:</p>
        <select name="verb">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select>
        <br />
        <br />
        <p>Resource for endpoint:(add / and the id if you wish to find one id)</p>
        <br />
        <input name="resource" value="corps" />
        <br />
        <p>Corporation:</p>   
         <input type="text" name="corp" value="" />
        <br />
        <p>Found On: </p>
         <input type="date" name="incorp_dt" value="" />
        <br />
        <p> Email:</p> <input type="email" name="email" value="" />
        <br />
        <p>Owner:</p> <input type="text" name="owner" value="" />
        <br />
        <p>Phone:</p> <input type="text" name="phone" value="">
        <br />
        <p>Location:</p> <input id="address" type="text" placeholder="Enter address here" name='address' />
        <br />
        <br />        
        <div id="coder"style="display: none;">
           <p>Location:
            <input type="text" id="local" readonly name="local" />
           </p>
        </div>
        <button>Make Call</button>
        
        <p>Results</p>
        <textarea name="results"></textarea>

        
        <script type="text/javascript">
            function showResult(result) {
                document.getElementById('local').value = result.geometry.location;
            }

            function getLatitudeLongitude(callback, address) {
                // If adress is not supplied, use default value 'Ferrol, Galicia, Spain'
                address = address || 'United States,Ferrol, Galicia, Spain';
                // Initialize the Geocoder
                geocoder = new google.maps.Geocoder();
                if (geocoder) {
                    geocoder.geocode({
                        'address': address
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            callback(results[0]);
                        }
                    });
                }
            }        
            var callBtn = document.querySelector('button'); //set a var to the button
            
            callBtn.addEventListener('click', function () {
                //add event handler that will  do the following
                var address = document.getElementById('address').value;
                //getting the location value
                getLatitudeLongitude(showResult, address); 
                //getting the latitude longitude 
                var verbfield = document.querySelector('select[name="verb"]');
                //getting the type 
                var verb = verbfield.options[verbfield.selectedIndex].value;
                //verb is placed a array and its value 
                var resource = document.querySelector('input[name="resource"]').value;
                //getting the resource
                
                var data = {
                    'corp' : document.querySelector('input[name="corp"]').value,
                    'incorp_dt' : document.querySelector('input[name="incorp_dt"]').value,
                    'email' : document.querySelector('input[name="email"]').value,
                    'owner' : document.querySelector('input[name="owner"]').value,
                    'phone' : document.querySelector('input[name="phone"]').value,
                    'location':document.querySelector('input[name="local"]').value
                }; 
                //settting the values in this case the data
                var results = document.querySelector('textarea[name="results"]');
                //setting variable results set to the textarea results
                var xmlhttp = new XMLHttpRequest();
                //XMLHttpRequest is an API that provides client functionality for transferring data between a client and a server
                var url = './api/v1/' + resource;
               // setting the url to the resource
                xmlhttp.open(verb, url, true);
                //opening the verb value and sending the url and sending true
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === 4 ) {

                        console.log(xmlhttp.responseText);
                        results.value = xmlhttp.responseText;
                       
                    } else {
                        // waiting for the call to complete
                    }
                   
                };
                


                 if ( verb === 'GET' ) {
                      xmlhttp.send(null);
                 } else {
                    xmlhttp.setRequestHeader('Content-type','application/json;charset=UTF-8');
                    xmlhttp.send(JSON.stringify(data));
                }
                if ( verb === 'POST' ) {
                      xmlhttp.send(null);
                 } else {
                    xmlhttp.setRequestHeader('Content-type','application/json;charset=UTF-8');
                    xmlhttp.send(JSON.stringify(data));
                }
                if ( verb === 'PUT' ) {
                      xmlhttp.send(null);
                 } else {
                    xmlhttp.setRequestHeader('Content-type','application/json;charset=UTF-8');
                    xmlhttp.send(JSON.stringify(data));
                }
            });
        </script>

    </body>
</html>
