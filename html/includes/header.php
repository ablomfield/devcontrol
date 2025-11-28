				<div id="header">
					<!-- Logo -->
					<h1><a href="/"><img height="75px" src="/images/icononly_transparent_nobuffer.png" alt="<?php echo ($sitetitle); ?>"></a>&nbsp;&nbsp;&nbsp;<a href="/" id="logo"><?php echo ($sitetitle); ?></a></h1>
					<!-- Nav -->
					<?php
					if ($loggedin) {
						echo ("					<nav id=\"nav\">\n");
						echo ("					  <ul>\n");
						echo ("					    <li");
						if ($sitesec == "home") {
							echo (" class=\"current\"");
						}
						echo ("><a href=\"/\">Home</a></li>\n");
						if ($isadmin) {
							echo ("					    <li");
							if ($sitesec == "admin") {
								echo (" class=\"current\"");
							}
							echo ("><a href=\"#\">Admin</a>\n");
							echo ("					      <ul>\n");
							echo ("					        <li><a href=\"/admin/domains/\">Domains</a></li>\n");
							echo ("					        <li><a href=\"/admin/history/\">History</a></li>\n");
							echo ("					        <li><a href=\"/admin/settings/\">Settings</a></li>\n");
							echo ("					        <li><a href=\"/admin/tools/\">Tools</a></li>\n");
							echo ("					        <li><a href=\"/admin/users/\">Users</a></li>\n");
							echo ("					      </ul>\n");
							echo ("					    </li>\n");
						}
						echo ("					    <li");
						if ($sitesec == "preferences") {
							echo (" class=\"current\"");
						}
						echo ("><a href=\"/preferences/\">Preferences</a></li>\n");
						echo ("					    <li><a href=\"/logout/\">Logout</a></li>\n");
						echo ("					  </ul>\n");
						echo ("					</nav>\n");
						if ($orgname != "") {
							echo ("<div class=\"row aln-right\">\n");
							echo ("<h3>Customer: " . $orgname . "<h3>\n");
							echo ("</div>\n");
						}
					}
					?>
				</div>