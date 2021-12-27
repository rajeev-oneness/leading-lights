   <!-- Modal for add question-->
    <div class="modal fade" id="mcqExamModal" tabindex="-1" role="dialog" aria-labelledby="mcqExamModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mcqExamModalLabel">Add MCQ Questions</h5>
                    {{-- <h6 class="modal-title" id="exam_full_marks">Exam Marks: </h6> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <form action="{{ route('teacher.addMCQQuestion') }}" method="POST" enctype="multipart/form-data"
                        class="question-form">
                        @csrf
                        <input type="hidden" name="exam_id" id="exam_id">
                        <div class="scroll_body">
                            <div id="dynamicAddRemoveMCQ">
                                <p class="font-weight-bold text-center">Question No: 1</p>
                                <div class="form-group m-0">
                                    <label for="question"><b>Question<span class="text-danger">*</span></b></label>
                                    <textarea cols="2" name="addMoreInputFields[0][question]" rows="2"
                                        class="form-control h-auto"></textarea>
                                    <span class="textarea_error text-danger"></span>
                                </div>
                                <div class="form-group m-0 mb-3">

                                    <label for="image"><b>Image</b></label>
                                    <input type="file" class="form-control-file" name="addMoreInputFields[0][image]">
                                    <span class="file_error text-danger"></span>
                                </div>
                                <div class="form-group m-0">
                                    <label for="options"><b>Options</b></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Option 1<span class="text-danger">*</span></label>
                                            <input type="text" name="addMoreInputFields[0][option][]"
                                                class="form-control">
                                            <span class="option_1_err text-danger"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Option 2<span class="text-danger">*</span></label>
                                            <input type="text" name="addMoreInputFields[0][option][]"
                                                class="form-control">
                                            <span class="option_2_err text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="">Option 3<span class="text-danger">*</span></label>
                                            <input type="text" name="addMoreInputFields[0][option][]"
                                                class="form-control">
                                            <span class="option_3_err text-danger"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Option 4<span class="text-danger">*</span></label>
                                            <input type="text" name="addMoreInputFields[0][option][]"
                                                class="form-control">
                                            <span class="option_4_err text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for=""><b>Right Option<span
                                                        class="text-danger">*</span></b></label>
                                            <input type="text" name="addMoreInputFields[0][answer]"
                                                class="form-control">
                                            <span class="answer_err text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="font-weight-bold" id="remaining_question_marks"></p>
                            <p class="text-danger" id="marks_err"></p>
                        </div>
                        <div class="row m-0 justify-content-end align-content-center p-3 pt-0">
                            <button type="button" name="add" id="dynamic-ar-mcq" class="btn btn-primary add_btn mr-2"><i
                                    class="fa fa-plus mr-2"></i>Add Questions</button>
                            <button type="submit" class="btn btn-primary float-right" id="btn_mcq_submit">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
