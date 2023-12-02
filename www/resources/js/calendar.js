/* CALENDAR */
		  
function  init_calendar() {
					
    if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
    console.log('init_calendar');
        
    var date = new Date(),
        d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear(),
        started,
        categoryClass;

    var calendar = $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
      },
      selectable: true,
      selectHelper: true,
      eventClick: function(calEvent, jsEvent, view) {
        $('#fc_edit').click();
        $('#title2').val(calEvent.title);
        $('#descr2').val(calEvent.description);
        $('#start1').val(calEvent.start);
        $('#end1').val(calEvent.end);

        categoryClass = $("#event_type").val();

        $(".antosubmit2").on("click", function() {
          calEvent.title = $("#title2").val();

          calendar.fullCalendar('updateEvent', calEvent);
          $('.antoclose2').click();
        });

        calendar.fullCalendar('unselect');
      },
      editable: true,
      events: '../www/resources/inc/fetchBookings.inc.php',
    });
    
};

$(document).ready(function() {

    init_calendar();
            
});	