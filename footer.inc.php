 <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; 2020</p>
    </div>
    <!-- /.container -->
  </footer>

    <?php
      $keyword="";
      if(isset($_GET['q']) && $_GET['q'] != '')
      {
        $keyword=$_GET['q'];
      }
    ?>
    <!-- Optional JavaScript -->
    <script>
      let keyword = '<?php echo $keyword; ?>';
      let book_id = <?php echo isset($book_id)?$book_id:0 ?>;
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="/book-shop/js/main.js"></script>
  </body>
</html>