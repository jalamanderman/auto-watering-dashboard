<li class="menu__item menu__item--{$LinkingMode} menu__item--{$FirstLast}<% if Children %> menu__item--has-children <% if $LinkingMode == 'section' || $LinkingMode == 'current' %>menu__item--expanded<% end_if %><% end_if %>">

	<a class="menu__item__link" href="$Link" accesskey="$Pos">
		$MenuTitle.XML
	</a>

	<% if Children %>

		<i class="fas fa-caret-right menu__submenu__toggle"></i>

		<ul class="menu__item__submenu menu__submenu">
			<% loop Children %>
				<% include MenuItem %>
			<% end_loop %>
		</ul>

	<% end_if %>

</li>
