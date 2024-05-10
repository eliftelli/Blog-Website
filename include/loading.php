<!DOCTYPE html>
<html>
<head>
  
<style>

#loading {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items:center;
  justify-content:center;
  background-color: #fff;
  z-index: 999
} 
    </style>
</head>
<body>
    <div id="loading">
        <img src="../assets/images/Spinner-1s-200px.gif" alt="Yükleniyor...">
        
    </div>

  

    <script>
    window.addEventListener('load', fg_load)

    function fg_load() {
        document.getElementById('loading').style.display = 'none'
    }
</script>
</body>

</html>
