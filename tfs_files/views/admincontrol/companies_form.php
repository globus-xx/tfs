<script type="text/javascript" src="<?=base_url();?>ckeditor/ckeditor.js"></script>



     <section id="content">
    <div id="tabs">
       
  <ul>
    <li><a href="#tabs-companyData">ملف الشركة </a></li>
    <li><a href="#tabs-share">هيكل الملكية</a></li>
    <li><a href="#tabs-newsAndArticles">الأخبار والإفصاحات</a></li>
    <li><a href="#tabs-events">  أحداث الشركة </a></li>
    <li><a href="#tabs-results">  النتائج المالية  </a></li>
    
  
  </ul>
  <div id="tabs-companyData">
	<?php include 'company/companyData.php'?>

					
		
  </div>
           
  <div id="tabs-share">
    <?php include 'company/companyShare.php'?>
  </div>
  <div id="tabs-newsAndArticles">
     <?php include 'company/companyNewsAndArticles.php'?>
  </div>
  <div id="tabs-events">
     <?php include 'company/companyCorpActions.php'?>
  </div> 
  
 <div id="tabs-results">
     <?php include 'company/companyResults.php'?>
  </div>        

              </section>       
		



  		 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
 <script>
  $(function() {
    $( "#tabs" ).tabs();
            $( "#txt_establishing_date" ).datepicker({
             altField: "#txt_establishing_date",
             altFormat: "yy-mm-d",
             dateFormat: "dd-mm-yy"
           });
           
            $( "#txt_registered_date" ).datepicker({
             altField: "#txt_registered_date",
             altFormat: "yy-mm-d",
             dateFormat: "dd-mm-yy"
           }); 
           
            $( "#txt_first_trading_day" ).datepicker({
             altField: "#txt_registered_date",
             altFormat: "yy-mm-dd",
             dateFormat: "dd-mm-yy"
           });
           loadYearDDValues('financialReportYear', 2010);
           loadYearDDValues('financialReportYear_1', null);
/*
 * 
 */
        function loadYearDDValues(selectID, selectedValue){
            for (i = new Date().getFullYear(); i > 2000; i--)
            {
                if( selectedValue!= null && selectedValue == i)
                    $('#'+selectID).append($('<option />').val(i).attr('selected', 'selected').html(i));
                else 
                    $('#'+selectID).append($('<option />').val(i).html(i));
            }
         }  
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'هيكل الملكية حسب آخر جلسة تداول'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]
            }]
        });
    
    
    });

  
hideDiv('companyShare_form')// hide the company share add forom on the page load
  
  function hideDiv(divID){

    if($("#"+divID).is(":visible")) 
       $("#"+divID).hide()
    else
        $("#"+divID).show()
}
 function addBoardMemberFilelds(){
     
       var id =$("#bmemberDiv").children('input').length/2+1;
       
       var content = '<div>&nbsp; '
       content += '<input  placeholder="Name '+id+'" name="bordmemberName_'+id+'" id="bordmemberDesignation_'+id+'" type="text" style=" width: 40% !important" />'
       content += '& <input  placeholder="Designation '+id+'" name="bordmemberName_'+id+'" id="bordmemberDesignation'+id+'"" type="text"  style=" width: 40% !important" />'
        content += '</div>'
    
    $("#bmemberDiv").append(content);
 
 }
 
  function addShareFields(){
     
       var id =$("#bshareDiv").children('input').length/3+1;
      
       var content = '<div>&nbsp;'
        content += ' <input  placeholder="Company Name" name="companyName" id="companyName_'+id+'"" type="text"  style=" width: 30% !important" />'
           content += ' | <input  placeholder="Country '+id+'"" name="bordmemberCountry_'+id+'"" id="bordmemberCountry_'+id+'"" type="text"    style=" width: 30% !important" />'
           content += '  | <input  placeholder="Share '+id+'"" name="share_'+id+'"" id="share_'+id+'"" type="text"    style=" width: 30% !important" />'
              content += '            </div>'
       $("#bshareDiv").append(content);
 
 }
  
  </script>