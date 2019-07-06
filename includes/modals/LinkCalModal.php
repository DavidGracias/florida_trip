<div class="modal fade" id="CalModal" tabindex="-1" role="dialog" aria-labelledby="CalModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h4 class="modal-title">
                    Link Google Calendar
                </h4>
            </div>
            <div class="modal-body">
                Enter the Calendar ID of the google calendar you would like to link to Senior Trip calendar.
                To do this:
                <ul>
                    <li>
                        Go to your google calendar
                    </li>
                    <li>
                        Open up Settings
                    </li>
                    <li>
                        Under the "Settings for my Calendar", select the specific calendar you would like to link (please make sure that the calendar of your choice is set to
                        "Make Avaialable to Public" setting in the Access Permission section
                    </li>
                    <li>
                        Under the selected Calendar, click "Integrate Calendar". There you will see the Calendar ID; copy and paste this id into the input box below
                    </li>
                </ul>
                
                <form action='scripts/CalDates.php' method='POST'>
                    <input type='text' name='CalForm' id='CalForm' class='form-control'/>
                    <button type='submit' value='submit' class='btn btn-blue pull-right margin-3'>Submit</button>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>