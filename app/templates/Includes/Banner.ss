<div class="page-banner<% if not $BannerImage %> page-banner--no-image<% end_if %> responsive"
    <% if $BannerImage %>
        <% loop $BannerImage %>
        style="background-image: url('{$ScaleWidth(100).Link}');" 
        data-sizes='[
            {
                "max": 500,
                "url": "{$ScaleWidth(500).Link}"
            },
            {
                "max": 800,
                "url": "{$ScaleWidth(800).Link}"
            },
            {
                "max": 1200,
                "url": "{$ScaleWidth(1200).Link}"
            },
            {
                "url": "{$ScaleWidth(1900).Link}"
            }
        ]'
        <% end_loop %>
    <% end_if %>
    >
    <div class="page-banner__inner">
        <h1>Banner Heading</h1>
        <p>Banner Text lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum sem mi, sit amet iaculis dui ornare eget. In libero nisi, volutpat a vehicula eget, suscipit id urna. Vestibulum metus massa, porta quis scelerisque vel, ultrices et est. Morbi suscipit sem ornare cursus tincidunt. Mauris commodo odio mi, ut porttitor diam aliquet vel. Morbi efficitur, justo nec scelerisque dapibus, nunc leo ornare metus, sit amet suscipit libero urna at leo.</p>
    </div>
</div>