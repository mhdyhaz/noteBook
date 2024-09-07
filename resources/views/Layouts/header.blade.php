<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page Title</title>
     <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalabe=no">
   
    <style>
    


    .header {
      
        padding:48px 0;
        text-align: center;
        background: linear-gradient(0deg, rgb(215, 221, 240) 0%, rgb(125, 119, 168) 100%);
        color: white;
        font-size: 16px;
        width: 100%;
        height: 42px;
        overflow: hidden;
    }
    

  
    #b-id{
        font-size: 38px;
        text-align: center;
        color: black;
        font-family: initial;
    }

    #backButton[type="submit"] {
        color:white;
    border: none;
    opacity: inherit;
    position: absolute;
    top: 50px;
    font-size: 13px;
    border-radius: 5px;
    background-color: rgb(11, 11, 100);
    padding: 3px 10px;
    left: 10px;
    font-family: initial;
    }
    #logout[type="submit"]{

        color:white;
    border: none;
    opacity: inherit;
    position: absolute;
    top: 50px;
    font-size: 13px;
    border-radius: 5px;
    background-color: rgb(11, 11, 100);
    padding: 3px 10px;
    left: 10px;
    font-family: initial;
    }

}
    </style>
</head>

<body>

        @if(!isset($hideBackButton) || !$hideBackButton)
            <button id="backButton" type="submit" onclick="window.history.back()" >Back</button>
        @endif
 
@if(!isset($hidelogout) || !$hidelogout)
<form action="{{ route('Dashborde.home') }}" method="GET">
    <button id="logout" type="submit" >logout</button>
</form>

@endif
    <div class="header">
        <h1 id="b-id">Notebook</h1>

    </div>



</body>
</head>

</html>