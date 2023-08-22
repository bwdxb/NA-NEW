<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download</title>
</head>
<body>
    
<h1 id="heading">Click the below link to download</h1>

<a href="" id='download-link' download>Download</a>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script >
    $(document).ready(function(){
        const queryString = window.location.search;
        console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const url = urlParams.get('u')
       
        console.log(url)
        if(url){
            window.location.href =url;
            $('#download-link').attr('href',url);
       
        }else{
            alert('invalid url');
            // close();
        }
});
</script>
</html>