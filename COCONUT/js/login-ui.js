$("#breadcrumbs a").hover(
    function () {
        $(this).addClass("hover").children().addClass("hover");
        $(this).parent().prev().find("span.arrow:first").addClass("pre_hover");
    },
    function () {
        $(this).removeClass("hover").children().removeClass("hover");
        $(this).parent().prev().find("span.arrow:first").removeClass("pre_hover");
    }
);

open = function(verb, url, data, target) {
  var form = document.createElement("form");
  form.action = url;
  form.method = verb;
  form.target = target || "_self";
  if (data) {
    for (var key in data) {
      var input = document.createElement("textarea");
      input.name = key;
      input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
      form.appendChild(input);
    }
  }
  form.style.display = 'none';
  document.body.appendChild(form);
  form.submit();
};

$(document).ready(function (){

  $("#error").hide();

  $('.virtual-signin').click(function(){
      
      var username = $('#username').val();
      var password = $('#password').val();
      var module = $("#module").val();
      var _from = $("#from").val();

      var data = {
        username:username,
        password:password,
        module:module,
        from:_from
      };

      if(username == '' && password == '')
      {
          $(".form").addClass('animated bounce');
          $(".form").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
              $(this).removeClass('animated bounce');
          });
      }
      else if (username == '')
      {
          $("#username").addClass('animated shake');
          $("#username").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
              $(this).removeClass('animated shake');
          });
      }
      else if(password == '')
      {
          $("#password").addClass('animated shake');
          $("#password").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
              $(this).removeClass('animated shake');
          });
      }
      else 
      {

        $.post("../../LOGINPAGE/login-ui-check.php",data,function(result){ 

            userResult = result;
            logUser = userResult.split("-");

            if( result  != 0 ) {

              setTimeout(function(){
                $('.virtual-signin').html('<i id="gear"></i>')
              }, 0000);

              /* Check User-Data with Database and Display Result */
              setTimeout(function(){
                $('.virtual-signin').html('<span class="fa-unlock unlock"></span>')
              }, 2000);

              /* Sign-in successful Message */ 
              setTimeout(function(){
                $('.signin-form').addClass('animated fadeOut');
                $(".signin-form").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('animated fadeOut');
                });
                $('.signin-form').html('<h2 class="Successful">Welcome back '+logUser[1]+'</h2>');

              }, 2500);

              setTimeout(function(){
                var auth = {
                  username:username,
                  password:password,
                  module:module,
                  from:module
                };
                
                if( module == "PHARMACY" ) {
                  open("POST","../../Department/initializeDepartment.php",auth,"_self");
                }else if( module == "E.R" ) {
                  open("POST","../COCONUT/ER/erMainpage.php",{},"_self");
                }else if( module == "NURSING" ) {
                  open("POST","../COCONUT/NURSING/nursingMainpage.php",{},"_self");
                }else if( module == "PURCHASING" )  {
                  open("POST","../COCONUT/purchasing/purchasingMainpage.php",{},"_self");
                }else if( module == "MAINTENANCE" ) {
                  open("POST","../COCONUT/maintenance/initializeMaintenance.php",{module:'MAINTENANCE'},"_self");
                }else if( module == "ADMIN" ) {
                  open("POST","../COCONUT/ADMIN/initializeAdmin.php",{module:'ADMIN'},"_self");
                }else if( module == "BILLING" ) {
                  open("POST","../../Department/initializeDepartment.php",auth,"_self")
                }
                else {

                }

              },5000);


            }else {

              setTimeout(function(){
                $('.virtual-signin').html('<i id="gear"></i>')
              }, 0000);              

              setTimeout(function(){
                var html = '<label style="background:#377dd2;" class="fa fa-lock" for="signin"><span class="signin-label">Sign In</span></span><input type="button" id="signin">';
                $('.virtual-signin').html(html);
                $("#error").show();
                $("#username").val("");
                $("#password").val("");
              }, 7000); 

            }

        });


      }

  });
});