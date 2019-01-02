<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>mdl progress slider spinner</title>
  

  
</head>

<body>

  <html>
<head>
  <!-- Material Design Lite -->
  <script src="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.min.js"></script>
  <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.indigo-pink.min.css">
  <!-- Material Design icon font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
  <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <!-- Material Design icon font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <style type="text/css">
    body {
  padding: 20px;
  background: #fafafa;
  position: relative;
}
  </style>
</head>

<body>
  
  
  
  <button id="menu" class="mdl-button mdl-js-button mdl-button--icon  mdl-js-ripple-effect">
    <i class="material-icons">more_vert</i>
  </button>
   
  <ul class="mdl-menu mdl-js-menu" for="menu">
    <li class="mdl-menu__item">Cats</li>
    <li class="mdl-menu__item">Dogs</li>
    <li class="mdl-menu__item">Hamsters</li>
  </ul>
  
  <br><br>

<!-- Rich Tooltip -->
<div id="tt3" class="icon material-icons">cloud_upload</div>
<div class="mdl-tooltip" data-mdl-for="tt3">
Upload <strong>file.zip</strong>
</div>


  <br><br>
<!-- Multiline Tooltip -->
<div id="tt4" class="icon material-icons">share</div>
<div class="mdl-tooltip" for="tt4">
Share your content<br>via social media
</div>
  
 <br><br>
  <!-- Deletable Chip -->
<span class="mdl-chip mdl-chip--deletable">
    <span class="mdl-chip__text">Deletable Chip</span>
    <button type="button" class="mdl-chip__action"><i class="material-icons">cancel</i></button>
</span>
  

  <br><br>
  <!-- Right aligned menu below button -->
<button id="demo-menu-lower-right"
        class="mdl-button mdl-js-button mdl-button--icon">
  <i class="material-icons">more_vert</i>
</button>

<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-right">
  <li class="mdl-menu__item">Some Action</li>
  <li class="mdl-menu__item">Another Action</li>
  <li disabled class="mdl-menu__item">Disabled Action</li>
  <li class="mdl-menu__item">Yet Another Action</li>
</ul>

<br><br>
<button id="menu-speed" class="mdl-button mdl-js-button mdl-button--icon">
  <i class="material-icons">more_vert</i>
</button>
<ul class="mdl-menu mdl-js-menu" for="menu-speed">
  <li class="mdl-menu__item">Fast</li>
  <li class="mdl-menu__item" disabled>Medium</li>
  <li class="mdl-menu__item">Slow</li>
</ul>
</body>

</html>
  
  

 




</body>

</html>
