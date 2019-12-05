<?php
?>


    <script type='text/javascript'>
(function($){

    var eventsObj={};
    @if (!empty($events) && count($events) > 0)
    var eventsObj = {!! $eventsJSON !!};

    
    $.each(eventsObj,function(i){
        //console.log(this.id+ ': '+ this.event_date);
    });

@endif

    function showEvents(events){

        var month = parseInt($('.cal-title').attr('data-month'))+1;
        var year =  $('.cal-title').attr('data-year');
console.log(month/9);
        cal_year_month = year+'-'+ (month/9 >=1 ? month: '0'+month);
        var event_y_m;
        var event_day;

        $.each(events,function(i){
            event_y_m = this.event_date.substr(0,7);
            console.log(event_y_m+' '+cal_year_month);
            if(cal_year_month === this.event_date.substr(0,7)){
                event_day = parseInt(this.event_date.substr(8, 2));
                console.log(event_day);
                $('#day'+event_day).append($('<p>').text(this.event))
            }
        });
    }



    function generateCalendar(year, month){
        var cal= $('#calendar');
        var date = new Date(year, month, 1);
        
        $('.cal-title').attr('data-year', year);
        $('.cal-title').attr('data-month',month);
        var dayTitle = date.toString().substr(4,3)+' '+year;
        $('.cal-title').text(dayTitle);
        $('tr',cal).not(":first").remove();
        //cal.before($('<h3>'+dayTitle+'</h3>'));
        
        var monthObj = {};
        monthObj.firstday = 1;
        monthObj.lastMonDate = new Date(year, month+1, 0);
        monthObj.firstMonDate = new Date(year, month, 1);
        monthObj.firstMonDateDay = monthObj.firstMonDate.getDay();
        monthObj.lastMonDateDate = monthObj.lastMonDate.getDate();
        //console.log(monthObj.lastDate+' '+monthObj.lastDate.getMonth()+monthObj.lastday);

        /*
        var calStr= '<tr>';
        for(var start = 1; start++; start<monthObj.firstMonDateDay){
            calStr +='<td>'+'</td>';
        }
        */
        var calStr = '<tr>';
        var dayInMonth = 0 - monthObj.firstMonDateDay+1;

        for( var i = 1; dayInMonth<=monthObj.lastMonDateDate; i++, dayInMonth++){
           
            if(dayInMonth<1){ //i<=monthObj.firstMonDateDay
                calStr+='<td></td>';
            }else{
                calStr+='<td id='+'"day'+dayInMonth+'"'+'>'+dayInMonth+'</td>';
            }
            if(i%7===0){
                calStr+= '</tr>';
                if(dayInMonth !== monthObj.lastMonDateDate){
                    calStr+= '<tr>';
                }
            }
            
            var remain = i%7;
            if(dayInMonth === monthObj.lastMonDateDate && remain!==0){
                for(var k = remain; k<7; k++){
                    calStr+='<td></td>';
                }
                calStr+='</tr>';
            }
            if(dayInMonth === monthObj.lastMonDateDate){

            }
        }

            $(calStr).appendTo(cal);

            showEvents(eventsObj);
    } 

    if($('#calendar').length===0) return;
    var cal= $('#calendar');

    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth();
    var day = today.getDay();

    console.log(today);
    console.log(year+' '+ month+' '+day);

    generateCalendar(year, month);

    var el_cal_title= $('.cal-title');
    $('.cal-prev').click(function(){
        var month = parseInt(el_cal_title.attr('data-month'));
        var year =  parseInt(el_cal_title.attr('data-year'));
        //$('.cal-title').data('month', month-1);

        month--;

        var date = convertTime(year, month);
        console.log(date);

        el_cal_title.attr('data-month',date.month);
        el_cal_title.attr('data-year',date.year);

        generateCalendar(date.year, date.month);

        console.log( $('.cal-title').attr('data-month'));
        
        var dateObj = new Date(year,month,1)
        el_cal_title.text(dateObj.toString().substr(4,3)+' '+date.year);
    });
    $('.cal-next').click(function(){
        var month = parseInt(el_cal_title.attr('data-month'));
        var year =  parseInt(el_cal_title.attr('data-year'));
        //console.log(typeof month);
        month++;
        var date = convertTime(year, month);
        console.log(date);
        el_cal_title.attr('data-month',date.month);
        el_cal_title.attr('data-year',date.year);
        console.log($('.cal-title').attr('data-month'));

        generateCalendar(date.year, date.month);

        var dateObj = new Date(year,month,1)
        el_cal_title.text(dateObj.toString().substr(4,3)+' '+year);
    });

    function convertTime(year, month){
        var date = {
                    month: month,
                    year : year
                    };

        if(month<0){
            date = {
                month: (month)%11+12,
                year: year-Math.floor((11-month)/11)
            }
        }else if(month>11){
            date = {   
                    month: month%11-1,
                    year: year + Math.floor(month/11)
                   };
        }

        return date;
    }


  
    //console.log($('td',cal));
    //console.log(cal.children('td:first'));
    //$(cal).find('td:first').css({'height': '70px'});
    //$('td',cal).css({'width':'70px', 'height': '70px'});

    $('tr th',cal).addClass('');




})(jQuery);

</script>