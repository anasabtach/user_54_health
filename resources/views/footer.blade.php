<footer class="{{ $footer_class }}">
    <div class="container">
       <div class="row">
          <div class="col-12">
             <div class="text-footer d-flex align-items-center">
                <p>Copy right © 2022 Five Four Health - All Rights Reserved. </p>
                <ul class="d-flex align-items-center SFUIText">
                    <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#termsCondition">Terms & Conditions</a></li>
                    <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#privacyPolicy">Privacy Policy</a></li>
                </ul>
             </div>
          </div>
       </div>
    </div>
    <div class="modal fade" id="termsCondition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding:20px;">
                    <p>{!! $app_content['terms-condition'] !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="privacyPolicy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding:20px;">
                    <p>{!! $app_content['privacy-policy'] !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
 </footer>
