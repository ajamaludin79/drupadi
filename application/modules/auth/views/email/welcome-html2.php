<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <head><title>Welcome to <?php echo $site_name; ?>!</title></head>
        <meta name="viewport" content="width=device-width" />
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #e67e22; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#2A3F54" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <!--<tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" style="color: #aaaaaa; font-family: Arial, sans-serif; font-size: 12px;">
                                Email not displaying correctly?  <a href="#" style="color: #e67e22;">View it in your browser</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>-->
            <tr>
                <td align="center" bgcolor="#6489a8" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 26px; font-weight: bold;">
                    <img src="<?php echo base_url('assets/images/logo.png');?>" alt="<?php echo $this->config->item('nickname','tank_auth');?>" width="90" style="display:block;" />
                    <?php echo $this->config->item('company_name','tank_auth');?>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 19px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
						<b>Welcome to <?php echo $site_name; ?></b><br/>
						Thanks for joining <?php echo ucwords($first_name); ?>. We listed your sign in details below, make sure you keep them safe.<br/>
					<br />						
						<span>To open your <?php echo $site_name; ?> homepage, please follow this link:</span>
					<br />
						<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/login/'); ?>" style="color: #3366cc;">Go to <?php echo $site_name; ?> now!</a></b></big><br />
					<br />
							Link doesn't work? Copy the following link to your browser address bar:<br />
						<nobr><a href="<?php echo site_url('/auth/login/'); ?>" style="color: #3366cc;"><?php echo site_url('/auth/login/'); ?></a></nobr>					
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                    Your username : <b><?php echo $username; ?></b><br/>
                    Your email address : <b><?php echo $email; ?></b>
                </td>
            </tr> 
                       
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
                    <table bgcolor="#e67e22" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;">Have fun!<br />The <?php echo $site_name; ?> Team</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b><?php echo $this->config->item('company_name','tank_auth');?></b><br/><?php echo $this->config->item('company_address','tank_auth');?>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                ©<?php echo date('Y');?> Hak Cipta Terpelihara <a href="http://eidaramata.com/" style="color: #e67e22;"><?php echo $this->config->item('company_name', 'tank_auth');?></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>