<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
        <title>Dashboard Login</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        {{HTML::style('public/backend/assets/css/bootstrap.css')}}
        <!-- FONT AWESOME ICONS  -->
        {{HTML::style('public/backend/assets/css/font-awesome.css')}}
        <!-- CUSTOM STYLE  -->
        {{HTML::style('public/backend/assets/css/style.css')}}
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            
        </header>
        <!-- HEADER END-->
        
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line">Please Enter Your Email </h4>
                    </div>
                </div>
                <div class="row">
                        <form method="POST" action="{{route('admin.account.doforget') }}" accept-charset="UTF-8">
                                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

                                <div class="form-group">
                                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>
                                    <div class="input-append input-group">
                                        <input class="form-control" placeholder="{{{ \Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                                        <span class="input-group-btn">
                                            <input class="btn btn-default" type="submit" value="{{{ \Lang::get('confide::confide.forgot.submit') }}}">
                                        </span>
                                    </div>
                                </div>

                                @if (Session::get('error'))
                                    <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
                                @endif

                                @if (Session::get('notice'))
                                    <div class="alert">{{{ Session::get('notice') }}}</div>
                                @endif
                            </form>


                </div>
            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        &copy; 2015 YourCompany | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY SCRIPTS -->
        {{HTML::script('public/backend/assets/js/jquery-1.11.1.js')}}
        <!-- BOOTSTRAP SCRIPTS  -->
        {{HTML::script('public/backend/assets/js/bootstrap.js')}}
        <!-- ALERTIFY -->

        <script type="text/javascript">
                {{Notification::showSuccess('alertify.success(":message");') }}
                {{Notification::showError('alertify.error(":message");') }}
        </script>
    </body>
</html>