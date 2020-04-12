<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<input type="hidden" id="myArray" value="$WaterData">

<div class="title">
    <h1 class="purple-text">Dashboard</h1>
</div>


<div class="c-dashboard">
    <div class="c-dashboard__item">
        <div class="c-dashboard__header">
            <h1>$Test</h1>
            <h4><span class="dull-text">Last watered:</span> $LastWatered</h4>
            <h4><span class="dull-text">Auto watering set to:</span> $AutoWatering
<%--                <% if $AutoWatering %>--%>
<%--                ON--%>
<%--            <% else %>--%>
<%--                OFF--%>
<%--            <% end_if %>--%>
            </h4>
            <h4><span class="dull-text">Auto watering interval:</span> 48 HOURS, at 10pm</h4>
        </div>

        <div class="c-dashboard__panel">
            <p class="c-dashboard__panel-text">Water now</p>
            $WaterOnce
        </div>
        <div class="c-dashboard__panel">
            <p class="c-dashboard__panel-text">Toggle auto watering</p>
            $ToggleAutoBool
        </div>


    </div>

    <div class="c-dashboard__item chart" id="curve_chart" style="width: 900px; height: 500px"></div>
</div>




