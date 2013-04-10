
<div id="tabs" style="width: 330px;float: left">
  <ul>
    <li><a href="#tabs-1">Nunc </a></li>
    <li><a href="#tabs-2">Proin </a></li>
    <li><a href="#tabs-3">Aenean </a></li>
  </ul>
  <div id="tabs-1">
      <div id="container" style="height: 250px; min-width: 200px" dir="ltr"></div>
  </div>
  <div id="tabs-2">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. </p>
  </div>
  <div id="tabs-3">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. .</p>
    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. </p>
  </div>
</div>
<script type="text/javascript">
$(function() {
       
         //j coded here
        
        $.ajax({ 
                        type: "POST",
                        url:'http://localhost/tfs/rates', 
//                        url:'http://globus.ae/beta/tfs/rates', 
//                        data: values,//"customerID="+customerID+"&deedID="+deedID+"&Share="+share,
                        success: function(data) 
                        {    
    data=  JSON.parse(data)
//alert("data"+data)
           		window.chart = new Highcharts.StockChart({
			chart : {
				renderTo : 'container'
			},

                        rangeSelector : {
				buttons : [{
					type : 'hour',
					count : 1,
					text : '1h'
				}, {
					type : 'day',
					count : 1,
					text : '1D'
				}, {
					type : 'all',
					count : 1,
					text : 'All'
				}],
				selected : 0,
				inputEnabled : false
                            },
                       scrollbar: {
                                          enabled: false
                            },
//                            navigator : {
//				enabled : false
//			},
//			title : {
//				text : 'AAPL Stock Price'
//			},

                    
                    	series : [{
				name : 'Value',
				type: 'area',
				data : data,
				gapSize: 5,
				tooltip: {
					valueDecimals: 2
				},
                        }],
                    fillColor : {
					linearGradient : {
						x1: 0, 
						y1: 0, 
						x2: 0, 
						y2: 1
					},
					stops : [[0, Highcharts.getOptions().colors[0]], [1, 'rgba(0,0,0,0)']]
				},
				threshold: null
		});

        },
        cache: false
    });

});

		</script>
<script src="http://code.highcharts.com/stock/highstock.js"></script>

