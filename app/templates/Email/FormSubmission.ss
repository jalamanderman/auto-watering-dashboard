<html>
<body style="background: #EEEEEE;">
	<div style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
		<div style="max-width: 550px; margin: 0 auto; background: #FFFFFF; border-top: 20px solid #EEEEEE; border-bottom: 20px solid #EEEEEE;">

			<div style="border-top: 30px solid #FFFFFF; text-align: center;">
				<a href="{$Submission.AbsoluteDomain}" style="border: 0; text-decoration: none;">
					<img src="{$Submission.SiteConfig.Logo.AbsoluteLink}" title="Logo" />
				</a>
			</div>

			<div style="border: 30px solid #FFFFFF;">

				<div style="font-size: 18px; font-weight: bold; border-bottom: 20px solid #FFFFFF; color: #555555;">
					Form submission received
				</div>

				<div style="border-bottom: 20px solid #FFFFFF;">
					A submission has been received from the website. See below for the details submitted.
				</div>

				<table cellpadding="5" cellspacing="0" border="0" bgcolor="#FFFFFF" style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
					<% loop Payload %>
						<tr>
							<td style="vertical-align: top;" width="30%">
								<strong>{$Name}:</strong>
							</td>
							<td>
								$Value
							</td>
						</tr>
					<% end_loop %>
				</table>

			</div>

		</div>

		<div style="width: 550px; margin: 0 auto; color: #BBBBBB; border-bottom: 20px solid #EEEEEE; text-align: center; font-size: 11px;">
			Sent at $Submission.Created from $Submission.Origin.AbsoluteLink<br />
			Submission $Submission.ID
		</div>

	</div>
</body>
</html>
