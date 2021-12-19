    <!-- Modal for add question-->
    <div class="modal fade" id="mixedExamModal" tabindex="-1" role="dialog" aria-labelledby="mixedExamModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mixedExamModalLabel">Add Mixed Questions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.addMixedQuestion') }}" method="POST" enctype="multipart/form-data"
                        class="mixed-question-form">
                        @csrf
                        <input type="hidden" name="exam_id" id="exam_id">
                        <div id="dynamicAddRemoveMixed">
                            <div class="form-group">
                                <label for="question">Question<span class="text-danger">*</span></label>
                                <textarea cols="2" name="addMoreInputFields[0][question1]" rows="2"
                                    class="form-control"></textarea>
                                <span class="textarea_error text-danger"></span>
                            </div>
                            <div class="form-group">

                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="addMoreInputFields[0][image1]">
                                <span class="file_error text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="marks">Marks<span class="text-danger">*</span></label>
                                <select id="marks" class="form-control" name="addMoreInputFields[0][marks]">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <input type="hidden" name="addMoreInputFields[0][question_type]" value="2">
                        </div>
                        <div>
                            <button type="button" name="add" id="dynamic-ar-mixed-desc" class="btn btn-primary mt-3"><i class="fa fa-plus mr-2"></i>Add Descriptive</button>
                            <button type="button" name="add" id="dynamic-ar-mixed-mcq" class="btn btn-primary mt-3"><i class="fa fa-plus mr-2"></i>Add MCQ</button>
                            <button type="submit" class="btn btn-primary float-right mt-3" id="btn_mixed_submit">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
