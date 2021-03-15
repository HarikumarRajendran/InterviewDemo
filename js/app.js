$(document).ready(function(e){

	$(".fetchBtn").on('click', function(){

        $('.success').removeClass('hide');

        $('.tableData').addClass('hide');

        $('.success').html('Loading...');

		$data = {
			'url':'http://nscript.net/chart.php',
            'fetchData':$("#fetchData").val()
		};

		$.ajax({
                type:'POST',
                url:'ajax/main.php',
                data:$data,
                success: function(data){
                    if(data){
                        $('.success').html('Success!!..');
                        setTimeout(function() { $('.success').addClass('hide'); }, 5000);
                    }
                
                }
        });
	});

    $(".viewData").on('click', function(){

        $('.success').html('Loading...');

        $data = {
            'viewData': $('#viewData').val()
        };

        $.ajax({
                type:'POST',
                url:'ajax/main.php',
                data:$data,
                success: function(data){
                    if(data){

                        $('.success').html('');

                        $TblDt = JSON.parse(data);

                        $('.tableData').removeClass('hide');

                        $("#bodyData").html('');
                        
                        $.each($TblDt, function(key, value){

                            $status = (value['status'] == '1' ? 'Active' : 'In-active');

                            $("#bodyData").append("<tr id='"+value['id']+"'><td>"+value['id']+"</td><td>"+value['open']+"</td><td>"+value['high']+"</td><td>"+value['low']+"</td><td>"+value['close']+"</td><td>"+value['volume']+"</td><td>"+value['created_at']+"</td><td>"+$status+"</td><td><button class='btn btn-primary' onclick='changeSts("+value['id']+");'>Change Status</button></td></tr>");

                        });

                    }
                }
        });
    });

    $('.chartData').on('click', function(){
        $('.tableData').addClass('hide');
        $.get( "http://nscript.net/chart.php", function( data ) {

            $dataDt = JSON.parse(data);

            var DtPrvdr = [];             

            $.each($dataDt['Time Series (1min)'], function(key,value){
                    
                DtPrvdr.push({ label: key, y: value['5. volume']});
            });
            $(".chartContainer").CanvasJSChart({
                title: {
                    text: "Chart Data"
                },
                axisY: {
                    title: "Volume Data",
                    includeZero: false
                },
                axisX: {
                    interval: 1
                },
                data: [
                {
                    type: "line", //try changing to column
                    dataPoints: [
                        DtPrvdr[0],
                        DtPrvdr[1],
                        DtPrvdr[2],
                        DtPrvdr[3],
                        DtPrvdr[4],
                        DtPrvdr[5],
                        DtPrvdr[6],
                        DtPrvdr[7],
                        DtPrvdr[8],
                        DtPrvdr[9]
                    ]
                }
                ]
            });
          
        });
    });

});

var changeSts = function(t){

    $data = {
            'id': t
        };

    $TdAct = '7';

    $.ajax({
                type:'POST',
                url:'ajax/main.php',
                data:$data,
                success: function(data){
                    if(data){

                       $TblDt = JSON.parse(data);

                       $Status = ($TblDt.status == '1' ? 'Active' : 'In-active');
                        
                        $('.tableData').find('tr#' + parseInt($TblDt.id)).find('td:eq(' + $TdAct + ')').html($Status);
                    }
                }
        });
}