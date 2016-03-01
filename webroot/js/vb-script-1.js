
//hide sections

$(document).ready(function(){
 $('show-edit-section').hide();
 
 $('view-edit-btn').on('click', function(){
     $('show-rest-section').css('display','none');
     $('show-edit-section').css('display','block');
     
 });
 $('.file-control').on('change', function(){
     $('.spinner').show();
     var data = new FormData($('input[name="file-upload"]'));     
      jQuery.each($('input[name="file-upload"]')[0].files, function(i, file) {
    data.append(i, file);
});
        //alert(data);
     $.ajax({
        url: "/upload", 
        type:"POST",
        data: data,
        contentType: false,
        cache: false,
        processData:false, 
        success: function(result, jqXHR, textStatus){
            $('.spinner').hide();
            if(result){
            $("#logo").attr('src',result);
           }else{
            alert('Error..!image Not Upload');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
        }});
//$("#logo").attr('src','/img/index.png');
    //alert('problem occured');
 });
 $('.view-stat-btn').on('click', function(){
     var restId = (this).getOwnPropertyNames('value');
     alert(restId);
        FusionCharts.ready(function () {
        var revenueChart = new FusionCharts({
        type: 'column2d',
        renderAt: 'sales-history-graph',
        width: '550',
        height: '350',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Monthly sales history for last year",
                "subCaption": "Restaurant Name",
                "xAxisName": "Month",
                "yAxisName": "sales (In Rupee)",
                "numberPrefix": "₹",
                "paletteColors": "#0075c2",
                "bgColor": "#ffffff",
                "borderAlpha": "20",
                "canvasBorderAlpha": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placevaluesInside": "1",
                "rotatevalues": "1",
                "valueFontColor": "#ffffff",                
                "showXAxisLine": "1",
                "xAxisLineColor": "#999999",
                "divlineColor": "#999999",               
                "divLineIsDashed": "1",
                "showAlternateHGridColor": "0",
                "subcaptionFontBold": "0",
                "subcaptionFontSize": "14"
            },            
            "data": [
                {
                    "label": "Jan",
                    "value": "420000"
                }, 
                {
                    "label": "Feb",
                    "value": "810000"
                }, 
                {
                    "label": "Mar",
                    "value": "720000"
                }, 
                {
                    "label": "Apr",
                    "value": "550000"
                }, 
                {
                    "label": "May",
                    "value": "910000"
                }, 
                {
                    "label": "Jun",
                    "value": "510000"
                }, 
                {
                    "label": "Jul",
                    "value": "680000"
                }, 
                {
                    "label": "Aug",
                    "value": "620000"
                }, 
                {
                    "label": "Sep",
                    "value": "610000"
                }, 
                {
                    "label": "Oct",
                    "value": "490000"
                }, 
                {
                    "label": "Nov",
                    "value": "900000"
                }, 
                {
                    "label": "Dec",
                    "value": "730000"
                }
            ],
            "trendlines": [
                {
                    "line": [
                        {
                            "startvalue": "700000",
                            "color": "#1aaf5d",
                            "valueOnRight": "1",
                            "displayvalue": "Monthly Target"
                        }
                    ]
                }
            ]
        }
    }).render();
  });
});   
});
