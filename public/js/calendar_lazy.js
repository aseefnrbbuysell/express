(function($){'use strict';$(document).ready(function(){var AJAX=null;var selectedEvent;$('#myCalendar').pagescalendar({now:"2015-11-23",onViewRenderComplete:function(range){var start=range.start.format();var end=range.end.format();if($("body").hasClass('pending')){return;}
$.ajax({type:"GET",url:"http://revox.io/json/events.json",data:"",success:function(data){$("#myCalendar").pagescalendar("setState","loaded");$("body").removeClass('pending');$("#myCalendar").pagescalendar("removeAllEvents");$("#myCalendar").pagescalendar("addEvents",data);},error:function(ajaxContext){$("#myCalendar").pagescalendar("error",ajaxContext.status+": Something horribly went wrong :(");$("body").removeClass('pending');}});},onEventClick:function(event){if(!$('#calendar-event').hasClass('open'))
$('#calendar-event').addClass('open');selectedEvent=event;setEventDetailsToForm(selectedEvent);},onEventDragComplete:function(event){selectedEvent=event;setEventDetailsToForm(selectedEvent);},onEventResizeComplete:function(event){selectedEvent=event;setEventDetailsToForm(selectedEvent);},onTimeSlotDblClick:function(timeSlot){$('#calendar-event').removeClass('open');var newEvent={title:'my new event',class:'bg-success-lighter',start:timeSlot.date,end:moment(timeSlot.date).add(1,'hour').format(),allDay:false,other:{note:'test'}};selectedEvent=newEvent;$('#myCalendar').pagescalendar('addEvent',newEvent);setEventDetailsToForm(selectedEvent);},onDateChange:function(range){$("#myCalendar").pagescalendar("setState","loaded");var start=range.start.format();var end=range.end.format();if($("body").hasClass('pending')){return;}
$("body").addClass('pending');$("#myCalendar").pagescalendar("setState","loading");$.ajax({type:"GET",url:"http://revox.io/json/events.json",data:"",success:function(data){$("#myCalendar").pagescalendar("setState","loaded");$("body").removeClass('pending');$("#myCalendar").pagescalendar("removeAllEvents");$("#myCalendar").pagescalendar("addEvents",data);},error:function(ajaxContext){$("#myCalendar").pagescalendar("error",ajaxContext.status+": Something horribly went wrong :(");$("body").removeClass('pending');}});}});function setEventDetailsToForm(event){$('#eventIndex').val();$('#txtEventName').val();$('#txtEventCode').val();$('#txtEventLocation').val();$('#event-date').html(moment(event.start).format('MMM, D dddd'));$('#lblfromTime').html(moment(event.start).format('h:mm A'));$('#lbltoTime').html(moment(event.end).format('H:mm A'));$('#eventIndex').val(event.index);$('#txtEventName').val(event.title);$('#txtEventCode').val(event.other.code);$('#txtEventLocation').val(event.other.location);}
$('#eventSave').on('click',function(){selectedEvent.title=$('#txtEventName').val();selectedEvent.other.code=$('#txtEventCode').val();selectedEvent.other.location=$('#txtEventLocation').val();$('#myCalendar').pagescalendar('updateEvent',selectedEvent);$('#calendar-event').removeClass('open');});$('#eventDelete').on('click',function(){$('#myCalendar').pagescalendar('removeEvent',$('#eventIndex').val());$('#calendar-event').removeClass('open');});});})(window.jQuery);