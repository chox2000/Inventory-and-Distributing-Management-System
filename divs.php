<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Button Click</title>
  <style>
    #successModal {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: white;
      color:#4CAF50 ;
      z-index: 1;
      border-radius: 10px;
      border: 2px solid #4CAF50;
      height: 150px;
      width: 200px;
    }

    .sucess{
      width: 50px;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
             width: calc(100% - 5px);
    }

.gif{
     background: url('gif4.gif') no-repeat center center;
   margin-left: 25%;
    align-content: center;
    height: 95px;
    width: 95px;
    margin-bottom: 20px;
}

    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
     // background-color: white;
      backdrop-filter: blur(2px);
      z-index: 1;
    }
  </style>
</head>
<body>

<div id="overlay"></div>

<div id="successModal">
  <div class="gif"></div>
  <button onclick="redirectToIndex()" class="sucess">OK</button>
</div>

<script>
  function showSuccess() {
    var overlay = document.getElementById('overlay');
    var successModal = document.getElementById('successModal');

    overlay.style.display = 'block';
    successModal.style.display = 'block';
  }

  function hideSuccess() {
    var overlay = document.getElementById('overlay');
    var successModal = document.getElementById('successModal');

    overlay.style.display = 'none';
    successModal.style.display = 'none';
  }

function redirectToIndex() {
    hideSuccess();
    // Redirect to index.php
    window.location.href = 'option.php';
  }
</script>

</body>
</html>
