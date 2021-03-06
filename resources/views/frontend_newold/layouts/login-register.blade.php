
<!-- Login form -->
<style>
    /*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
 
/*  Shake animation  */

@charset "UTF-8";

.animated {
  -webkit-animation-duration: 1s;
	   -moz-animation-duration: 1s;
	     -o-animation-duration: 1s;
	        animation-duration: 1s;
	-webkit-animation-fill-mode: both;
	   -moz-animation-fill-mode: both;
	     -o-animation-fill-mode: both;
	        animation-fill-mode: both;
}

.animated.hinges {
	-webkit-animation-duration: 2s;
	   -moz-animation-duration: 2s;
	     -o-animation-duration: 2s;
	        animation-duration: 2s;
}

.animated.slow {
	-webkit-animation-duration: 3s;
	   -moz-animation-duration: 3s;
	     -o-animation-duration: 3s;
	        animation-duration: 3s;
}

.animated.snail {
	-webkit-animation-duration: 4s;
	   -moz-animation-duration: 4s;
	     -o-animation-duration: 4s;
	        animation-duration: 4s;
}

@-webkit-keyframes shake {
	0%, 100% {-webkit-transform: translateX(0);}
	10%, 30%, 50%, 70%, 90% {-webkit-transform: translateX(-10px);}
	20%, 40%, 60%, 80% {-webkit-transform: translateX(10px);}
}

@-moz-keyframes shake {
	0%, 100% {-moz-transform: translateX(0);}
	10%, 30%, 50%, 70%, 90% {-moz-transform: translateX(-10px);}
	20%, 40%, 60%, 80% {-moz-transform: translateX(10px);}
}

@-o-keyframes shake {
	0%, 100% {-o-transform: translateX(0);}
	10%, 30%, 50%, 70%, 90% {-o-transform: translateX(-10px);}
	20%, 40%, 60%, 80% {-o-transform: translateX(10px);}
}

@keyframes shake {
	0%, 100% {transform: translateX(0);}
	10%, 30%, 50%, 70%, 90% {transform: translateX(-10px);}
	20%, 40%, 60%, 80% {transform: translateX(10px);}
}

.shake {
	-webkit-animation-name: shake;
	-moz-animation-name: shake;
	-o-animation-name: shake;
	animation-name: shake;
}

.login .modal-dialog{
    width: 350px;
}
.login .modal-footer{
    border-top: 0;
    margin-top: 0px;
    padding: 10px 20px 20px;
}
.login .modal-header {
    border: 0 none;
    padding: 15px 15px 15px;
/*     padding: 11px 15px; */
}
.login .modal-body{
/*     background-color: #eeeeee; */
}
.login .division {
    float: none;
    margin: 0 auto 18px;
    overflow: hidden;
    position: relative;
    text-align: center;
    width: 100%;
}
.login .division .line {
    border-top: 1px solid #DFDFDF;
    position: absolute;
    top: 10px;
    width: 34%;
}
.login .division .line.l {
    left: 0;
}
.login .division .line.r {
    right: 0;
}
.login .division span {
    color: #424242;
    font-size: 17px;
}
.login .box .social {
    float: none;
    margin: 0 auto 30px;
    text-align: center;
}

.login .social .circle{
    background-color: #EEEEEE;
    color: #FFFFFF;
    border-radius: 100px;
    display: inline-block;
    margin: 0 17px;
    padding: 15px;
}
.login .social .circle .fa{
    font-size: 16px;
}
.login .social .facebook{
    background-color: #455CA8;
    color: #FFFFFF;
}
.login .social .google{
    background-color: #F74933;
}
.login .social .github{
    background-color: #403A3A;
}
.login .facebook:hover{
    background-color: #6E83CD;
}
.login .google:hover{
    background-color: #FF7566;
}
.login .github:hover{
    background-color: #4D4D4d;;
}
.login .forgot {
    color: #797979;
    margin-left: 0;
    overflow: hidden;
    text-align: center;
    width: 100%;
}
.login .btn-login, .registerBox .btn-register{
    background-color: #00626e!important;
    border-color: #00626e!important;
    border-radius: 12px!important;
    border-width: 0;
    color: #FFFFFF;
    display: block;
    margin: 0 auto;
    padding: 15px 50px;
    text-transform: uppercase;
    width: 100%;
}
.login .btn-login:hover, .registerBox .btn-register:hover{
    background-color: #00626e!important;
    color: #FFFFFF;
}
.login-footer a, .register-footer a{
    color: #bea449;
}
.login .form-control{    
  background-color: transparent!important;
  border: 1px solid #e0e0e0!important;
  box-shadow: 0 1px 0px 0px rgb(0 0 0 / 9%) inset;
  color: #616161;
  border-radius: 12px!important;
}
.login .division span{
  text-transform: uppercase;
  font-weight: 700;
}
.login .division .line{
  width: 23%!important;
}
.login .form-control:hover{
    background-color: rgba(0,0,0,.16);
}
.login .form-control:focus{
    box-shadow: 0 1px 0 0 rgba(0, 0, 0, 0.04) inset;
    background-color: rgba(0,0,0,0.23);
    color: #FFFFFF;
}
.login .box .form input[type="text"], .login .box .form input[type="password"] {
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
    width: 100%;
}


