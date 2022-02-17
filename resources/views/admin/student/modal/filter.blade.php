<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{-- <form action="{{ route('admin.students.registration.filter') }}" method="POST">
                @csrf --}}
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="registration_type" id="regular_class" value="regular_class"
                onclick="window.location='{{ route('admin.students.registration.regular') }}';">
                <label class="form-check-label" for="regular_class">
                  Regular Class
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="registration_type" id="special_course" value="special_course"
                onclick="window.location='{{ route('admin.students.registration.special.course') }}';">
                <label class="form-check-label" for="special_course">
                  Special Course
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="registration_type" id="flash_course" value="flash_course">
                <label class="form-check-label" for="flash_course">
                  Flash Course
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="registration_type" id="paid_video" value="paid_video">
                <label class="form-check-label" for="paid_video">
                  Paid Video
                </label>
              </div>
            
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form> --}}
      </div>
    </div>
  </div>