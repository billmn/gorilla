<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="initial-scale=1.0">    <!-- So that mobile webkit will display zoomed in -->
	<meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->

	<title>Forgot password</title>
	<style type="text/css">

		/* Resets: see reset.css for details */
		.ReadMsgBody { width: 100%; background-color: #ebebeb;}
		.ExternalClass {width: 100%; background-color: #ebebeb;}
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
		body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
		body {margin:0; padding:0;}
		table {border-spacing:0;}
		table td {border-collapse:collapse;}
		.yshortcuts a {border-bottom: none !important;}

		/* Constrain email width for small screens */
		@media screen and (max-width: 600px) {
			table[class="container"] {
				width: 95% !important;
			}
		}

		/* Give content more room on mobile */
		@media screen and (max-width: 480px) {
			td[class="container-padding"] {
				padding-left: 12px !important;
				padding-right: 12px !important;
			}
		}

	</style>
</head>
<body style="margin:0; padding:10px 0;" bgcolor="#ebebeb" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<br>

	<!-- 100% wrapper (grey background) -->
	<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#ebebeb">
		<tr>
			<td align="center" valign="top" bgcolor="#ebebeb" style="background-color: #ebebeb;">

				<!-- 600px container (white background) -->
				<table border="0" width="600" cellpadding="0" cellspacing="0" class="container" bgcolor="#ffffff">
					<tr>
						<td class="container-padding" bgcolor="#ffffff" style="background-color: #ffffff; padding-left: 30px; padding-right: 30px; font-size: 14px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;">
							<br>

							<div style="font-weight: bold; font-size: 38px; line-height: 24px; color: #666666; border-bottom: 1px solid #efefef; margin-bottom: 20px;">
								{{ strtolower(Lang::get('gorilla.app_name')) }}
							</div>

							<!-- ### BEGIN CONTENT ### -->
							<div style="font-weight: bold; font-size: 18px; line-height: 24px; color: #D03C0F">
								@lang('gorilla.auth.forgot.email.title')
							</div><br>

							@lang('gorilla.auth.forgot.email.body', array('username' => $user->username, 'domain' => Input::server('SERVER_NAME')))

							<br><br>

							<a href="{{ URL::route('reset', array('token' => $token)) }}" style="color: #ffffff; padding: 8px 12px; background: #399adb; text-decoration: none; text-align: center;">
								@lang('gorilla.auth.forgot.email.btn')
							</a>

							<br><br>

							<!-- ### END CONTENT ### -->

						</td>
					</tr>
				</table>
				<!--/600px container -->

			</td>
		</tr>
	</table>
	<!--/100% wrapper-->
	<br>
	<br>
</body>
</html>