@media (max-width:400px){
    .login .modal-dialog{
        width: 100%;
    }
}

.big-login, .big-register{
    background-color: #00bbff;
    color: #FFFFFF;
    border-radius: 7px;
    border-width: 2px;
    font-size: 14px;
    font-style: normal;
    font-weight: 200;
    padding: 16px 60px;
    text-transform: uppercase;
    transition: all 0.3s ease 0s;
}
.big-login:hover{
    background-color: #00A4E4;
    color: #FFFFFF;
}
.big-register{
    background-color: rgba(0,0,0,.0);
    color: #00bbff;
    border-color: #00bbff;
}
.big-register:hover{
    border-color: #00A4E4;
    color:  #00A4E4;
}
</style>
<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Login with</h4>
          </div>
          <div class="modal-body">
              <div class="box">
                   <div class="content">
                      {{-- <div class="social">
                          <a class="circle github" href="#">
                              <i class="fas fa-github fa-fw"></i>
                          </a>
                          <a id="google_login" class="circle google" href="#">
                              <i class="fas fa-google-plus"></i>
                          </a>
                          <a id="facebook_login" class="circle facebook" href="#">
                              <i class="fas fa-facebook fa-fw"></i>
                          </a>
                      </div> --}}
                      <div class="division">
                          <div class="line l"></div>
                            <span>Royaletouche</span>
                          <div class="line r"></div>
                      </div>
                      <div class="error"></div>
                      <div class="form loginBox">
                          <form class="login_form" method="POST" action="{{ @route('login.submit') }}" >
                            @csrf
                            <input type="hidden" name="popup" value="1">
                            <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                            <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                            <input class="btn btn-default btn-login" type="submit" value="Login">
                          </form>
                      </div>
                   </div>
              </div>
              <div class="box">
                  <div class="content registerBox" style="display:none;">
                   <div class="form">
                      <form method="POST" action="{{ @route('register.form') }}">
                        @csrf
                        <input type="text" class="form-control"  name="name" id="name" placeholder="Please enter your name" required>
                        <input id="email" class="form-control" type="text" placeholder="john.doe@gmail.com" name="email" required>
                        <input class="form-control" type="text" placeholder="Please enter mobile" name="mobile" required>
                        <input id="password" class="form-control" type="password" placeholder="Password" name="password" required>
                        <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation" required>
                        
                        <input class="btn btn-default btn-register" type="submit" value="Create account">
                        
                        <input type="hidden" name="popup" value="1">

                    
                    </form>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <div class="forgot login-footer">
                  <span>Looking to
                       <a href="javascript: showRegisterForm();">create an account</a>
                  ?</span>
              </div>
              <div class="forgot register-footer" style="display:none">
                   <span>Already have an account?</span>
                   <a href="javascript: showLoginForm();">Login</a>
              </div>
          </div>
        </div>
    </div>
</div>
  
  <!-- Login form-end -->



  <script>

      /*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){
    /*   Remove this comments when moving to server
    $.post( "/login", function( data ) {
            if(data == 1){
                window.location.replace("/home");            
            } else {
                 shakeModal(); 
            }
        });
    */

/*   Simulate error message from the server   */
     shakeModal();
}

function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

   

  </script>