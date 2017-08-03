<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <base href="<?php echo base_url(); ?>"
    <meta charset="utf-8" />
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="assets/backend/img/favicon.ico" type="image/x-icon" />
    <link href="assets/backend/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/backend/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="assets/backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/backend/css/style.css" rel="stylesheet" />
    <link href="assets/backend/css/style-responsive.css" rel="stylesheet" />
    <link href="assets/backend/css/style-default.css" rel="stylesheet" id="style_color" />
    <style>
        td {
    display: inline-block;
    font-size: 18px;
    vertical-align: middle;
    }
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="">
            <img class="center" alt="logo" src="assets/backend/img/logo.png" width="250">
        </a>
        <!-- END LOGO -->
        <br><p style="font-size: 25px; color: rgb(255, 255, 255); font-weight: bold; margin-top: 27px; line-height: 35px;">" And know that i am with you always; yes to the end of time. "<br>- Jesus Christ</p>
    </div>
    <?php
    //$security_q=$this->db->select('security_q')->get('settings')->row()->security_q;
    ?>
    <div class="login-wrap" style="margin: 3% 24%;">
        <?php if($this->session->flashdata('error')) { ?>
        <div class="alert alert-error" style="margin: 0px 10px 10px 0px;width: 70%;">
            <strong>Error!</strong> <?php  echo $this->session->flashdata('error'); ?>
        </div>
        <?php  } ?>
        <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success" style="margin: 0px 10px 10px 0px;width: 70%;">
            <strong>success!</strong> <?php  echo $this->session->flashdata('success'); ?>
        </div>
        <?php  } ?>
        <form action="login/sub_forgotpass" method="post" name="f1">
            <div class="metro single-size sehion">
                <div class="locked">
                    <i class="icon-lock"></i>
                    <span>Forgot password</span>
                </div>
            </div>
            <div class="metro sehion">
                <div class="input-append lock-input">
                    
                    <!-- <table width="100%" cellpadding="2">
                        <tr>
                            <td align="right">
                                <input type="radio" name="role" checked value="national" id="role_1">
                            </td>
                            <td align="left">National</td>
                            <td align="right"><input type="radio" name="role" value="zone" id="role_2"></td>
                            <td align="left">Zone</td>
                            <td align="right"><input type="radio" name="role" value="state" id="role_3"></td>
                            <td align="left">State
                                <td align="right"><input type="radio" name="role" value="state_zone" id="role_3"></td>
                                <td align="left">State Zone
                                    <td align="right"><input type="radio" name="role" value="Distributer" id="role_3"></td>
                                    <td align="left">Distributer
                                    </td>
                                </tr>
                            </table>-->
                        </div>
                        <div class="input-append lock-input" style="margin-top: 7%;">
                            <input type="text" name="user_name" id="user_name" autocomplete="off"  placeholder="Email" required/>
                             <br>
                            <div class="col-lg-6 col-md-6 col-lg-offset-3">
                                Back to Login <a href="<?php echo base_url('front_login/form');?>">Click here</a>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    
                    <div class="metro single-size sehion login">
                        <button type="submit" name="submit" class="btn login-btn">
                        Submit
                        <i class=" icon-long-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </body>
        <!-- END BODY -->
    </html>