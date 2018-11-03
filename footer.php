
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
      
      <script type="text/javascript">
      
        $(".toggleForms").click(function() {
            
            $("#facultyLogIn").toggle();
            $("#studentLogIn").toggle();
            
            
        });

        $(".toggleForms").click(function() {
            
            $("#facultydetails").toggle();
            $("#studentdetails").toggle();
            
            
        });
          
          $('#diary').bind('input propertychange', function() {

                $.ajax({
                  method: "POST",
                  url: "updatedatabase.php",
                  data: { content: $("#diary").val() }
                });

        });

        $('.what').click(function(){

          alert("happens");

        });

        $("#accept").click(function(){

          if($("#button").is(":enabled")){

            $("#button").prop("disabled",true);


          }else{

            $("#button").prop("disabled",false);

          }

        });

        $("#hello").click(function(){

          $(".maketoggle").toggle();

        });

        $("#hi").click(function(){

          $(".saketoggle").toggle();
          $(".baketoggle").css("display","none");

        });

        $(".toggleForms").click(function() {
            
            $("#addtheoryattendance").toggle();
            $("#addlabattendance").toggle();
            
            
        });

         $("#hello").click(function(){

            $(".egx").css("display","none");

        });

        $("#cAtten").click(function(){

          $(".baketoggle").toggle();
          $(".saketoggle").css("display","none");

        });

        $(".check").click(function(){

          $(".maketogge").css("display","none");

        });

      </script>
      
  </body>
</html>


