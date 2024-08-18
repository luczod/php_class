  <footer id="footer">
    <div id="social-container">
      <ul>
        <li>
          <a href="#"><i class="fab fa-facebook-square"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </li>
      </ul>
    </div>
    <div id="footer-links-container">
      <ul>
        <li><a href="<?= $BASE_URL ?>newmovie.php">Add movie</a></li>
        <li><a href="#">Add review</a></li>
        <li><a href="<?= $BASE_URL ?>auth.php">Login / Register</a></li>
      </ul>
    </div>
    <p>&copy; 2024 Time to code</p>
  </footer>
  <!-- BOOTSTRAP JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.js"
    integrity="sha512-KCgUnRzizZDFYoNEYmnqlo0PRE6rQkek9dE/oyIiCExStQ72O7GwIFfmPdkzk4OvZ/sbHKSLVeR4Gl3s7s679g=="
    crossorigin="anonymous"></script>
    <script type="text/javascript">
      let msg = document.querySelector('.msg-container');
      let btnClose = document.getElementById("id-btnClose");
      if(!!btnClose){
        btnClose.addEventListener("click",function(){
           msg.remove();
        })
      }
      
    </script>
</body>

</html>