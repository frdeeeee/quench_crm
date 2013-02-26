$(document)
		.ready(
				function() {
					// Fullcalendar

					$('#calendar')
							.fullCalendar(
									{
										firstDay : '1',
										weekMode : 'liquid',
										aspectRatio : '1.5',
										theme : true,
										selectable : true,
										editable : true,
										draggable : true,
										droppable : true,
										timeFormat : 'H:mm',
										axisFormat : 'H:mm',
										columnFormat : {
											month : 'ddd', // Mon
											week : 'ddd dS', // Mon 9/7
											day : 'dddd dS MMMM' // Monday
																	// 9/7
										},
										titleFormat : {
											month : 'MMMM yyyy', // September
																	// 2009
											week : "MMM d[ yyyy]{ 'to'[ MMM] d, yyyy}", // Sep
																						// 7 -
																						// 13
																						// 2009
											day : 'ddd, MMMM d, yyyy' // Tuesday,
																		// Sep
																		// 8,
																		// 2009
										},
										allDayText : 'All Day',
										header : {
											left : 'prev title next, today',
											center : '',
											right : 'agendaWeek,agendaDay,month'
										},

										eventSources : [
												// your event source
												{
													url: '/Projects/ajax_load_project_tasks',
											        type: 'POST',
											        data: {
											            start: '',
											            end: 'somethingelse',
											            project_id:$("#project_id").text()
											        },
											        error: function() {
											            alert('there was an error while fetching tasks!');
											        }
												},
												{
													url: '/Meetings/ajax_load_my_meetings',
											        type: 'POST',
											        data: {
											            start: '',
											            end: 'somethingelse',
											            project_id:$("#project_id").text()
											        },
											        error: function() {
											            alert('there was an error while fetching meetings!');
											        }
												}
										],

										drop : function(date, allDay) { // this
																		// function
																		// is
																		// called
																		// when
																		// something
																		// is
																		// dropped

											// retrieve the dropped element's
											// stored Event Object
											//alert('here');
											
											var originalEventObject = $(this)
													.data('eventObject');

											// we need to copy it, so that
											// multiple events don't have a
											// reference to the same object
											var copiedEventObject = $.extend(
													{}, originalEventObject);

											// assign it the date that was
											// reported
											copiedEventObject.start = date;
											copiedEventObject.allDay = allDay;

											// render the event on the calendar
											// the last `true` argument
											// determines if the event "sticks"
											// (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
											$('#calendar').fullCalendar(
													'renderEvent',
													copiedEventObject, true);

											// is the "remove after drop"
											// checkbox checked?
											if ($('#drop-remove')
													.is(':checked')) {
												// if so, remove the element
												// from the "Draggable Events"
												// list
												$(this).remove();
											}
										},
										
										dayClick: function(date, allDay, jsEvent, view){
											/*
											if (allDay) {
									            alert('Clicked on the entire day: ' + date);
									        }else{
									            alert('Clicked on the slot: ' + date);
									        }
											alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
										    alert('Current view: ' + view.name);
										    $(this).css('background-color', 'red');
										    */
											$("#day_tasks_tool_box_wrapper").css('top',jsEvent.pageY).css('left',jsEvent.pageX);
											$("#day_tasks_tool_box_wrapper").show();
										},
										eventClick:function(event, jsEvent, view){
											$("#event_tool_box_wrapper").html('');
											$("#event_tool_box_wrapper").css('top',jsEvent.pageY).css('left',jsEvent.pageX);
											var action_event_modify = $('<div class="action_btn"><a href="/'+event.controller+'/modify/'+event.id+'">Modify</a></div>');
											var action_event_remove = $('<div class="action_btn"><a href="/'+event.controller+'/remove/'+event.id+'">Remove</a></div>');
											$("#event_tool_box_wrapper").append(action_event_modify);
											$("#event_tool_box_wrapper").append(action_event_remove);
											$("#event_tool_box_wrapper").show();
											return false; //很重要，返回false可以阻止事件冒泡
										},
										eventDrop:function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view){
											//在日历中的task如果被拖拽之后的处理函数
											if(confirm("Are you sure about this change?")){
												$.post(
														'/'+event.controller+'/update_deadline',
														{dayDelta:dayDelta,id:event.id},
														function(data){
															if(data.deadline_date.length>1){
																event.start = data.deadline_date;
														        $('#calendar').fullCalendar('updateEvent', event);
														        alert('The deadline of this task has been updated!');
															}else{
																alert('Update faild, please try later!');
															}
														},
														'json'
												);
											}else{
												revertFunc();
											}
											return false; //很重要，返回false可以阻止事件冒泡
										},
										viewDisplay: function(){
											//每次改变比如下一个月的时候，都会唤起这个函数
										}
									});

					$('ul#calendar_drag_list li a').each(function() {

						// create an Event Object
						// (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
						// it doesn't need to have a start or end
						var eventObject = {
							title : $.trim($(this).text()), // use the element's
															// text as the event
															// title
							className : 'calendar_grad'
						};

						// store the Event Object in the DOM element so we can
						// get to it later
						$(this).data('eventObject', eventObject);

						// make the event draggable using jQuery UI
						$(this).draggable({
							zIndex : 999,
							revert : true, // will cause the event to go back to its
							revertDuration : 10, //  original position after the drag
							cursorAt : {
								top : 15,
								left : 0
							}
						});

					});
				});