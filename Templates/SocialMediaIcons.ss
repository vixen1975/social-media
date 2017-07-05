<a href="<% if IconClass = email || IconClass = envelope %>mailto:$Url<% else_if IconClass = phone || IconClass = mobile %>tel:$Url<% else %>$Url<% end_if %>" target="_blank" title="<% if IconClass = email || IconClass = envelope %>Email us<% else_if IconClass = phone || IconClass = mobile %>Call us <% else %>Follow us on $Title<% end_if %>" class="$ColourScheme">
<span class="sm-icon icon-{$IconClass}"></span> 
  <% if ShowTitle %><span class="sm-text">$Title</span><% end_if %>
</a>

