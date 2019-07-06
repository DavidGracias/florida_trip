<div class="modal fade" id="confirmDeletionModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeletionModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <span class="bold">You are attempting to delete the following element:</span>
                <div data-id="content" class="row container-fluid">
                    
                </div>
            </div>
            <div class="modal-footer" style="clear: both">
              <button type="button" class="btn btn-primary pull-left" data-dismiss="modal" onclick="$deleteObject.click();">Continue</button>
              <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" onclick="$deleteObject=undefined; ">Cancel</button>
            </div>
        </div>
    </div>
</div>