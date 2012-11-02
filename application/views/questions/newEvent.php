<style>
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
.ui-slider-handle.ui-state-default.ui-corner-all { top:11px; }
</style>
        <link rel="stylesheet" href="<?= base_url() ?>jquery-ui-1.8.18.css" />

            	<li id="new-event-li">
                        <h2>New Event:</h2>
                        Title:
                        <input id="title-input" type="text" name="question" />
                        Code:
                        <input id="code-input" type="text" name="question" />
                        Start Date/Time:
                        <input id="starttime-input" class="datepicker" type="text">
                        End Date/Time:
                        <input id="endtime-input" class="datepicker" type="text">
                        <button id="event-submit" type="button">Submit</button>
<!--<label for="date">Date Input:</label>
<input type="date" name="date" id="date" value=""  />	-->
					<!--<div data-role="fieldcontain" style="text-align:center">
						<form action="/courses/timeCourses/" method="post">
                        <h2>New Question:</h2>
                        <input type="text" name="question" />
					    <input type="submit" value="Submit" />
					</form>
					</div>-->
				</li>
            

